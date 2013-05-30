<?php
 class Page extends N_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		
	}
	public function index()
	{
		
	}
	
	public function help()
	{
		$id = isset($_GET['id']) && !empty($_GET['id']) ? (int)$_GET['id'] : 26;
		$this->load->model('menu_model');
		$arrAbout = $this->menu_model->getAbout();
		if($id === 36)
		{
			/*友情链接页面*/
		}
		else
		{
			/*其他页面*/
			$setting['css']=array('gywm');
			$data['catid'] = $id;
			$data['catName'] = $arrAbout[$id]['name'];
			$content = $this->load->view('about/'.$arrAbout[$id]['html'], $data, true);
			$this->layout($arrAbout[$id]['title'], $content, $setting);
			return ;
		}
		
	}

}