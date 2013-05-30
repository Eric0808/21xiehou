<?php
 class News_index extends N_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		
	}
	public function index()
	{
	
         Header("Location: ".base_url()."news/cate/".$_GET['cid']);
	}
	
	
	
	
	
}