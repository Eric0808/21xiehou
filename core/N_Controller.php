<?php

class N_Controller extends CI_Controller 
{
	private $data = array();

	public function __construct()
	{
		parent::__construct();
		
		
		$this->load->helper('url');
		$this->data = array();
	}
	
	public function layout($title, $content, array $setting=array())
	{
		if( $content === 404 ){
			show_404();
			exit;
		}
		$this->load->model('menu_model');
		$this->data['current'] = strtolower(get_class($this));
		$this->data['menu'] = $this->menu_model->get_site_menu();
		$this->data['title'] = $title;
		$this->data['content'] = $content;
		
		$this->data['css'] = array(
			'public', 'global'
		);
		$this->data['javascript'] = array(
			'jquery', 'navjs'
		);
		
		if( isset($this->config->config['keyword']) )
			$this->data['keyword'] = $this->config->config['keyword'];
		if( isset($this->config->config['description']) )
			$this->data['description'] = $this->config->config['description'];
		
		foreach($setting as $name=>&$value){
			if( isset($this->data[$name]) ){
				if( is_array($this->data[$name]) ){
					if( is_array($value) ){
						$this->data[$name] = array_merge($this->data[$name], $value);
					}else{
						$this->data[$name][] = $value;
					}
					continue;
				}
			}
			$this->data[$name] = $value;
		}
		
		if( method_exists($this, 'loadViewBefore') ){
			$this->loadViewBefore($this->data);
		}
		$this->load->view('n_layout', $this->data);
	}
	
}
