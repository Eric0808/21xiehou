<?php
class Usermail extends CI_Model
{
	var $tname = 'mail_title';
	var $tname1 = 'mail_content';
	var $recycle_dir = 9; //垃圾箱
	var $trash_dir = 8;   //草稿箱
	var $admin_dir = 7;   //管理员信箱
	var $delete_dir = 4;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/* 获取邮件 */
	function getmail($id,$uid=null,$tid=null)
	{
		$whUID = $whTID = $sqlStr = '';
		$where = ' WHERE `id`=$id'
		if(!is_null($uid)) $whUID = ' AND `uid`=$uid';
		if(!is_null($tid)) $whTID = ' AND `tid`=$tid';
		$sqlStr = 'SELECT * FROM {$this->tname} LEFT JOIN {$this->tname1} ON {$this->tname}.`id`={$this->tname1}.`id` '
		$sqlStr .= $where.$whUID.$whTID;
		$sqlStr .= 'ORDER BY {$this->tname}.id desc';
		$result = $this->db->query($sqlStr)->result_array();
		if(empty($result)) return false;
		return $result[0];
	}
	
	/* 读邮件 */
	function readmail($id,$uid)
	{
		$mail = $this->db->get_where($this->tname, array('id'=>$id))->row_array();
		if($mail->tid!=$uid) exit('非法操作！');
		if($mail->mstatus==0)
		{	
			$this->db->where('id',$id);
			$this->db->update($this->tname, array('mstatus'=>1));
			$newmail = $this->mp_cache->get('user_new_mail_'.$uid);
			if($newmail!==false){
				$newmail['num'] -=1; 
				$this->mp_cache->write($newmail, 'user_new_mail_'.$uid);//设置缓存
			}
		}
		$content = $this->db->get_where($this->tname1, array('id'=>$id))->row_array();
		return $mail+$content;
	}
	
	/* 重新查询未读邮件 */
	function getNewCount($uid)
	{
		$this->db->select('count(id) as num');
		$result = $this->db->get_where($this->tname, array('tid'=>$uid,'mstatus'=>0,'mdir'=>0))->row_array();
		return $result['num'];
	}
	
	/* 移到回收站 */
	function removemail($id,$uid)
	{
		$this->db->where(array('id'=>$id, 'tid'=>$uid));
		return $this->db->update($this->tname, array('mdir'=>$this->recycle_dir));
	}
	
	/* 插入新邮件 */
	function newmail($data,$title,$content)
	{
		$tuser = $this->db->get_where('user_login',array('id'=>$data['tid']))->row_array();
		if(strpos($tuser['blacklist'],$data['uid'])!==false)
		{
			$this->load->model('message');
			$this->message->js_back('发送失败，您已被对方列入黑名单！');
			exit;
		}
		$newnum = $this->mp_cache->get('user_new_mail_'.$data['tid']);
		if($newnum!==false){
			$newnum['num'] +=1; 
			$this->mp_cache->write($newnum, 'user_new_mail_'.$data['tid']);//设置缓存
		}
		else{
			$num = $this->getNewCount($data['tid']);
			$this->mp_cache->write(array('num'=>$num+1), 'user_new_mail_'.$data['tid']);//设置缓存
		}
		$data['title'] = $title;
		$id = $this->db->insert($this->tname, $data);
		$this->db->insert($this->tname1, array('id'=>$id,'oid'=>$data['tid'],'content'=>$content));
		return $id;
	}
}
?>