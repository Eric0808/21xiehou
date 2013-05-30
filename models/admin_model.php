<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *管理员信息数据库映射类<>
 *@date			2013-04-26 18:46:00
 *@table        xh_admin_info 
 */
class Admin_model extends CI_Model { 

	private $tname = 'xh_admin_info';
   
    function __construct()
     {
         parent::__construct();
     }
	
	/**
	 * 添加管理员
	 * @param string $uname 用户名
	 * @param string $truename 真实性名
	 * @param string $pwd 密码
	 * @param int $roleid 角色ID
	 */
	public function insert_admin($uname, $truename, $pwd, $roleid)
	{
		$data['username'] = htmlspecialchars($uname);
		$data['realname'] = htmlspecialchars($truename);
		$data['password'] = $pwd;
		$data['roleid'] = $roleid;
		$result = $this->db->insert($this->tname, $data);
		return $this->db->insert_id();
	}
	
	/**
	 * 获取管理员信息
	 * @param string $username 用户名
	 */
	public function get_admin_info($username)
	{
		$username = htmlspecialchars($username);
		$sqlStr = "SELECT * FROM {$this->tname} WHERE `username`='{$username}'";
		return $this->db->query($sqlStr)->row_array();
	}
	
	/**
	 * Ajax检查密码--修改密码
	 * @param string $uid 用户ID
	 * @param string $oldpwd 用户密码
	 */
	public function ajax_check_oldpwd($uid, $oldpwd)
	{
		$uid = (int)$uid;
		$query = $this->db->get_where($this->tname,array('userid'=>$uid),1);
		if($query->num_rows===0)
		{return false;}
		$data = $query->row_array();
		if($data['password']==$oldpwd)
		return true;
		else return false;
	}
	
	/**
	 * Ajax检查用户名是否存在--添加管理员
	 * @param string $uname 用户名
	 */
	public function ajax_check_uname($uname)
	{
		$uname = htmlspecialchars($uname);
		$query = $this->db->get_where($this->tname,array('username'=>$uname),1);
		if($query->num_rows===0)
		return true;
		else return false;
	}
	
	/**
	 * 更新密码--修改密码
	 * @param string $uid 用户ID
	 * @param string $newpwd 新密码
	 */
	public function update_pwd($uid, $newpwd)
	{
		$uid = (int)$uid;
		$this->db->where('userid', $uid);
		$query = $this->db->update($this->tname, array('password'=>$newpwd));
		return $query;
	}
}
