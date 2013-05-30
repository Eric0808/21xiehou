<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('check');
		
	}
	function index()
	{
		$this->load->view('admin/main');
	}
	function top()
	{
		$temp['username']=$_SESSION['adminusername'];
		$this->load->view('admin/top',$temp);
		//$this->output->cache(60);
	}
	function center()
	{
		$this->load->view('admin/center');
		//$this->output->cache(60);
	}
	function down()
	{
		$this->load->view('admin/down');
		$this->output->cache(60);
	}
	function left()
	{
		$data['arrMenu'] = $this->check->re_menu();
		$this->load->view('admin/left',$data);
	}
	function right()
	{
		$this->load->view('admin/right');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */