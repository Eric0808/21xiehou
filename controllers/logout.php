<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends J_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}

	function index() 
	{
		//$this->load->library('auth_user');
        $this->auth_user->logout();
        header('Location:'.base_url().'login/');
		
    }
}
