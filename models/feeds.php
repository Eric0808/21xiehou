<?php
class Feeds extends CI_Model
{
	var $tname = 'user_feeds';
	
    public function __construct()
	{
		parent::__construct();
	}
		
	/*function send($type,$uid,$tid=0,$event_id=0)
	{
		$id = $this->put(array('ftype'=>$type,'uid'=>$uid,'tid'=>$tid,'eventid'=>$event_id));
		$user = $this->swoole->model->UserInfo->getBase($uid);
		$this->db->query("update {$this->table} set nickname='{$user['nickname']}' where id=$id");
		if($tid!==0)
		{
			$feed_type = SiteDict::get('feed_type');
			$user['info'] = $feed_type[$type][0];
			$user['look'] = $feed_type[$type][1];
			$user['link'] = $feed_type[$type][2];
			$user['event'] = $event_id;
			//UserMsg::insertMsg($tid,'feeds',$user);
		}
	}*/
	function get_msg($uid)
	{
		$this->db->limit(10);
		$list = $this->db->get_where($this->tname, array('tid'=>$uid))->result_array();
		$c = count($list)<10;
		if($c)
		{
			$list += $this->db->query("select * from {$this->tname} where uid in (select uid from user_relation where tid={$uid} and watched=1) and tid = {$uid} order by id desc limit ".(16-$c))->result_array();
		}
		return $list;
	}

	function concern($uid)//所关注我的人的个数
	{
		$list = $this->db->query("select count(*) from user_feeds where uid = $uid and ftype = 'concern' ");
		return $list->fetch();
	}
	
}
?>