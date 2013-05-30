<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *会员、顾问推荐位控制器<>
 *@date			2013-05-21 18:46:00
 */
 
final class User_pos extends CI_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		
		$this->load->model('check');
		$this->load->model('userpos_model');
		$this->load->model('message');
		$this->load->model('member_model', 'user');
		//$this->load->model('teacher_model', 'teacher');
	}
	
	public function index()
	{

	}
	/**
	 * 添加用户、顾问推荐位
	 */
	function add_pos()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$arrInfo['catid'] = (int)$this->input->post('cate');
			$arrInfo['name'] = $this->input->post('upos_name');
			$arrInfo['listorder'] = !empty($_POST['upos_order'])? $_POST['upos_order'] :0;
			$posID = $this->userpos_model->insert_upos($arrInfo);
			if($posID>0){
				$this->message->showmessage('推荐位添加成功!', $this->input->server('HTTP_REFERER'));
			}
			else $this->message->showmessage('推荐位添加失败!', $this->input->server('HTTP_REFERER'));
		}
		else{
		    $this->load->view('admin/userpos_info/add_npos');
		}
	}
	
	/**
	 * 推荐位列表
	 */
	function pos_list()
	{
		$data['posLists'] = $this->userpos_model->get_upos_list(' WHERE `catid`=0');
		$this->load->view('admin/userpos_info/upos_list', $data);
	}
	
	/**
	 * 获取某推荐位的信息列表
	 */
	function get_list_bypid()
	{
		$pID = isset($_GET['pid'])&&!empty($_GET['pid']) ? (int)$_GET['pid'] : $this->message->showmessage('缺少参数!', $this->input->server('HTTP_REFERER'));
		$page = isset($_GET['page'])?$_GET['page']:1;
		$where = " WHERE `posid`=$pID ";
		$List = $this->userpos_model->upos_list_byid($page, 20, 10, $where, ' ORDER BY `listorder` ASC ');
		if(is_array($List)){
		$data['listinfo'] = $List[1];
		$data['pagestr'] = $List[0];
		$this->load->view('admin/userpos_info/list', $data);
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
				$this->userpos_model->makeOrder((int)$key,(int)$value);
			}
		    $this->message->reload($this->input->server('HTTP_REFERER'));
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
				$this->userpos_model->makeOut((int)$value);
			}
		    $this->message->reload($this->input->server('HTTP_REFERER'));
		}
	}
	/**
	 *编辑推荐位
	 */
	function edit_pos()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$posID = !empty($_POST['editID']) ? (int)$_POST['editID'] : $this->message->showmessage('缺少参数！', $this->input->server('HTTP_REFERER'));
			$arrInfo['catid'] = (int)$this->input->post('cate');
			$arrInfo['name'] = $this->input->post('upos_name');
			$arrInfo['listorder'] = !empty($_POST['upos_order'])? $_POST['upos_order'] :0;
			$stus = $this->userpos_model->update_upos($arrInfo, $posID);
			if($stus){
				$this->message->showmessage('编辑成功!', $this->input->server('HTTP_REFERER'));
			}
			else $this->message->showmessage('编辑失败!', $this->input->server('HTTP_REFERER'));
		}
		else{
			$pid = (int)$_GET['pid'];
			$pLists = $this->userpos_model->get_upos_list(" WHERE `pid`={$pid} ");
			if(is_array($pLists) and count($pLists)>0){
			$data['posInfo'] = $pLists[0];
		    $this->load->view('admin/userpos_info/edit_npos',$data);
			}
		}
	}
	
	/**
	 *删除推荐位
	 */
	function del_pos()
	{
		$pID = !empty($_GET['pid']) ? (int)$_GET['pid'] : $this->message->showmessage('缺少参数！', $this->input->server('HTTP_REFERER'));
		$staus = $this->userpos_model->delete($pID);
		if($staus){$this->message->showmessage('删除成功！', $this->input->server('HTTP_REFERER'));}
		else {$this->message->showmessage('请移除推荐位中的信息再删除！', $this->input->server('HTTP_REFERER'));}
	}
	/**
	 *更新会员、红娘评论
	 */
	function update_review()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$ID = (int)$_POST['edit_id'];
			$arrdata['treview'] = trim($_POST['treview']);
			$arrdata['ureview'] = trim($_POST['ureview']);
			$statu = $this->userpos_model->update_one($ID, $arrdata);
			if($statu){$this->message->showmessage('更新成功！', $this->input->server('HTTP_REFERER'));}
			$this->message->showmessage('更新失败！', $this->input->server('HTTP_REFERER'));
		}
		else
		{
			$ID = !empty($_GET['id']) ? (int)$_GET['id'] : $this->message->showmessage('缺少参数！', $this->input->server('HTTP_REFERER'));
			$arrInfo = $this->userpos_model->get_one($ID);
			//print_r($arrInfo);exit;
			$this->load->view('admin/userpos_info/edit_review',$arrInfo);
			
		}
	}
	
}