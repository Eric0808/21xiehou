<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *角色信息控制器<>
 *@date			2013-04-26 18:46:00
 *@table        xh_role_info 
 */
 
final class Role_info extends CI_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		
		$this->load->model('check');
		$this->load->model('role_model');
		$this->load->model('message');
	}
	
	public function index()
	{

	}
	/**
	 * 添加角色
	 */
	function add_role()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$arrInfo['rolename'] = $this->input->post('rname');
			$arrInfo['description'] = $this->input->post('rdesc');
			$arrInfo['disabled'] = isset($_POST['isenable'])? 0 : 1;
			$opLists = isset($_POST['option'])&&is_array($_POST['option'])?$this->input->post('option'):$this->message->showmessage('错误！没有任何操作项!', $this->input->server('HTTP_REFERER'));
			$opLists[]= 'admin/admin_info|update_pwd';//修改密码固定
			$opLists[]= 'admin/login|logout';//退出登录固定
			$roleID = $this->role_model->insert_role($arrInfo);
			if($roleID>0){
				$arrop = array();
				foreach($opLists as $op){
					$arrOp = explode('|', $op);
					$result = $this->role_model->insert_priv($roleID, $arrOp[0], $arrOp[1]);
					if($result<0)
					{$this->message->showmessage('角色添加失败!', $this->input->server('HTTP_REFERER'));}
				}
				$this->message->showmessage('角色添加成功!', $this->input->server('HTTP_REFERER'));
			}
			else $this->message->showmessage('角色添加失败!', $this->input->server('HTTP_REFERER'));
		}
		else{
			
			$data['arroptions'] = $this->check->menu_model->get_admin_menu();
		    $this->load->view('admin/role_info/addrole', $data);
		}
	}
	
	/**
	 * 角色列表
	 */
	function role_list()
	{
		$data['roleLists'] = $this->role_model->get_role_list();
		$this->load->view('admin/role_info/rolelist', $data);
	}

	/**
	 * 编辑角色
	 */
	function role_update()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['role_id'])){
			$role_id = $_POST['role_id'];
			$arrInfo['rolename'] = $this->input->post('rname');
			$arrInfo['description'] = $this->input->post('rdesc');
			$arrInfo['disabled'] = isset($_POST['isenable'])? 0 : 1;
			$opLists = isset($_POST['option'])&&is_array($_POST['option'])?$this->input->post('option'):$this->message->showmessage('错误！没有任何操作项!', $this->input->server('HTTP_REFERER'));
			$role_info = $this->role_model->get_role_info($role_id);
			$this->role_model->del_role($role_id);
			foreach($opLists as $op){
				$arrOp = explode('|', $op);
				$result = $this->role_model->insert_priv($role_id, $arrOp[0], $arrOp[1]);				
			}
			$this->role_model->update_role_info($role_id,$arrInfo);
			$this->message->showmessage('角色编辑成功!', $this->input->server('HTTP_REFERER'));
		}else{
			$role_id = $_GET['id'];
			$data['role_info'] = $this->role_model->get_role_info($role_id);
			$data['role_id'] = $role_id;
			$data['info'] = $this->role_model->get_role_info_byroleid($role_id);
			$data['arroptions'] = $this->check->menu_model->get_admin_menu();
			$this->load->view('admin/role_info/editrole',$data);
		}

	}
	
	/**
	 * 删除角色
	 */
	function role_del()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$role_id = $_GET['id'];
			$this->role_model->del_info($role_id);
			$this->message->showmessage('角色删除成功!', $this->input->server('HTTP_REFERER'));
		}else{
			$this->message->showmessage('角色删除失败!', $this->input->server('HTTP_REFERER'));
		}
	}
}