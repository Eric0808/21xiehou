<?php
class Usergift extends CI_Model
{
	var $tname = 'gift_send';
	
    public function __construct()
	{
		parent::__construct();
	}
		
	/* 重新查询未读礼物数量 */
	function getNewCount($uid)
	{ 
		$this->db->select('count(id) as num');
		$result = $this->db->get_where($this->tname, array('tid'=>$uid,'ischeck'=>0))->row_array();
		return $result['num'];
	}
	
}
?>