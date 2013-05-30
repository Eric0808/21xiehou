<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends J_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('message','msg');
		$this->load->model('member_model', 'user');
		
	}

	function index() 
	{
		$refer = $this->input->server('HTTP_REFERER')!='' && strpos($this->input->server('HTTP_REFERER'), 'login')===false ? $this->input->server('HTTP_REFERER') : base_url();
		
		if($this->auth_user->is_login()){
			/*更新登录记录*/
			//echo $refer;exit;
			self::update_login_info();
		    header('location:'.$refer);
		}
		
		if(isset($_POST['username']) && !empty($_POST['username']) && $_POST['hash_code']==$_SESSION['hashcode']){
			
			$userName = trim($_POST['username']);
            $passWord = trim($_POST['pwd']);
           // $password = sha1($userName.$passWord);
            if($this->auth_user->login_check($_POST['username'],$passWord,isset($_POST['auto'])?1:0)){
				/*更新登录记录*/
				self::update_login_info();
				/*获取用户基本信息*/
				$userInfo = $this->user->get_baseinfo($_SESSION['userid']);
                $_SESSION['vip'] = $userInfo['vip'];
                unset($userInfo['vip']);
                $_SESSION['user_info'] = $userInfo;
				
				/*更新为已登录*/
				$this->user->update_userdata(array('is_login'=>1), array('id'=>$_SESSION['userid']), 'user_login');
                header('location:'.$refer);
			}
			else
			{$this->msg->showmessage('用户名或密码错误!', $this->input->server('HTTP_REFERER'));}
		
		}
        else 
		{	
			$_SESSION['hashcode'] = $this->globalfunc->create_randomstr();
			$data['hash_code'] = $_SESSION['hashcode'];
            $setting=array();
			
			$content = $this->load->view('login', $data, true);
			$this->layout('会员登录', $content, $setting);
			return ;
        }
    }
	
	private function update_login_info()
    {
        $lastInfo = $this->user->select_userdata('lastlogin', array('uid'=>$_SESSION['userid']), 1, 'user_info');
        if($lastInfo[0]['lastlogin']<date('Y-m-d').' 00:00:00')
        {
            $this->user->update_userdata(array('active_days'=>`active_days`+1), array('id'=>$_SESSION['userid']), 'user_login');
        }
        $this->user->update_userdata(array('lastlogin'=>date("Y-m-d H:i:s"),'lastlogin_ip'=>$this->input->ip_address()), array('uid'=>$_SESSION['userid']), 'user_info');
    }
	
	public function info()
	{
		if( isset($_COOKIE['id']) && isset($_COOKIE['ismember']) && $_COOKIE['ismember'] ){
		    $response = '';
			$uid = (int)$_COOKIE['id'];
			$username = $this->auth_user->get_nickname($uid);
			if( $username ){
				$response .= '<span>Hi&nbsp;,&nbsp;</span><span>'.htmlspecialchars($username).'</span>';
				$response .= '<a href="'.base_url().'logout" class="biscuits">&nbsp;&nbsp;退出登录</a></span>';
			}
			echo $response;
		}
	}
	
}
