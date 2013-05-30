<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 考试类型相关级别操作<包含界面与模型操作>
 *
 *@date			
 *@database 
 */
final class Link_info extends CI_Controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		
		$this->load->library('session');
		$this->load->model('check');
		$this->load->model('link_model');
		$this->load->model('message');

	}
	
	public function index()
	{
	
	}
	
	public function link_list()
	{
		
		$data['linklist'] = $this->link_model->Getlinks();
		$this->load->view('admin/link_info/link_list',$data);
		
	}
	
	
	public function Dellink(){
		$linkID=isset($_GET['linkid']) ? intval($_GET['linkid']) : -1;
		
		if($linkID>0){
		
			$status = $this->link_model->Delete_bylinkid($linkID);
			if($status)
			{
			    $this->message->showmessage('删除成功!',$this->input->server('HTTP_REFERER'));exit();
			}
			else
			{$this->message->showmessage('删除失败!',$this->input->server('HTTP_REFERER'));exit();}
		}
		else
		$this->message->showmessage('该友链不存在!',$this->input->server('HTTP_REFERER'));exit();
		
		
	}
	
	
	//更新友链信息和排序
	public function Newlinks(){
		$sqlstr=null;
		if(!empty($_POST['newlink']) && !empty($_POST['newdisplay']) && !empty($_POST['newurl'])) {			
			$uploadDir = 'static/uploads/link_img';					
			foreach($_POST['newlink'] as $key=>$newname) {
				//var_dump($_FILES['newlogo']['name'][$key]);exit;
				if(!empty($_FILES['newlogo']['name'][$key])){
					$array_logo = array('name'=>$_FILES['newlogo']['name'][$key],
							   'type'=>$_FILES['newlogo']['type'][$key],
							   'tmp_name'=>$_FILES['newlogo']['tmp_name'][$key],
							   'error'=>$_FILES['newlogo']['error'][$key],
							   'size'=>$_FILES['newlogo']['size'][$key],
				);
					$status = $this->globalfunc->upload_image($array_logo, $uploadDir);
					$image = $status!==false ? '/'.$status : '';
				}else{
					$image = '/static/uploads/link_img/wutupian.jpg';
				}
				$url = strpos($_POST['newurl'][$key], 'http://')===FALSE ? 'http://'.$_POST['newurl'][$key] : $_POST['newurl'][$key];				
			    $newvaluesql[] = "('".$_POST['newdisplay'][$key]."', '$newname', '".$url."','".$image."', '".time()."')";
			}
			if(!empty($newvaluesql)) {
				$sqlstr = 'INSERT INTO table_info'." (`displayorder`, `name`, `url`, `logo`,`addtime`) VALUES ".implode(", ", $newvaluesql).";";
				$status = $this->link_model->Addlink($sqlstr);
				if($status)
				{$this->message->showmessage('友情链接添加成功!',$this->input->server('HTTP_REFERER'));exit();}
				else
				{$this->message->showmessage('友情链接添加失败!',$this->input->server('HTTP_REFERER'));exit();}
			}
		}
		else if(!empty($_POST['display']) && !empty($_POST['name']) && !empty($_POST['url']) ){
				$uploadDir = 'static/uploads/link_img';
				foreach($_POST['display'] as $key=>$neworder){
					$link_info = $this->link_model->Getlinks_one($key);
					if(!empty($_FILES['logo']['name'][$key])){
						$array_logo = array('name'=>$_FILES['logo']['name'][$key],
								   'type'=>$_FILES['logo']['type'][$key],
								   'tmp_name'=>$_FILES['logo']['tmp_name'][$key],
								   'error'=>$_FILES['logo']['error'][$key],
								   'size'=>$_FILES['logo']['size'][$key],
					);
						$status = $this->globalfunc->upload_image($array_logo, $uploadDir);
						$image = $status!==false ? '/'.$status : '';
					}else{
						$image = $link_info['logo'];
					}		
					$url = strpos($_POST['url'][$key], 'http://')===FALSE ? 'http://'.$_POST['url'][$key] : $_POST['url'][$key];
					$status = $this->link_model->Updateorder(array('displayorder'=>intval($neworder), 'name'=>$_POST['name'][$key], 'url'=>$_POST['url'][$key],'logo'=>$image),$key);
				}
				$this->message->showmessage('更新成功!',$this->input->server('HTTP_REFERER'));exit();
		
		}

	}
	
	
	
	
}