<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后台用户管理控制器
 *
 *@date			
 *@database 
 */
final class User_info extends CI_Controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('check');
		$this->load->model('member_model');
		
		$this->load->model('message');
		

	}
	
	public function index()
	{
	}
	
	
	
	/*推荐会员*/
	public function move_tops()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			if(isset($_POST['ids'])){
				if($_POST['mov_posid']=='-1'){$this->message->showmessage('请选择要要推荐的位置!',$this->input->server('HTTP_REFERER'));}
				$posids = (int)$_POST['mov_posid'];
				$ids = implode(',',$_POST['ids']); 
				$result = $this->member_model->get_posuser_list($ids);
				if(is_array($result)){
					$this->load->model('userpos_model');
					foreach($result as $value){
						$this->userpos_model->add_upos_list($posids, 0, strpos($value['avatar'],'default_')!==false?0:1, 
						array('uid'=>$value['uid'],'height'=>$value['height'],'nickname'=>$value['nickname'],'realname'=>$value['realname'],'sex'=>$value['sex'],'age'=>$value['age'],'work_province'=>$value['work_province'],'work_city'=>$value['work_city'],'degree'=>$value['degree'],'salary'=>$value['salary'],'avatar'=>$value['avatar']));
					}
					$this->message->showmessage('推荐成功!',$this->input->server('HTTP_REFERER'));
				}
				$this->message->showmessage('推荐出错，终止操作!',$this->input->server('HTTP_REFERER'));exit();
			}
			else{
				$this->message->showmessage('你还没有选择任何项!',$this->input->server('HTTP_REFERER'));exit();
			}
		}
	}
	
	/*展示会员列表*/
	public function user_list()
	{
		$sqlParam = "SELECT id, reg_time, nickname, sex, age, work_province, work_city, degree, salary, 
		avatar FROM user_info, user_login WHERE user_info.uid = user_login.id ORDER BY user_login.id DESC ";
		$countSql = "SELECT COUNT(*) FROM user_info, user_login WHERE user_info.uid = user_login.id ";
		$page = isset($_GET['page'])?$_GET['page']:1;
		$List = $this->member_model->user_list($page, 10, 10, $sqlParam, $countSql);
		if(is_array($List)){
		$data['userList'] = &$List[1];
		$data['pagestr'] = &$List[0];
		$this->load->model('userpos_model');
		$data['posList'] = $this->userpos_model->get_upos_list();
		
		$this->load->view('admin/user_info/list',$data);}
		
	}
	
	/*删除用户*/
	public function del_user()
	{
		
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			if(isset($_GET['id']) && !empty($_GET['id'])){
				    $id = intval($_GET['id']);
					$result = $this->news_model->drop_news($id);
					if($result){
						//删除文件
						$this->message->showmessage('删除成功!',$this->input->server('HTTP_REFERER'));
					}
					else{$this->message->showmessage('删除失败!',$this->input->server('HTTP_REFERER'));}
			}
		}
	}
	
	public function reset_pwd()
	{
		$uid = isset($_GET['id']) ? (int)$_GET['id'] : $this->message->showmessage('参数错误!',$this->input->server('HTTP_REFERER'));
		$user = $this->db->query('select username from user_login where id='.$uid.' limit 1')->row_array();
		if(isset($user['username'])){
		    $newPwd = sha1($user['username'].'123456');
			$this->db->where('id',$uid);
			$this->db->update('user_login', array('password'=>$newPwd));
			$this->message->showmessage('密码重置成功!为123456',$this->input->server('HTTP_REFERER'));
		}
	}
	
	public function post_msg()
	{
		if($_POST){
            $data['uid'] = $_SESSION['admin_user_id'];
            $data['tid'] = $_POST['tid'];
            $data['fname'] = '管理员';
            $data['tname'] = $_POST['tname'];
            $data['mdir'] = $this->swoole->model->UserMail->admin_dir;
            if(empty($_POST['title'])){
                Swoole_js::js_back('邮件主题不能为空！');
                exit;
            }
            $this->swoole->model->UserMail->newmail($data,$_POST['title'],$_POST['content']);
            Swoole_js::js_back('发送成功');
        }else{
            $this->swoole->tpl->assign('tid',$_GET['uid']);
            $param['select'] = 'nickname';
            $param['uid'] = $_GET['uid'];
            $nickname = $this->swoole->model->UserInfo->gets($param);
            $this->swoole->tpl->assign('tname',$nickname[0]['nickname']);
            $this->swoole->tpl->display('admin_sendmail.html');
        }
	}
	
	
	
	
	public function Upload()
	{
		$uploadDir = $this->config->item('SITEROOT') . '/static/uploads/news_img';
		$reUrl = $this->config->item('Domain') . 'static/uploads';
		$this->globalfunc->Upload_file($uploadDir,$reUrl );
	}
	
}