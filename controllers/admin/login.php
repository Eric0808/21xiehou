<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * 用户登录控制器
	 *
	 */
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('auth');
		$this->load->model('message');
	}
	function index()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$username = $this->input->post('user');
		    $userpass = $this->input->post('pwd');
			$password = sha1($userpass.$username);
			if($this->auth->login_check($username, $password, 'admin_model')){
				//echo "sdfsf";exit;
				
				header('Location: '.base_url().'admin/welcome/');
			}
			else{$this->message->showmessage('用户名或密码错误!',$this->input->server('HTTP_REFERER'));exit();}
		
		}
		else{$this->load->view('admin/login');}	
	}
	
	/**
	 * 管理员退出
	 */
	function logout()
	{
		$this->auth->logout();
		header('Location: '.base_url().'admin/login/');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */