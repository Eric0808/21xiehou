<?php
final class Check extends CI_Model { 

	private  $ADMIN_MENU;
   
    function __construct()
     {
         parent::__construct();
		 $this->load->library('auth');
		 $this->load->model('menu_model');
		 if(! $this->auth->is_login())
		 {
		    echo '<script type="text/javascript"> if (top.location !== self.location) {top.location = "'.site_url('admin/login').'";}else{window.location.href = "'.site_url('admin/login').'";}</script>';
		 	exit();
		 }
     }
	 
	 function re_menu(){
	 
		$adminID = (int)$this->auth->get_uid();
		 if($adminID == 1){
			 //超级管理员没有任何限制
			 $this->ADMIN_MENU = $this->menu_model->get_admin_menu();
			 return $this->ADMIN_MENU;
		 }
		 else{
			 $roleID = (int)$this->auth->get_roleid();
			 $this->ADMIN_MENU = $this->menu_model->get_menu_byid($roleID);
			 return $this->ADMIN_MENU;
		 }
	 }

}