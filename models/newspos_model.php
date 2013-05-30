<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *新闻推荐位数据库映射类<>
 *@date			2013-04-26 18:46:00
 *@table        xh_admin_role 
 */
class Newspos_model extends CI_Model { 

	private $tname = 'xh_news_position';
	private $tname1 = 'xh_news_pdata';
   
    function __construct()
     {
         parent::__construct();
     }
	
	/**
	 * 添加推荐信息
	 */
	public function add_npos_list($posid, $catid, $thumb, $data)
	{
		$dataInfo['catid'] = $catid;
		$dataInfo['posid'] = $posid;
		$dataInfo['thumb'] = !empty($thumb) ? 1 : 0;
		$dataInfo['data'] = $this->globalfunc->array2string($data, 0);
		$this->db->insert($this->tname1, $dataInfo);
		return $this->db->insert_id();
	}
	/**
	 * 获取推荐信息-前台
	 */
	public function get_pos_data($posid, $isthumb, $num, $cachetime, $where, $order)
	{
		$this->db->cache_on($cachetime);
		$sqlStr = "SELECT * FROM {$this->tname1} AS n LEFT JOIN (SELECT `catid` AS cid, `catname` FROM xh_news_cate ) AS c ON n.catid = c.cid ";
		$sqlStr .= " $where $order LIMIT $num ";
		$query = $this->db->query($sqlStr);
		$data = $this->db->query($sqlStr)->result_array();
		$this->db->cache_off();
		if($query->num_rows>0)
		{
			foreach($data as $key=>$var)
			{
				$data[$key]['data'] = $this->globalfunc->string2array($var['data']);
			}
			
			return $data;
		}
	}
	
	/**
	 * 推荐信息--后台管理
	 */
	public function npos_list_byid($page = 1, $pageSize = 20, $setPages = 10, $where='', $order=''){
		
		$sqlStr = "SELECT * FROM {$this->tname1} AS n LEFT JOIN (SELECT `catid` AS cid, `catname` FROM xh_news_cate ) AS c ON n.catid = c.cid ";
		$sqlStr1 = "SELECT COUNT(*) FROM {$this->tname1} as n {$where} ";
		$allnum=$this->get_pnews_num($sqlStr1);
		$page = max(intval($page), 1);
		$offset = $pageSize*($page-1);
		$query[0] =$this->globalfunc->pages($allnum, $page, $pageSize,$setPages);
		if($allnum >0){
			$sqlStr .= " $where $order LIMIT $offset, $pageSize";	
			$query[1] = $this->db->query($sqlStr)->result_array();
			return $query;
		}		
		else
		return null;
		
	}
	/**
	 * 按推荐位获取所有新闻内容的数量
	 */
	public function get_pnews_num($sqlStr){
	
		$num = $this->db->query($sqlStr)->row_array();
		return $num['COUNT(*)'];
	}
	
	/**
	 * 获取推荐位列表
	 */
	public function get_npos_list($where = '')
	{
		$sqlStr = "SELECT * FROM {$this->tname} {$where} ORDER BY `listorder` ASC ";
		return $this->db->query($sqlStr)->result_array();
	}
	
	/**
	 * 添加新闻推荐位
	 * @param array $posinfo 推荐位信息
	 */
	public function insert_npos($posinfo)
	{
		$this->db->insert($this->tname, $posinfo);
		return $this->db->insert_id();
	}
	
	/**
	 * 排序
	 */
	public function makeOrder($id, $updatevalue)
	{
		if(is_numeric($id)){
			$this->db->where('id', $id);
			$result=$this->db->update($this->tname1, array('listorder'=>$updatevalue)); 
			return $result;
		}
		else
		return false;
	}
	
	/**
	 * 移除推荐位
	 */
	public function makeOut1($id)
	{	
		if(is_numeric($id)){
			$tables=array($this->tname,$this->tname1);
			$this->db->where('posid', $id);
			$result=$this->db->delete($tables);		
			return $result;
		}
		else
		return false;
	}
	
	/**
	 * 查询是否有推荐信息
	 */
	public function posnews_count($id){
		$sqlStr = "SELECT * FROM $this->tname1 WHERE posid = $id";
		$result = $this->db->query($sqlStr)->num_rows();
		return $result;
	}
	/**
	 * 移除推荐信息
	 */
	public function makeOut($id)
	{
		if(is_numeric($id)){
			$this->db->where('id', $id);
			$result=$this->db->delete($this->tname1); 
			return $result;
		}
		else
		return false;
	}
		
	
}
