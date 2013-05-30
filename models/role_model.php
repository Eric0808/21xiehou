<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *角色数据库映射类<>
 *@date			2013-04-26 18:46:00
 *@table        xh_admin_role 
 */
class Role_model extends CI_Model { 

	private $tname = 'xh_admin_role';
	private $tname1 = 'xh_admin_role_priv';
   
    function __construct()
     {
         parent::__construct();
     }
	
	/**
	 * 获取角色列表
	 */
	public function get_role_list()
	{
		$sqlStr = "SELECT * FROM {$this->tname} ";
		return $this->db->query($sqlStr)->result_array();
	}
	
	/**
	 * 获取角色的控制器函数信息
	 * @param $roleid 角色ID
	 */
	public function get_role_info($roleid, $isall =false)
	{
		$reArr = array();
		if(is_numeric($roleid) && $roleid>0){
			$this->db->cache_on(3600);
			$sqlStr = "SELECT * FROM {$this->tname1} Where `roleid`={$roleid} ";
			$data = $this->db->query($sqlStr)->result_array();
			$this->db->cache_off();
			if( !$isall && count($data)!= 0 ){
				foreach($data as $item){
					$reArr[] = $item['a'];
				}
			}
			else{
				return $data;
			}
		}
	    return $reArr;
	}
	
	/**
	 * 添加角色
	 * @param array $roleinfo 角色信息
	 */
	public function insert_role($roleinfo)
	{
		$result = $this->db->insert($this->tname, $roleinfo);
		return $this->db->insert_id();
	}
	
	/**
	 * 添加角色控制权限
	 * @param int $roleid 角色ID
	 * @param string $c 控制器
	 * @param string $a 操作函数
	 */
	public function insert_priv($roleid, $c, $a)
	{
		$result = $this->db->insert($this->tname1, array('roleid'=>$roleid,'c'=>$c,'a'=>$a));
		return $this->db->insert_id();
	}
	
	/**
	 * 获取角色信息
	 */
	public function get_role_info_byroleid($role_id)
	{
		$sqlStr = "SELECT * FROM $this->tname WHERE roleid=$role_id";
		$result = $this->db->query($sqlStr)->row_array();
		return $result;
	}
	/**
	 * 更新角色信息
	 */
	public function update_role_info($role_id,$array_role)
	{	
		$this->db->where('roleid',$role_id);
		$result = $this->db->update($this->tname,$array_role);
		$this->db->cache_delete('/admin', 'role_info');
		return $result;		
	}
	/**
	 * 删除角色的控制器函数信息
	 * @param $roleid 角色ID
	 */
	public function del_role($role_id)
	{
		$this->db->where('roleid', $role_id);
		$result=$this->db->delete($this->tname1);
		return $result;
	}
	
    /**
	 * 删除角色
	 */
 	function del_info($id)
 	{	
 		$tables = array($this->tname,$this->tname1);
		$this->db->where('roleid',$id);
		return $this->db->delete($tables);
 	}
	
}
