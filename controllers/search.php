<?php
 class Search extends J_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('member_model','member');
		$this->load->model('message','msg');
	}
	public function index()
	{
		if(!empty($_POST['sex']))
        {
            /*基本条件*/
            $base_cond['where']['sex'] = $_POST['sex'];
            if(!empty($_POST['work_province'])) $base_cond['where']['work_province'] = $_POST['work_province'];
            if(!empty($_POST['work_city'])) $base_cond['where']['work_city'] = $_POST['work_city'];
            if(!empty($_POST['min_age'])) $base_cond['where']['age >='] = $_POST['min_age'];
            if(!empty($_POST['max_age'])) $base_cond['where']['age <='] = $_POST['max_age'];
            if(!empty($_POST['salary'])) $base_cond['where']['salary >='] = $_POST['salary'];
            if(!empty($_POST['min_height'])) $base_cond['where']['height >='] = $_POST['min_height'];
            if(!empty($_POST['max_height'])) $base_cond['where']['height <='] = $_POST['max_height'];
            if(!empty($_POST['degree'])) $base_cond['where']['degree >='] = $_POST['degree'];
            if(!empty($_POST['marriage'])) $base_cond['where']['marriage'] = $_POST['marriage'];
            if(!empty($_POST['children'])) $base_cond['where']['children'] = $_POST['children'];
            if(!empty($_POST['birthday_year'])) $base_cond['where']['birthday_year'] = $_POST['birthday_year'];
            if(!empty($_POST['birthday_month'])) $base_cond['where']['birthday_month'] = $_POST['birthday_month'];
            if(!empty($_POST['birthday_day'])) $base_cond['where']['s'] = $_POST['birthday_day'];
            $_SESSION['search_basecond'] = $base_cond;
            
             /*高级条件*/
           
            if(isset($_POST['high_search_x']) and isset($_POST['high_search_y']) and !isset($_SESSION['isLogin']))
            {
				
				$this->msg->showmessage('高级搜索只针对注册会员开放，请登录后再搜索！', base_url().'register/first/');
                
            }
            if(!empty($_POST['credit'])) $high_cond['where']['credit'] = $_POST['credit'];
            if(!empty($_POST['job'])) $high_cond['where']['job'] = $_POST['job'];
            if(!empty($_POST['companytype'])) $high_cond['where']['companytype'] = $_POST['companytype'];
            if(!empty($_POST['house'])) $high_cond['where']['house'] = $_POST['house'];
            if(!empty($_POST['car'])) $high_cond['where']['car'] = $_POST['car'];
            if(!empty($_POST['birth_province'])) $high_cond['where']['birth_province'] = $_POST['birth_province'];
            if(!empty($_POST['birth_city'])) $high_cond['where']['birth_city'] = $_POST['birth_city'];
            if(!empty($_POST['min_jon'])) $high_cond['where']['min_jon'] = $_POST['min_jon'];
            if(!empty($_POST['belief'])) $high_cond['where']['belief'] = $_POST['belief'];
            if(!empty($_POST['smoking'])) $high_cond['where']['smoking'] = $_POST['smoking'];
            if(!empty($_POST['drinking'])) $high_cond['where']['drinking'] = $_POST['drinking'];
            if(!empty($_POST['animal'])) $high_cond['where']['animal'] = $_POST['animal'];
            if(!empty($_POST['drinking'])) $high_cond['where']['drinking'] = $_POST['drinking'];
            if(!empty($_POST['constellation'])) $high_cond['where']['constellation'] = $_POST['constellation'];
            if(!empty($_POST['bloodtype'])) $high_cond['where']['bloodtype'] = $_POST['bloodtype'];
            if(!empty($_POST['has_avatar'])) $high_cond['where']['has_avatar'] = $_POST['has_avatar'];
            if(!empty($_POST['online'])) $high_cond['where']['online'] = $_POST['online'];
            if(!empty($_POST['search_name'])) $high_cond['where']['search_name'] = $_POST['search_name'];
            if(!empty($_POST['sendmail'])) $high_cond['where']['sendmail'] = $_POST['sendmail'];
            $_SESSION['search_highcond'] = $high_cond;
			header('Location: '.base_url().'search/result/');
        }
        else
        {
			$this->load->library('position');//加载推荐位类
			$data['position_1'] = $this->position->data('news', 1, 0, 2, 300);
			$data['position_2'] = $this->position->data('news', 2, 0, 9, 300);
			$setting=array();
			$content = $this->load->view('search', $data, true);
			$this->layout('邂逅搜索_21邂逅网_中国真实婚恋交友平台的领航者_网络婚介中心', $content, $setting);
			return ;
		}
	}
	
	function fast()
    {
    	if(isset($_GET['sex']))
        {
            $base_cond['where']['sex'] = $_GET['sex'];
            //居住地
            if(!empty($_GET['areaForm_workProvince']) and intval($_GET['areaForm_workProvince'])>1) $base_cond['where']['work_province'] = $_GET['areaForm_workProvince'];
            if(!empty($_GET['areaForm_workProvince1']) and intval($_GET['areaForm_workProvince1'])>1) $base_cond['where']['work_province'] = $_GET['areaForm_workProvince1'];
            if(!empty($_GET['areaForm_workCity']) and intval($_GET['areaForm_workCity'])>1) $base_cond['where']['work_city'] = $_GET['areaForm_workCity'];
            if(!empty($_GET['areaForm_workCity1']) and intval($_GET['areaForm_workCity1'])>1) $base_cond['where']['work_city'] = $_GET['areaForm_workCity1'];
            if(!empty($_GET['min_age'])) $base_cond['where']['age >='] = $_GET['min_age'];
            if(!empty($_GET['max_age'])) $base_cond['where']['age <='] = $_GET['max_age'];
            $base_cond['where']['has_avatar'] = empty($_GET['has_avatar'])?1:$_GET['has_avatar'];
            $_SESSION['search_basecond'] = $base_cond;
            if(!empty($_SESSION['search_highcond'])) unset($_SESSION['search_highcond']);
            header('Location: '.base_url().'search/result/');
        }
        $this->msg->showmessage('请选择性别！', $this->input->server('HTTP_REFERER'));
    }
	
	function result()
    {
        $search_cond = $this->make_where();
		
        $this->out_put($search_cond);
    }
    private function out_put(&$params)
    {
        $pagesize = 10;
        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        if(isset($_GET['sort']) and $_GET['sort']=='lastlogin') $params['order']='lastlogin desc';
        if(isset($_GET['sort']) and $_GET['sort']=='credit') $params['order']='credit desc';
        if(isset($_GET['show'])) $pagesize = 20;
        
        $users = $this->member->search_list($page, $pagesize, 10, $params, 72);
		print_r($users);exit;
	}
	private function make_where()
    {
        if(empty($_SESSION['search_basecond'])) die();
        $search_cond = $_SESSION['search_basecond'];
        
        //居住地
        if(isset($search_cond['where']['work_province']) and intval($search_cond['where']['work_province'])<1) unset($search_cond['where']['work_province']);
        if(isset($search_cond['where']['work_city']) and intval($search_cond['where']['work_city'])<1) unset($search_cond['where']['work_city']);
        //高级搜索条件处理
        if(!empty($_SESSION['search_highcond']))
        {
            $search_cond +=$_SESSION['search_highcond'];
            if(isset($search_cond['where']['birth_province']) and intval($search_cond['where']['birth_province'])<1) unset($search_cond['where']['birth_province']);
            if(isset($search_cond['where']['birth_city']) and intval($search_cond['where']['birth_city'])<1) unset($search_cond['where']['birth_city']);
            //是否在线
            //if(!empty($_POST['online'])) $high_cond['where']['online'] = $_POST['online'];
            unset($search_cond['where']['online']);
            //搜索名称
            //if(!empty($_POST['search_name'])) $high_cond['where']['search_name'] = $_POST['search_name'];
            unset($search_cond['where']['search_name']);
            //是否发送邮件
            //if(!empty($_POST['sendmail'])) $high_cond['where']['sendmail'] = $_POST['sendmail'];
            unset($search_cond['where']['sendmail']);
        }
        return $search_cond;
    }
	
	
	
	
	
}