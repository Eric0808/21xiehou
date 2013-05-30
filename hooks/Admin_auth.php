<?php
/** * * 后台权限拦截钩子  
 * @author Eric
 *  
 */ 


class Admin_auth {
     
    private $CI;
	
    public function __construct() {         
        $this->CI = &get_instance();
		
    }   
	
    /**
	* 权限认证     
	*/ 
    public function auth() {         
        $this->CI->load->helper('url');
		$this->CI->load->model('role_model', 'objrole');
		if(strpos(uri_string(), 'admin')!==false && count(explode('/', uri_string()))==3 && strpos(uri_string(), 'welcome')===false){
			header("Content-type: text/html; charset=utf-8");
			$roleID = isset($_SESSION['adminroleid'])? (int)$_SESSION['adminroleid'] : -1;
			if($roleID===1){return;}
			if($roleID!=-1){
				$arrOption = $this->CI->objrole->get_role_info($roleID);
				$urlOption = explode('/', uri_string());
				if(!empty($arrOption) && !in_array($urlOption[2], $arrOption)){
				Exit('您没有此功能的权限！禁止越权操作');
				}
			}
			else
			Exit('您没有此功能的权限！禁止越权操作');
		}            
    }         
}

?>