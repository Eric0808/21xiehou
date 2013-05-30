<?php
class user extends J_Controller
{
    var $uid;
    var $loginUrl = 'login/';
    function __construct()
    {
        parent::__construct();
		if($this->auth_user->is_login())
		{
            $this->uid = $this->auth_user->get_uid();
		}
		else
		{
			header('location:'.base_url().$this->loginUrl);
		}
		$this->load->model('message', 'msg');
        if(isset($_GET['tid']) and $_GET['tid']==$this->uid)
        {
            $this->msg->js_back('您不能对自己进行操作!');
            exit;
        }
    }
    /**
     * 我的邂逅，首页
     */
    function index()
    {
		$this->load->model('member_model', 'uinfo');
        if(!isset($_SESSION['user']))
        {
            $_SESSION['user'] = $this->uinfo->get_baseinfo($this->uid);
        }
		/*未读邮件数量*/
		$mailnum = $this->mp_cache->get('user_new_mail_'.$this->uid);//读取缓存
		if($mailnum === false)
		{
			$this->load->model('usermail');
			$mailnum['num'] = $this->usermail->getNewCount($this->uid);
			$this->mp_cache->write($mailnum, 'user_new_mail_'.$this->uid);//设置缓存
		}
		$data['mailNUM'] = $mailnum['num'];
		
		/*新礼物数量*/
		$giftnum = $this->mp_cache->get('user_new_gift_'.$this->uid);//读取缓存
		if($giftnum === false)
		{
			$this->load->model('usergift');
			$giftnum['num'] = $this->usergift->getNewCount($this->uid);
			$this->mp_cache->write($giftnum, 'user_new_gift_'.$this->uid);//设置缓存
		}
		$data['giftNUM'] = $giftnum['num'];
		
		/*我关注的数量*/
		$this->db->select('count(id) as num');
		$wcnum = $this->db->get_where('user_relation', array('uid'=>$this->uid, 'watched'=>1))->row_array();
        $data['wcNUM'] = $wcnum['num'];
		/*照片数量*/
		$this->db->select('count(id) as num');
		$pcnum = $this->db->get_where('user_picture', array('uid'=>$this->uid))->row_array();
        $data['pcNUM'] = $pcnum['num'];
		/*消息中心*/
		$this->load->model('feeds');
		$data['feeds'] = $this->feeds->get_msg($this->uid);
		
		
    }

}
?>
