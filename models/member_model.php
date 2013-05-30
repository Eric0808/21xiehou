<?php

final class member_model extends CI_Model
{
	
	private $tname1 = 'user_info';
	private $tname = 'user_login';
	private $tname2 = 'user_detail';
	private $tname3 = 'reg_stat_blogs';
	private $tname4 = 'user_invite';
	private $info_select = 'user_info.uid as uid,nickname,avatar,marriage,work_province,work_city,sex,age,height,degree,job,salary,intro,vip,lastlogin';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function get_user_info($param, $type = 'email')
	{
		$param = htmlspecialchars($param);
		$param = $this->db->escape($param);
		if($type === 'email')
		$sqlStr = "SELECT id,password,username,nickname FROM user_login ,user_info WHERE `username`={$param} and user_login.`id`= user_info.`uid` LIMIT 1";
		else
		$sqlStr = "SELECT id,password,username,nickname FROM user_login ,user_info WHERE `mobile`={$param} and user_login.`id`= user_info.`uid` LIMIT 1";
		return $this->db->query($sqlStr)->row_array();
	}
	
	public function exists_uname($uname)
	{
		$uname = htmlspecialchars($uname);
		$uname = $this->db->escape($uname);
		$sqlStr = "SELECT `id` FROM {$this->tname} WHERE `username`={$uname} ";
		$num = $this->db->query($sqlStr)->num_rows;
		if($num===0) return 0;
		
		return 1;
	}
	public function exists_common($param, $data)
	{
		$data = $this->db->escape($data);
		$sqlStr = "SELECT `uid` FROM {$this->tname1} WHERE `{$param}`={$data} ";
		$num = $this->db->query($sqlStr)->num_rows;
		
		if($num===0) return 0;
		
		return 1;
	}
	
	public function reg_stat($data)
	{
		$this->db->insert($this->tname3, $data);
		return $this->db->insert_id();
	}
	
	public function add_login_info($data)
	{
		$this->db->insert($this->tname, $data);
		return $this->db->insert_id();
	}
	
	public function add_invite($data)
	{
		$this->db->insert($this->tname4, $data);
		return $this->db->insert_id();
	}
	
	public function insert($data,$tbname)
	{
		$this->db->insert($tbname, $data);
		return $this->db->insert_id();
	}
	
	public function select_userdata($select, $where, $limit, $tbname)
	{
		$this->db->select($select);
		$this->db->limit($limit);
		return $this->db->get_where($tbname, $where)->result_array(); 
	}
	
	public function update_userdata($data, $where, $tbname)
	{
		if(!empty($data) and is_array($data)){
			$this->db->where($where);
			return $this->db->update($tbname, $data);
		}
		return false;
	}
	
	public function get_baseinfo($uid)
	{
		$baseInfo = $this->mp_cache->get('ubase_info_'.$uid);//获取缓存数据
		if($baseInfo===false)
		{
			$this->db->limit(1);
		    $baseInfo = $this->db->get_where($this->tname1, array('uid'=>$uid))->row_array(); 
			if(empty($baseInfo['avatar'])) $baseInfo['avatar'] = '/static/images/default_'.$baseInfo['sex'].'.png';
			$baseInfo['sex_id'] = $baseInfo['sex'];
			$baseInfo['sex'] = $baseInfo['sex']==1 ? '女' : '男';
			$this->mp_cache->write($baseInfo, 'ubase_info_'.$uid);//设置缓存
		}
		return $baseInfo;
	}
	
	/**
	 * 获取要推荐的会员列表
	 */
	public function get_posuser_list($ids){
		
		$sqlStr = "SELECT uid, height, nickname,realname, sex, age, work_province, work_city, degree, salary, 
		avatar FROM {$this->tname1} WHERE `uid` IN ({$ids}) ORDER BY uid DESC ";	
		$query = $this->db->query($sqlStr)->result_array();
		foreach($query as &$value){@self::parseInfo($value);}
		return $query;
	}
	
	public function user_list($page = 1, $pageSize = 20, $setPages = 10, &$sqlStr='', $sqlStr1=''){
	
		$this->db->cache_on(600);
		$allnum=$this->get_num($sqlStr1);
		$page = max(intval($page), 1);
		$offset = $pageSize*($page-1);
		$query[0] =$this->globalfunc->pages($allnum, $page, $pageSize,$setPages);
		if($allnum >0){
			$sqlStr .= " LIMIT $offset, $pageSize";
			$query[1] = $this->db->query($sqlStr)->result_array();
			$this->db->cache_off();
			//$this->benchmark->mark('code_start');
			foreach($query[1] as &$value){@self::parseInfo($value);}
			//$this->benchmark->mark('code_end');
			//echo $this->benchmark->elapsed_time('code_start', 'code_end');
			return $query;
		}		
		else
		return null;
		
	}
	
	public function search_list($page = 1, $pageSize = 20, $setPages = 10, &$param, $intro_len = 22){
		$select = isset($param['select']) ? $param['select'] : $this->info_select;
		$from = 'user_info,user_detail';
		$where = '';
		$this->db->cache_on(600);
		$allnum=$this->search_count($param);
		$page = max(intval($page), 1);
		$offset = $pageSize*($page-1);
		$query[0] =$this->globalfunc->pages($allnum, $page, $pageSize,$setPages, false);
		if($allnum >0){
			$this->db->select($this->info_select);
			//$this->db->from('user_info');
			$this->db->join('user_detail', 'user_info.uid=user_detail.uid');
			if(isset($param['order'])){
			$this->db->order_by($param['order']);}
			else{$this->db->order_by('rank desc');}
			$this->db->limit($pageSize, $offset);
			$query[1] = $this->db->get_where('user_info', $param['where'])->result_array();
			$this->db->cache_off();
			foreach($query[1] as &$value){@self::parseInfo($value, $intro_len);}
			
			return $query;
		}		
		else
		return null;
		
	}
	private function search_count(&$param)
	{
		$this->db->select('uid');
		$this->db->from('user_info');
        $this->db->join('user_detail', 'user_info.uid=user_detail.uid');
		$this->db->where($param['where']);
		return $this->db->count_all_results();
	}
	
	public function get_num($sqlStr){
		$num = $this->db->query($sqlStr)->row_array();
		return $num['COUNT(*)'];
	}
	
	private function parseInfo(&$user, $intro_len=22)
	{
		$this->load->model('Arr_user_info','dict');
		$userinfo_dict = $this->dict->user_info();
		if(empty($user['avatar'])) $user['avatar']='/static/images/default_'.$user['sex'].'.png';
		
		$user['sex'] = $userinfo_dict['sex'][$user['sex']];
		$user['height'] = $userinfo_dict['height'][$user['height']];
		$user['degree'] = $userinfo_dict['degree'][$user['degree']];
		$user['salary'] = $userinfo_dict['salary'][$user['salary']];
		$user['marriage'] = $userinfo_dict['marriage'][$user['marriage']];
		$user['job'] = $userinfo_dict['job'][$user['job']];
		$user['work_province'] = $userinfo_dict['province'][$user['work_province']];
		$user['work_city'] = $userinfo_dict['city'][$user['work_city']];
		if(isset($user['intro'])){
		$user['intro'] = empty($user['intro'])?'暂无':mb_substr($user['intro'],0,$intro_len);
		}
	}
	
	
}
