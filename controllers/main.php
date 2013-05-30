<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends J_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function index()
	{gdgfdgfdgd
		$setting=array();	
		$content = $this->load->view('index',array(), true);
			
		$this->layout('首页', $content, $setting);
	}
	
}
