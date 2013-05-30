<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class register extends J_Controller
{
	private $invite;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('message','msg');
		if( ! isset($_SESSION) ){
			if( ! headers_sent() ){
				session_start();
			}else{
				exit('session has sent');
			}
		}
	}

	function first()
	{	
	     
	    /* $this->benchmark->mark('here');
	   
		header('Cache-Control: no-cache, must-revalidate');
		$this->load->model('arr_user_info', 'user_static_data');
		
			
		$staticData = $this->user_static_data->user_info();
		print_r($staticData);
		$this->benchmark->mark('there');
		$fred = $this->benchmark->elapsed_time('here', 'there');
		echo '执行时间：',$fred;
		exit; */
		
		$this->invite['uid']= base64_decode(isset($_GET['uid'])?$_GET['uid']:null);
		if($_POST)
		{
			header('Cache-Control: no-cache, must-revalidate');
			if(!isset($_POST['reg']))
			{
				if(!isset($_POST['authcode']) or strtoupper($_POST['authcode'])!==$_SESSION['authcode'])
				{
					$this->msg->showmessage('验证码错误!', $this->input->server('HTTP_REFERER'));
				}
			}
			
			if(empty($_POST['mobile'])) 
			{
				$this->msg->showmessage('手机不能为空!', $this->input->server('HTTP_REFERER'));
			}
			
			if(empty($_POST['nickname']))
			{
				$this->msg->showmessage('昵称不能为空!', $this->input->server('HTTP_REFERER'));	
			}	
			
			$this->load->model('member_model','userinfo');
			$isExists = $this->userinfo->exists_uname($_POST['username']);
			if($isExists === 1)
			{
				$this->msg->showmessage('已存在此用户，同一个Email不能注册2次!', $this->input->server('HTTP_REFERER'));	
			}
			//生成短信密码
			$pd = $this->globalfunc->make_random_char('0123456789', 6);
			
			/**
			 * @var unknown_type
			 * @var 博客注册统计
			 * @author:zhangjing 
			 */
			if(!empty($_COOKIE['blog']))
			{
				$blogs['ref_url'] = $_COOKIE['blog'];
				$blogs['client_ip'] =$this->input->ip_address();
				$this->userinfo->reg_stat($blogs);
				setcookie('blog','',time()-1);
			}
			//博客统计截止
			
			$login['password'] = sha1($_POST['username'].$pd);
			$login['username'] = trim($_POST['username']);			
			$login['reg_ip'] = $this->input->ip_address();
			$uid = $this->userinfo->add_login_info($login);
			//echo $uid;exit;
			//增加邀请数据
			if($this->invite['uid'])
			{
				$this->invite['yid'] = $uid;
				$this->userinfo->add_invite($this->invite);
			}					
			if(empty($uid))
			{
				$this->msg->showmessage('注册失败!', 'http://www.21xiehou.com');
			}
			
			$info['uid'] = $uid;
			$info['email'] = $_POST['username'];
			$info['mobile'] = $_POST['mobile'];
			$info['nickname'] = trim($_POST['nickname']);
			$info['realname'] = $_POST['realname'];
			$info['salary'] = $_POST['salary'];
			$info['birthday_year'] = $_POST['dateForm_year'];
			$info['birthday_month'] = $_POST['dateForm_month'];
			$info['birthday_day'] = $_POST['dateForm_day'];
			$info['birthday'] = $_POST['dateForm_year'].'-'.$_POST['dateForm_month'].'-'.$_POST['dateForm_day'];
			$info['constellation'] = array_search($this->globalfunc->get_constellation($_POST['dateForm_month'],$_POST['dateForm_day']),$this->globalfunc->arr_constellation());
			$info['work_province'] = $_POST['areaForm_workProvince'];
			$info['work_city'] = $_POST['areaForm_workCity'];
			$info['sex'] = $_POST['sex'];
			$_SESSION['reg_sex'] = $_POST['sex'];
			$info['age'] = date('Y') - $_POST['dateForm_year'];
			$info['lastlogin'] = date('Y-m-d h:i:s');
			/*插入用户基本信息*/
			$this->userinfo->insert($info, 'user_info');
	
			$_SESSION['isLogin'] = false;
			$_SESSION['reg_uid'] = $uid;
			$_SESSION['user_id'] = $uid;
			$_SESSION['reg_step'] = 1;
			$this->userinfo->insert(array('uid'=>$uid,'intro'=>'','properites'=>''), 'user_detail');
			$this->userinfo->insert(array('uid'=>$uid,'sex'=>3-$_POST['sex']), 'user_condition');

			//手机发送短信程序
			$content = "您在21邂逅网的登录账号是".$login['username']."，密码是".$pd."。请您尽快登陆并修改密码![21邂逅网]";
			$str = iconv("utf-8","gb2312",$content);
			$url = "http://sdk2.entinfo.cn/z_send.aspx?sn=SDK-BBX-010-10208&pwd=558073&mobile=".$info['mobile']."&content=".$str."";
			@file_get_contents($url);
			//Swoole_js::js_goto('注册成功！请继续完善您的个人资料！','/register/second/');
			$this->msg->showmessage('注册成功！请继续完善您的个人资料!', 'http://www.21xiehou.com');
		}
		else
		{
			
		}
			
	}
	
}
