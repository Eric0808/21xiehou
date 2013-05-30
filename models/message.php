<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message extends CI_Model { 
   
    static $head="<script language=\"javascript\">\n";
	static $foot="</script>\n";
    function __construct()
     {
         parent::__construct();
     }
	
	
	/**
 * 提示信息页面跳转，跳转地址如果传入数组，页面会提示多个地址供用户选择，默认跳转地址为数组的第一个值，时间为5秒。
 * showmessage('登录成功', array('默认跳转地址'=>'http://www.phpcms.cn'));
 * @param string $msg 提示信息
 * @param mixed(string/array) $url_forward 跳转地址
 * @param int $ms 跳转等待时间
 */
	function showmessage($msg, $url_forward = 'goback', $ms = 2500, $dialog = '', $returnjs = '') {
		
			//die($this->input->server('HTTP_REFERER'));
			//include(admin::admin_tpl('showmessage', 'admin'));
			$this->load->view('admin/showmessage',array('msg'=>$msg,'url_forward'=>$url_forward,'ms'=>$ms,'dialog'=>$dialog,'returnjs'=>$returnjs));
			echo $this->output->get_output();
		
		exit();
	}
	//刷新当前页面
	function reload($url)
	{
		header("Location: ".$url);
	}
	
	public function echojs($js)
	{
		echo self::$head;
		echo $js;
		echo self::$foot;
	}
	
	public function alert($str)
	{
		self::echojs("alert(\"$str\");");
	}
	
	public function location($url)
	{
		self::echojs("location.href='$url';");
	}
	
	public function js_back($msg,$go=-1)
	{
		self::echojs("alert('$msg');\nhistory.go($go);\n");
	}
	public function js_alert($msg)
	{
		echo "<script language='javascript'>alert('$msg');</script>";
	}
	public function js_goto($msg,$url)
	{
		echo "<script language='javascript'>alert(\"$msg\");";
		echo "window.location.href=\"$url\";</script>";
	}
	
	public function js_confirm($msg,$true,$false)
	{
		echo "<script language=\"JavaScript\">
		if(confirm('$msg'))
			location.href=\"".$true."\";
		else
			location.href=\"".$false."\";
		</script>";
	}

	public function js_confirmback($msg,$true)
	{
		echo "<script language=\"JavaScript\">
		if(confirm('$msg'))
			location.href=\"".$true."\";
		else
			history.go(-1);
		</script>";
	}
}
