<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function index()
	{
		
	}
	
	public function user_exists()
	{
		$this->load->model('member_model','userinfo');
		if(isset($_GET['username']) && !empty($_GET['username'])){
		echo $this->userinfo->exists_uname($_GET['username']);exit;}
		if(isset($_GET['nickname']) && !empty($_GET['nickname'])){//echo $this->userinfo->exists_common('nickname', $_GET['nickname']);
		echo $this->userinfo->exists_common('nickname', $_GET['nickname']);exit;}
		if(isset($_GET['mobile']) && !empty($_GET['mobile'])){
		echo $this->userinfo->exists_common('mobile', $_GET['mobile']);exit;}
	}
	
}
