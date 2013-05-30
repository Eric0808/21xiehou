<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *新闻推荐位控制器<>
 *@date			2013-04-26 18:46:00
 *@table        xh_role_info 
 */
 
final class News_pos extends CI_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		
		$this->load->model('check');
		$this->load->model('newspos_model');
		$this->load->model('message');
		$this->load->model('news_model');
	}
	
	public function index()
	{

	}
	/**
	 * 添加新闻推荐位
	 */
	function add_pos()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$arr = explode('|', $this->input->post('npos_cate'));
			
			$arrInfo['catid'] = (int)$arr[0];
			$arrInfo['catname'] = $arr[1];
			$arrInfo['name'] = $this->input->post('npos_name');
			$arrInfo['maxnum'] = !empty($_POST['npos_maxnum'])? (int)$_POST['npos_maxnum'] : 20;
			$arrInfo['extention'] = !empty($_POST['npos_ext'])? $_POST['npos_ext'] : null;
			$arrInfo['listorder'] = !empty($_POST['npos_order'])? $_POST['npos_order'] :0;
			$arrInfo['cachetime'] = !empty($_POST['npos_cachetime'])? $_POST['npos_cachetime'] : 0;
			$posID = $this->newspos_model->insert_npos($arrInfo);
			if($posID>0){
				$this->message->showmessage('推荐位添加成功!', $this->input->server('HTTP_REFERER'));
			}
			else $this->message->showmessage('推荐位添加失败!', $this->input->server('HTTP_REFERER'));
		}
		else{
			
			$data['cateList'] = $this->news_model->get_all_cate();
		    $this->load->view('admin/npos_info/add_npos', $data);
		}
	}
	
	/**
	 * 新闻推荐位列表
	 */
	function pos_list()
	{
		$data['posLists'] = $this->newspos_model->get_npos_list();
		$this->load->view('admin/npos_info/npos_list', $data);
	}
	
	/**
	 * 获取某推荐位的新闻列表
	 */
	function get_list_bypid()
	{
		$pID = isset($_GET['pid'])&&!empty($_GET['pid']) ? (int)$_GET['pid'] : $this->message->showmessage('缺少参数!', $this->input->server('HTTP_REFERER'));
		$page = isset($_GET['page'])?$_GET['page']:1;
		$where = " WHERE `posid`=$pID ";
		$newsList = $this->newspos_model->npos_list_byid($page, 20, 10, $where, ' ORDER BY `listorder` ASC ');
		if(is_array($newsList)){
		$data['newsinfo'] = $newsList[1];
		$data['pagestr'] = $newsList[0];
		$this->load->view('admin/npos_info/news_list', $data);
	    }
	}	
	
	/**
	 * 推荐位信息排序
	 */
	function make_order()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$IDS = $_POST['disorder'];
			foreach($IDS as $key=>$value)
			{
				$this->newspos_model->makeOrder((int)$key,(int)$value);
			}
		    $this->message->reload($this->input->server('HTTP_REFERER'));
		}
		
	}
	
	/**
	 * 移除推荐位
	 */
	function move_out1()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{	
			$IDS = isset($_POST['ids']) ? $_POST['ids'] : $this->message->showmessage('您没有选择要移除项！', $this->input->server('HTTP_REFERER'));
			foreach($IDS as $value)
			{	
				if($this->newspos_model->posnews_count((int)$value)){
					$this->message->showmessage('您不能删除所选项！', $this->input->server('HTTP_REFERER'));
				}else{
					$this->newspos_model->makeOut1((int)$value);	
				}	
			}
			$this->message->showmessage('删除成功!',$this->input->server('HTTP_REFERER'));exit();
		    //$this->message->reload($this->input->server('HTTP_REFERER'));
		}else{
			$IDS = $_GET['id'];
			if($this->newspos_model->posnews_count((int)$IDS)){
				$this->message->showmessage('您不能删除所选项！', $this->input->server('HTTP_REFERER'));
			}else{
				$this->newspos_model->makeOut1((int)$IDS);	
			}
			$this->message->showmessage('删除成功!',$this->input->server('HTTP_REFERER'));exit();
		}
	}
	/**
	 * 移除推荐位信息
	 */
	function move_out()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$IDS = isset($_POST['ids']) ? $_POST['ids'] : $this->message->showmessage('您没有选择要移除项！', $this->input->server('HTTP_REFERER'));
			foreach($IDS as $value)
			{
				$this->newspos_model->makeOut((int)$value);
			}
		    $this->message->reload($this->input->server('HTTP_REFERER'));
		}
	}
	
}