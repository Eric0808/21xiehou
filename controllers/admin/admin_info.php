<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *管理员信息控制器<>
 *@date			2013-04-26 18:46:00
 *@table        xh_admin_info 
 */
 
final class Admin_info extends CI_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		
		$this->load->model('check');
		$this->load->model('admin_model');
		$this->load->model('message');
		$this->load->model('role_model');

	}
	
	public function index()
	{
		
		
	}
	/**
	 * 添加管理员
	 */
	function add_admin()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$userName = $this->input->post('uname');
			$trueName = $this->input->post('truename');
			$password = sha1($this->input->post('password').$userName);
			$roleID = $this->input->post('role')!='-1' ? (int)$this->input->post('role') : $this->message->showmessage('请选择角色!', $this->input->server('HTTP_REFERER'));
			$result = $this->admin_model->insert_admin($userName,$trueName,$password,$roleID);
			if($result) $this->message->showmessage('管理员添加成功!', $this->input->server('HTTP_REFERER'));
			else $this->message->showmessage('管理员添加失败!', $this->input->server('HTTP_REFERER'));
		}
		else{
			$data['roleList'] = $this->role_model->get_role_list();
			
		    $this->load->view('admin/admin_info/addadmin', $data);
		}
	}
	
	/**
	 * 修改密码
	 */
	function update_pwd()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			$userID = $this->auth->get_uid();
			$userName = $this->auth->get_uname();
			$oldpass = $this->input->post('old_password');
			$newpass = $this->input->post('new_password');
			if(!empty($oldpass) && !empty($newpass)){
			
				$newpass = sha1($newpass.$userName);
				
				if($this->admin_model->update_pwd($userID, $newpass)){
					$this->auth->logout();
					$this->message->showmessage('密码更新成功!', base_url().'admin/login/');exit();
				}
				else{$this->message->showmessage('密码更新失败!', $this->input->server('HTTP_REFERER'));exit();}
			}
		}
		else{
		   $this->load->view('admin/updatepass');
		}
	}
	/**
	 * 异步检测密码
	 */
	function ajaxck_oldpass()
	{
		$userID = $this->auth->get_uid();
		$userName = $this->auth->get_uname();
		$oldPwd = sha1($_GET['old_password'].$userName);
		$result = $this->admin_model->ajax_check_oldpwd($userID, $oldPwd);
		if ($result){
			exit('1');
		}
		exit('0');
	}
	/**
	 * 异步检测用户名是否存在
	 */
	function ajaxck_uname()
	{
		$userName = isset($_GET['uname'])? $_GET['uname'] : '';
		$result = $this->admin_model->ajax_check_uname($userName);
		if ($result){
			exit('1');
		}
		exit('0');
	}
	
	
	
}