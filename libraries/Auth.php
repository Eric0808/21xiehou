<?php

final class Auth
{
	static $userID;
	static $userName;
	Static $session_prefix;
	// 会员登录cookie保留1天
	private $lifetime = 1;
	var $userinfo = array();
	function __construct($session_type = 'admin')
	{
		self::$session_prefix = $session_type;
		if( ! isset($_SESSION) ){
			if( ! headers_sent() ){
				session_start();
			}else{
				exit('session has sent');
			}
		}
	}
	
	/**
	 * 登录检查
	 * @param $username
	 * @param $password
	 * @param $model_name 模型名称：管理员 or 会员
	 * @param $objname 对象名称
	 * @return bool
	 */
	function login_check($username, $password, $model_name, $objname = 'admin')
	{ 
		if($this->is_login()) {return 1;}
		else{
			setcookie(self::$session_prefix . 'username', $username, time()+3600*24*$this->lifetime, '/');
			$CI =& get_instance();
			$CI->load->model($model_name, $objname);
			if($objname == 'admin'){
				$this->userinfo = $CI->admin->get_admin_info($username);}
			else{
				$this->userinfo = $CI->member->get_user_info($username);}
				
			if(empty($this->userinfo)) return false;
			
			else if($this->userinfo['password'] == $password){
				$_SESSION[self::$session_prefix.'isLogin']=true;
			    $_SESSION[self::$session_prefix.'userid']=$this->userinfo['userid'];
				$_SESSION[self::$session_prefix.'username']=$this->userinfo['username'];
				if(isset($this->userinfo['roleid'])){$_SESSION[self::$session_prefix.'roleid']=$this->userinfo['roleid'];}
				return true;
			}
	
		}
		
	}
	
	/**
	 * 退出登录
	 * @return bool
	 */
	 function logout()
	 {
		if(isset($_SESSION[self::$session_prefix.'isLogin'])){
			session_unset();
			session_destroy();
		}
	 }
	
	function get_uid()
	{
		if(isset($_SESSION[self::$session_prefix.'isLogin']) && $_SESSION[self::$session_prefix.'isLogin'] == 1 && isset($_SESSION[self::$session_prefix.'userid']))
		return $_SESSION[self::$session_prefix.'userid'];
		else return false;
	}
	
	function get_uname()
	{
		if(isset($_SESSION[self::$session_prefix.'isLogin']) && $_SESSION[self::$session_prefix.'isLogin'] == 1 && isset($_SESSION[self::$session_prefix.'username']))
		return $_SESSION[self::$session_prefix.'username'];
		else return false;
	}
	
	function get_roleid()
	{
		if(isset($_SESSION[self::$session_prefix.'isLogin']) && $_SESSION[self::$session_prefix.'isLogin'] == 1 && isset($_SESSION[self::$session_prefix.'roleid']))
		return $_SESSION[self::$session_prefix.'roleid'];
		else return false;
	}
	/**
	 * 检查是否已登录
	 * @return bool
	 */
	 function is_login()
	 {
		if(isset($_SESSION[self::$session_prefix.'isLogin']) && $_SESSION[self::$session_prefix.'isLogin'] == 1) return true;
		else return false;
	 }
	
	
}