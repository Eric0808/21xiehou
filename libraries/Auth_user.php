<?php

final class Auth_user
{
	Static $session_prefix = '';
	
	static $cookie_life = 2592000;
	var $userinfo = array();
	private $lifetime = 30;
	function __construct()
	{
		if( ! isset($_SESSION) ){
			if( ! headers_sent() ){
				session_start();
			}else{
				exit('session has sent');
			}
		}
	}
	
	/**
	 * 检查是否在线
	 * @param $uid
	 * @return bool
	 */
	 function is_online($uid)
	 {
		return isset($_SESSION[$uid]) && !empty($_SESSION[$uid]);
	 }
	 /**
	 * 设置在线状态
	 * @param $uid
	 * @return bool
	 */
	 function set_online($uid)
	 {
		$_SESSION[$uid] = $uid;
		setCookie('ismember', '1', time()+3600*24*$this->lifetime, '/');
		setCookie('id', $uid, time()+3600*24*$this->lifetime, '/');
		return true;
	 }
	 
	
	/**
	 * 登录检查
	 * @param $username
	 * @param $password
	 * @return bool
	 */
	function login_check($username, $password, $auto = 0)
	{ 
		if($this->is_login()) {return true;}
		else{
			setcookie(self::$session_prefix . 'username', $username, time()+self::$cookie_life, '/');
			$CI =& get_instance();
			$CI->load->model('member_model', 'member');
			
			/*邮箱登陆*/
			if(preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $username))
			{
				$this->userinfo = $CI->member->get_user_info($username);
				if(empty($this->userinfo)) {return false;}
				$password = sha1($username.$password);
			}
			/*手机登陆*/
			else
			{
				$this->userinfo = $CI->member->get_user_info($username, 'mobile');
				if(empty($this->userinfo)) {return false;}
				$password = sha1($this->userinfo['username'].$password);
				
			}
			
			if($this->userinfo['password'] == $password){
				$_SESSION[self::$session_prefix.'isLogin']=true;
			    $_SESSION[self::$session_prefix.'userid']=$this->userinfo['id'];
				$_SESSION[self::$session_prefix.'username']=$this->userinfo['username'];
				$_SESSION[self::$session_prefix.'nickname']=$this->userinfo['nickname'];
				$this->set_online($this->userinfo['id']);
				if($auto==1) $this->autoLogin();
			    return true;
			}
			return false;
	
		}
		
	}
	
	/**
	 * 自动登录，如果自动登录则在本地记住密码
	 * @param $user
	 * @return unknown_type
	 */
	function autoLogin()
	{
		//$ip = $this->input->ip_address();
		setcookie(self::$session_prefix.'autologin',1,time() + self::$cookie_life,'/');
		setcookie(self::$session_prefix.'username',$this->user['username'],time() + self::$cookie_life,'/');
		setcookie(self::$session_prefix.'password',$this->user['password'],time() + self::$cookie_life,'/');
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
			if(isset($_COOKIE[self::$session_prefix.'password'])) setcookie(self::$session_prefix.'password','',0,'/');
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
	
	function get_nickname()
	{
		if(isset($_SESSION[self::$session_prefix.'isLogin']) && $_SESSION[self::$session_prefix.'isLogin'] == 1 && isset($_SESSION[self::$session_prefix.'nickname']))
		return $_SESSION[self::$session_prefix.'nickname'];
		else return false;
	}
	
	
	/**
	 * 检查是否已登录
	 * @return bool
	 */
	 function is_login()
	 {
		if(isset($_SESSION[self::$session_prefix.'isLogin']) && $_SESSION[self::$session_prefix.'isLogin'] == 1) return true;
		elseif(isset($_COOKIE[self::$session_prefix.'autologin']) and isset($_COOKIE[self::$session_prefix.'username']) and isset($_COOKIE[self::$session_prefix.'password']))
		{
			return $this->login_check($_COOKIE[self::$session_prefix.'username'],$_COOKIE[self::$session_prefix.'password'],$auto=1);
		}
		else return false;
	 }
	
	
}