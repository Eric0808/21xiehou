<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 新闻控制器
 *
 *@date			
 *@database 
 */
final class News_info extends CI_Controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('check');
		$this->load->model('news_model');
		$this->load->model('newspos_model');
		$this->load->model('message');
		

	}
	
	public function index()
	{
	}
	
	/*发布文章*/
	public function Add_news()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			//var_dump($_FILES['image_upload']);exit;
			$title = !empty($_POST['title']) ?  htmlspecialchars(trim($_POST['title']),ENT_QUOTES) : $this->message->showmessage('请填写标题!',$this->input->server('HTTP_REFERER'));
			$newsCate = explode('|', $_POST['news_cate']);
			if($newsCate[0]==='0')$this->message->showmessage('请选择栏目!',$this->input->server('HTTP_REFERER'));
			$source = !empty($_POST['source']) ? trim($_POST['source']) : '21邂逅网';
			$author = $_POST['author'];
			$editer = $_SESSION['adminusername'];
			$ispost = isset($_POST['ispost']) ? 1 : 0;
			$image = $picture = '';
			$uploadDir = 'static/uploads/news_img';
			if(!empty($_FILES['image_upload']['name']))
			{
				$status = $this->globalfunc->upload_image($_FILES['image_upload'], $uploadDir);
			    $image = $status!==false ? '/'.$status : '';
			}
			if(!empty($_FILES['pic_upload']['name']))
			{
				$status = $this->globalfunc->upload_image($_FILES['pic_upload'], $uploadDir);
			    $picture = $status!==false ? '/'.$status : '';
			}
			$desc = trim($_POST['news_desc']);
			$content = !empty($_POST['elm1']) ? addslashes($_POST['elm1']) : $this->message->showmessage('内容不能为空!',$this->input->server('HTTP_REFERER'));;
			
			$valueStr1 = "('".$editer."', '".$author."', '".$title."', '".$content."', '".(int)$newsCate[0]."', '".$source."', '".$image."', '".$picture."', '".$ispost."', '".$desc."')";
		    $sqlStr1 = 'INSERT INTO table_info'." (`editer`,`author`,`title`,`content`,`catid`,`source`,`image`,`picture`,`publish`,`news_desc`) VALUES ".$valueStr1.";";
			$reId = $this->news_model->Addnews($sqlStr1);
			if($reId)$this->message->showmessage('发布成功!',$this->input->server('HTTP_REFERER'));
			else $this->message->showmessage('发布失败!',$this->input->server('HTTP_REFERER'));
			
		}
		//展示发布页面
		else
		{
			$data['cateList'] = $this->news_model->get_all_cate();
		    $this->load->view('admin/news_info/post_news', $data);
		}
	}
	/*编辑文章*/
	public function edit_news()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['edit_id'])){
			$id = $_POST['edit_id'];
			$newsContent = $this->news_model->get_one($id); 
			$news['title'] = !empty($_POST['title']) ?  htmlspecialchars(trim($_POST['title']),ENT_QUOTES) : $this->message->showmessage('请填写标题!',$this->input->server('HTTP_REFERER'));
			$newsCate = explode('|', $_POST['news_cate']);
			if($newsCate[0]==='0')$this->message->showmessage('请选择栏目!',$this->input->server('HTTP_REFERER'));
			$news['catid'] = $newsCate[0];
			$news['source'] = !empty($_POST['source']) ? trim($_POST['source']) : '21邂逅网';
			$news['author'] = $_POST['author'];
			$news['publish'] = isset($_POST['ispost']) ? 1 : 0;
			$uploadDir = 'static/uploads/news_img';
			if(!empty($_FILES['image_upload']['name'])){
				$status = $this->globalfunc->upload_image($_FILES['image_upload'], $uploadDir);
			    $image = $status!==false ? '/'.$status : '';
			}else{
				$image = $newsContent['image'];
			}
			if(!empty($_FILES['pic_upload']['name'])){
				$status = $this->globalfunc->upload_image($_FILES['pic_upload'], $uploadDir);
			    $picture = $status!==false ? '/'.$status : '';
			}else{
				$picture = $newsContent['picture'];
			}
			$news['image'] = $image;
			$news['picture'] = $picture;
			$news['news_desc'] = trim($_POST['news_desc']);
			//print_r($_POST);exit;!empty($_POST['elm1'])
			$news['content'] = !empty($_POST['elm1']) ? addslashes($_POST['elm1']) : $this->message->showmessage('内容不能为空!',$this->input->server('HTTP_REFERER'));
			$content = $this->news_model->editnews($id,$news);
			$this->message->showmessage('更新成功!',$this->input->server('HTTP_REFERER'));		
				
		}		
		//展示编辑页面
		else
		{
			if(isset($_GET['id']) && !empty($_GET['id'])){
				$id = intval($_GET['id']);
				$newsContent = $this->news_model->get_one($id);
				$newsContent['cateList'] = $this->news_model->get_all_cate();
				$newsContent['catname'] = $this->news_model->getone_bycatid($newsContent['catid']);
				$this->load->view('admin/news_info/edit_news',$newsContent);	
			}
			
		}
	}
	
	/*推荐文章*/
	public function move_tops()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			if(isset($_POST['ids'])){
				if($_POST['mov_posid']=='-1'){$this->message->showmessage('请选择要要推荐的位置!',$this->input->server('HTTP_REFERER'));}
				$posids = (int)$_POST['mov_posid'];
				$ids = implode(',',$_POST['ids']); 
				//echo $ids;exit;
				$statu = $this->news_model->Update_posid_byid($ids, $posids);
				if($statu>0){
				
					$result = $this->news_model->get_posnews_list($ids);
					foreach($result as $value){
						$this->newspos_model->add_npos_list($posids, $value['catid'], $value['image'], array('id'=>$value['id'],'title'=>$value['title'],'image'=>$value['image'],'picture'=>$value['picture'],'news_desc'=>$value['news_desc'],'addtime'=>$value['addtime']));
					}
					$this->message->showmessage('推荐成功!',$this->input->server('HTTP_REFERER'));
				}
				
				$this->message->showmessage('推荐出错，终止操作!',$this->input->server('HTTP_REFERER'));exit();
			}
			else{
				$this->message->showmessage('你还没有选择任何项!',$this->input->server('HTTP_REFERER'));exit();
			}
		}
	}
	
	/*展示内容列表*/
	public function news_list()
	{
		$page = isset($_GET['page'])?$_GET['page']:1;
		$newsList = $this->news_model->get_news_list($page, 20, 10 ,'', ' ORDER BY `addtime` DESC ','id,editer,author,posids,title,image,addtime,catid,hits,catname');
		if(is_array($newsList)){
		$data['news'] = $newsList[1];
		$data['pagestr'] = $newsList[0];
		$data['posList'] = $this->newspos_model->get_npos_list();
		$this->load->view('admin/news_info/news_list',$data);}
		
	}
	
	/*删除资讯文章*/
	public function del_news()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			if(!empty($_POST['ids'])){
				foreach($_POST['ids'] as $id){
					$id = intval($id);
					$result = $this->news_model->drop_news($id);
					if(!$result){
						$this->message->showmessage('删除出错，终止操作!',$this->input->server('HTTP_REFERER'));exit();
					}
				}
				$this->message->showmessage('删除成功!',$this->input->server('HTTP_REFERER'));exit();
			}
			else{
				$this->message->showmessage('你还没有选择任何项!',$this->input->server('HTTP_REFERER'));exit();
			}
		}
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			if(isset($_GET['id']) && !empty($_GET['id'])){
				    $id = intval($_GET['id']);
					$result = $this->news_model->drop_news($id);
					if($result){
						//删除文件
						$this->message->showmessage('删除成功!',$this->input->server('HTTP_REFERER'));exit();
					}
					else{$this->message->showmessage('删除失败!',$this->input->server('HTTP_REFERER'));exit();}
			}
		}
	}
	/*获取一级类别*/
	public function news_cates()
	{
		if(isset($_GET['catid']) && isset($_GET['catname']) && !empty($_GET['catid'])){
			$data['fid']= $_GET['catid'];
			$this->load->view('admin/news_info/addsubcate',$data);
		}
		else{
			$data['cateList'] = $this->news_model->getcategory();
			$this->load->view('admin/news_info/news_cate',$data);
		}
	}
	
	//异步显示子类别
	public function showsubajax()
	{
		
		 $catid=null;
		if(isset($_GET['catid']) && !empty($_GET['catid'])){
			
			$catid=intval($_GET['catid']);
			$data = $this->news_model->getsubid_bycatid($catid);
			exit($data);
			
		}
		else
		exit('没有下级栏目了');
		
	}
	
	//增加新的栏目
	public function add_cates(){
		
		$sqlstr=null;
		if(!empty($_POST['newcategory']) && !empty($_POST['newdisplay'])&& !empty($_POST['newdescription'])) {
			//删除数据缓存
			$this->db->cache_delete('admin', 'news_info');
			if(isset($_POST['fid']) && !empty($_POST['fid']))
			{
				foreach($_POST['newcategory'] as $key=>$newname) {
			        $newvaluesql[] = "('$newname','".$_POST['newdescription'][$key]."','".$_POST['fid']."','".$_POST['newdisplay'][$key]."')";
			    }
			}
			else{
				foreach($_POST['newcategory'] as $key=>$newname) {
					$newvaluesql[] = "('$newname','".$_POST['newdescription'][$key]."',  '".$_POST['newdisplay'][$key]."')";
				}
			}
			if(!empty($newvaluesql)) {
				if(isset($_POST['fid']) && !empty($_POST['fid']))
			    {
					$sqlstr = 'INSERT INTO table_info'." (`catname`,`description`,`fid`,`listorder`) VALUES ".implode(", ", $newvaluesql).";";
				}
				else{
				    $sqlstr = 'INSERT INTO table_info'." (`catname`,`description`,`listorder`) VALUES ".implode(", ", $newvaluesql).";";
				}
				$status = $this->news_model->addcate($sqlstr);
				if($status)
				{$this->message->showmessage('栏目添加成功!',$this->input->server('HTTP_REFERER'));exit();}
				else
				{$this->message->showmessage('添加失败!',$this->input->server('HTTP_REFERER'));exit();}
			}
		}
		else{
		$this->message->showmessage('信息不能为空!',$this->input->server('HTTP_REFERER'));exit();}

	}
	/*删除栏目
	*/
	public function del_cates()
	{
		//删除数据缓存
		$this->db->cache_delete('admin', 'news_info');
		$catID = isset($_GET['catid']) ? (int)$_GET['catid']:$this->message->showmessage('参数错误!',$this->input->server('HTTP_REFERER'));
		$status = $this->news_model->drop_cate($catID);
		if($status)
		$this->message->showmessage('删除成功!',$this->input->server('HTTP_REFERER'));
		else
		$this->message->showmessage('删除失败!',$this->input->server('HTTP_REFERER'));
	}
	
	public function Upload()
	{
		$uploadDir = $this->config->item('SITEROOT') . '/static/uploads/news_img';
		$reUrl = $this->config->item('Domain') . 'static/uploads';
		$this->globalfunc->Upload_file($uploadDir,$reUrl );
	}
	
}