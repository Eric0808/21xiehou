<?php

final class Menu_model extends CI_Model
{
	public function __construct()
	{
		$this->load->model('role_model');
	}
	
	public function get_site_menu()
	{
		return array(
			'user/index' => '我的邂逅',
			'search/index' => '爱情搜索',
			'teacher' => '婚姻顾问',
			'man' => '精英男士',
			'woman' => '名媛淑女',
			'news' => '婚恋百科',
			'cgal' => '成功案例'
		);
	}
	
	public function getAbout()
	{
		return array(
			26 => array('title'=>'公司简介', 'name'=>'公司简介', 'html'=>'gsjj'),
			38 => array('title'=>'发展历程', 'name'=>'发展历程', 'html'=>'fzlc'),
            27 => array('title'=>'媒体报道', 'name'=>'媒体报道', 'html'=>'mtbd'),
            39 => array('title'=>'公司资质', 'name'=>'公司资质', 'html'=>'gszl'),
			40 => array('title'=>'公司环境', 'name'=>'公司环境', 'html'=>'gshj'),
            29 => array('title'=>'服务声明', 'name'=>'服务声明', 'html'=>'fwsm'),
			30 => array('title'=>'隐私保护', 'name'=>'隐私保护', 'html'=>'ysbh'),
			35 => array('title'=>'邂逅帮助', 'name'=>'邂逅帮助', 'html'=>'xhbz'),
			41 => array('title'=>'服务流程', 'name'=>'服务流程', 'html'=>'fwlc'),
			34 => array('title'=>'意见反馈', 'name'=>'意见反馈', 'html'=>'yjfk'),
			37 => array('title'=>'联系我们', 'name'=>'联系我们', 'html'=>'lxwm'),
			33 => array('title'=>'诚聘英才', 'name'=>'诚聘英才', 'html'=>'cpyc'),
			36 => array('title'=>'友情链接', 'name'=>'友情链接', 'html'=>'yqlj'),
			28 => array('title'=>'网站合作', 'name'=>'网站合作', 'html'=>'wzhz'),
			31 => array('title'=>'网站地图', 'name'=>'网站地图', 'html'=>'wzdt'),
		);
	}
	public function getUserCenter()
	{
		return array(
			'user' => '会员中心',
			'scores' => '历史成绩',
            'wrong' => '我的错题',
            'remove' => '排除的题',
			'user/change' => '修改信息',
            'user/password' => '修改密码',
			'user/logout' => '退出登录'
		);
	}
	
	public function get_admin_menu()
	{
		return array(
			'管理员管理'=>array(
				array('c'=>'admin/admin_info','a'=>'add_admin','name'=>'添加管理员','isshow'=>true),
				array('c'=>'admin/admin_info','a'=>'update_pwd','name'=>'修改密码','isshow'=>true),
				array('c'=>'admin/login','a'=>'logout','name'=>'退出登录','isshow'=>true)),
			'角色管理'=>array(
				array('c'=>'admin/role_info','a'=>'add_role','name'=>'添加角色','isshow'=>true),
				array('c'=>'admin/role_info','a'=>'role_list','name'=>'角色列表','isshow'=>true),
				array('c'=>'admin/role_info','a'=>'role_update','name'=>'编辑角色','isshow'=>false),
				array('c'=>'admin/role_info','a'=>'role_del','name'=>'删除角色','isshow'=>false)),
			'会员管理'=>array(
				array('c'=>'admin/user_info','a'=>'user_list','name'=>'会员列表','isshow'=>true),
				array('c'=>'admin/role_info','a'=>'role_list','name'=>'待审核的会员','isshow'=>true),
				array('c'=>'admin/user_pos','a'=>'add_pos','param'=>'?type=0','name'=>'添加会员推荐位','isshow'=>true),
				array('c'=>'admin/user_pos','a'=>'del_pos','name'=>'删除推荐位','isshow'=>false),
				array('c'=>'admin/user_pos','a'=>'pos_list','name'=>'会员推荐管理','isshow'=>true),
				array('c'=>'admin/user_pos','a'=>'detail_pos','name'=>'推荐信息列表','isshow'=>false),
				array('c'=>'admin/user_pos','a'=>'edit_pos','name'=>'编辑推荐位','isshow'=>false)),	
			'内容管理'=>array(
				array('c'=>'admin/news_info','a'=>'Add_news','name'=>'发布文章','isshow'=>true),
				array('c'=>'admin/news_info','a'=>'news_list','name'=>'文章列表','isshow'=>true),
				array('c'=>'admin/news_info','a'=>'del_news','name'=>'删除文章','isshow'=>false),
				array('c'=>'admin/news_info','a'=>'update_news','name'=>'更新文章','isshow'=>false),
				array('c'=>'admin/news_info','a'=>'upload_file','name'=>'上传图片','isshow'=>false),
				array('c'=>'admin/news_info','a'=>'news_cates','name'=>'内容分类管理','isshow'=>true),
				array('c'=>'admin/news_info','a'=>'add_cates','name'=>'添加分类','isshow'=>false),
				array('c'=>'admin/news_info','a'=>'del_cates','name'=>'删除分类','isshow'=>false),
				array('c'=>'admin/news_info','a'=>'update_cates','name'=>'更新分类','isshow'=>false),
				array('c'=>'admin/news_pos','a'=>'add_pos','name'=>'添加推荐位','isshow'=>true),
				array('c'=>'admin/news_pos','a'=>'del_pos','name'=>'删除推荐位','isshow'=>false),
				array('c'=>'admin/news_pos','a'=>'pos_list','name'=>'推荐位管理','isshow'=>true),
				array('c'=>'admin/news_pos','a'=>'detail_pos','name'=>'推荐信息列表','isshow'=>false),
				array('c'=>'admin/news_pos','a'=>'edit_pos','name'=>'编辑推荐位','isshow'=>false)),
			'站点广告'=>array(
				array('c'=>'admin/ads_info','a'=>'Addads','name'=>'添加广告位','isshow'=>true),
				array('c'=>'admin/ads_info','a'=>'Adslist','name'=>'广告列表','isshow'=>true),
				array('c'=>'admin/ads_info','a'=>'deleteby_id','name'=>'删除广告位','isshow'=>false),
				array('c'=>'admin/ads_info','a'=>'edit_byid','name'=>'编辑广告位','isshow'=>false)),
			'友情链接'=>array(
				array('c'=>'admin/link_info','a'=>'link_list','name'=>'友情链接列表','isshow'=>true),
				array('c'=>'admin/link_info','a'=>'Newlinks','name'=>'添加友情链接','isshow'=>false),
				array('c'=>'admin/link_info','a'=>'Dellink','name'=>'删除友情链接','isshow'=>false))		
		);
	}
	
	public function get_menu_byid($roleid)
	{	
		$reArr = array();
		$roleInfo = $this->role_model->get_role_info($roleid);
		
		$allMenu = $this->get_admin_menu();
		foreach($allMenu as $key=>$menu){
			foreach($menu as $item){
			   if(in_array($item['a'], $roleInfo) && $item['isshow']==true){
					$reArr[$key][] =$item; 
			   }
			}
		}
		return $reArr;
	}
}
