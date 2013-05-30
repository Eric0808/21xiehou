<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *文章信息数据库映射类<>
 *@date			2013-04-26 18:46:00
 *@table        xh_admin_info 
 */
class News_model extends CI_Model { 

	private $tname = 'xh_news_info';
	private $tname1 = 'xh_news_cate';
	private $tname2 = 'xh_news_keywords';
   
    function __construct()
     {
         parent::__construct();
     }
	 
	 //增加内容
	function Addnews($sqlstr){
		$sqlstr=str_replace('table_info', $this->tname, $sqlstr);
		$this->db->query($sqlstr);
		$result = $this->db->insert_id();//返回插入时的ID
		return $result;
		
	}
	 
	/**
	 *批量匹配关键词
	 */
	public function preg_keyword($content)
    {
		$sqlStr = "SELECT * FROM {$this->tname2} ORDER BY `kgroups` DESC ";	
		$query = $this->db->query($sqlStr)->result_array();
		foreach($query as $var)
		{
			if(empty($var['links'])) $var['links'] = 'http://www.21xiehou.com/';
			$content = preg_replace("#{$var['keywords']}#i", "<a href={$var['links']}>{$var['keywords']}</a>", $content , 1);
		}
		return $content;
	}	
	
	/**
	 * 批量更新文章推荐位
	 */
	public function Update_posid_byid($ids, $posid)
	{
		$strSql = "UPDATE  {$this->tname} SET  `posids`='{$posid}'  WHERE `id` IN ({$ids})";
		$this->db->query($strSql);
		$num = $this->db->affected_rows();
		return $num;
	}
	
	/**
	 * 获取要推荐的新闻列表
	 */
	public function get_posnews_list($ids){
		
		$sqlStr = "SELECT * FROM {$this->tname} AS n LEFT JOIN (SELECT `catid` AS cid, `catname` FROM {$this->tname1} ) AS c ON n.catid = c.cid  WHERE `id` IN ({$ids})";	
		$query = $this->db->query($sqlStr)->result_array();
		return $query;
		
		
	}
	
	/**
	 * 获取文章信息BY id
	 */
	public function get_one($id, $select='*')
	{
		$this->db->select($select);
		$this->db->limit(1);
		$query = $this->db->get_where($this->tname, array('id'=>$id));
		if($query->num_rows>0)
		{
			return $query->row_array();
		}
		
	}
	/**
	 * 获取相关文章
	 */
	public function relex_news($catid,$limit,$select)
	{
		$this->db->cache_on(3600);
		$this->db->select($select);
		$this->db->limit($limit);
		$query = $this->db->get_where($this->tname, array('catid'=>$catid));
		$this->db->cache_off();
		if($query->num_rows>0)
		{
			return $query->result_array();
		}
		
	}

	/**
	 * 更新文章点击数
	 */
	public function click_add_num($id, $num)
	{
		$strSql = "UPDATE  {$this->tname} SET  `hits`='{$num}'  WHERE `id` ={$id}";
		$this->db->query($strSql);
		$result = $this->db->affected_rows();
		return $result;
		
	}
	
	
	/**
	 * 获取新闻列表
	 */
	public function get_news_list($page = 1, $pageSize = 20, $setPages = 10, $where='', $order='', $select='*'){
		$this->db->cache_on(3600);
		$sqlStr = "SELECT {$select} FROM {$this->tname} AS n LEFT JOIN (SELECT `catid` AS cid, `catname` FROM {$this->tname1} ) AS c ON n.catid = c.cid ";
		$sqlStr1 = "SELECT COUNT(*) FROM {$this->tname} as n {$where} ";
		$allnum=$this->get_news_num($sqlStr1);
		$page = max(intval($page), 1);
		$offset = $pageSize*($page-1);
		$query[0] =$this->globalfunc->pages($allnum, $page, $pageSize,$setPages);
		if($allnum >0){
			$sqlStr .= " $where $order LIMIT $offset, $pageSize";
			
			$query[1] = $this->db->query($sqlStr)->result_array();
			$this->db->cache_off();
			return $query;
		}		
		else
		return null;
		
	}
	/**
	 * 根据条件获取所有新闻内容的数量
	 */
	public function get_news_num($sqlStr){
	
		$num = $this->db->query($sqlStr)->row_array();
		return $num['COUNT(*)'];
	}
	
	/**
	 * 删除文章
	 */
	public function drop_news($newsid){
	
		$statu = $this->db->delete($this->tname, array('id'=>$newsid));
		return $statu;
	}
	
	/**
	 * 删除类别
	 */
	public function drop_cate($cateid){
		//判断是否包含子栏目
		$subNUM = $this->sub_num($cateid);
		$statu = $this->db->delete($this->tname1, array('catid'=>$cateid));
		if($statu && $subNUM>0){
			$statu = $this->db->delete($this->tname1, array('fid'=>$cateid));
		}
		return $statu;
	}
	
	/**
	 * 获取类别下子类别的数量
	 */
	public function sub_num($catid)
	{
		$sqlStr = "SELECT COUNT(*) FROM {$this->tname1} WHERE `fid`={$catid} ";
		$num = $this->db->query($sqlStr)->row_array();
		return $num['COUNT(*)'];
	}
	
	/*获取最上级栏目信息*/
	public function getcategory(){
		$sqlStr = "SELECT * FROM  $this->tname1 WHERE  `fid` =0 ORDER BY listorder ASC ";
		$this->db->cache_on(3600);
		$query = $this->db->query($sqlStr)->result();
		$this->db->cache_off();
		return $query;
		
	}
	
	/*获取所有栏目信息*/
	public function get_all_cate()
	{
		$restr='';
		$sqlStr = "SELECT * FROM  $this->tname1 WHERE  `fid` =0 ORDER BY listorder ASC ";
		$this->db->cache_on(3600);
		$query = $this->db->query($sqlStr)->result_array();
		$this->db->cache_off();
		foreach($query as $key=>$value)
		{
			if($this->getsubid($value['catid'])!='')
			{
				$restr.='<option value="'.$value['catid'].'|'.$value['catname'].'" disabled>'.$value['catname'].'</option>\n';
				$restr.=$this->getsubid($value['catid']).'\n';
			}
			else
			{
				$restr.='<option value="'.$value['catid'].'|'.$value['catname'].'" >'.$value['catname'].'</option>\n';
			}
			
		}
		return $restr;
	}
	
	
	public function select_all_cate()
	{
		$sqlStr = "SELECT * FROM  $this->tname1 ORDER BY listorder ASC ";
		$query = $this->db->query($sqlStr);
		$reArr = null;
		if($query->num_rows!==0)
		{
			foreach($query->result_array() as $key=>$value)
			{
				$reArr[$value['catid']] = $value;
			}
			return $reArr;
		}
		return $reArr;
	}
	
	/*根据上级ID获取下级子ID-select树级结构
	*/
	function getsubid($catid){
		$restr='';
		
		$this->db->cache_on(3600);
		$this->db->order_by("listorder", "ASC"); 
		$arrSub = $this->db->get_where($this->tname1, array('fid'=>$catid));
		$this->db->cache_off();	
		if($arrSub->num_rows!==0)
		{
			foreach($arrSub->result_array() as $key=>$query){
				$restr.='<option value="'.$query['catid'].'|'.$query['catname'].'">&nbsp;&nbsp;&nbsp;└─ '.$query['catname'].'</option>\n';
			}
		}
		return $restr;
		
	}
	
	/*根据上级ID获取下级子ID-table树级结构
	*/
	function getsubid_bycatid($catid , $level=0){
		$sublists=array();
		$restr='<tr class="hover" >';
		$tree=$this->maketree_bylevel($level);
		if($catid!=0 && $level>=0){
			$this->db->cache_on(3600);
			$this->db->order_by("listorder", "ASC"); 
			$arrSub = $this->db->get_where($this->tname1, array('fid'=>$catid))->result_array();
            $this->db->cache_off();			
			foreach($arrSub as $key=>$query){
				
				$restr.='<td width="10px"><a class="showchild" style="display:none;" catid="'.$query['catid'].'" upid="'.$catid.'" href="javascript:return return;">+</a></td>';
				
				$restr.='<td width="60px"><input name="display['.$query['listorder'].']" type="text" size="2" value="'.$query['listorder'].'" /></td>';
				$restr.='<td width="200px">'.$tree.'<input type="text" class="txtnobd" onblur="this.className=\'txtnobd\'" onfocus="this.className=\'txt\'" size="25" name="name['.$query['catid'].']" value="'.$query['catname'].'"></td>';
				$restr.='<td width="300px"><input type="text" name="description['.$query['catid'].']" value="'.$query['description'].'" size="35"></td>';
			
				$restr.='<td><font class="tips2">(catid:'.$query['catid'].')</font></td><td> [<a href="category/deletecate?catid='.$query['catid'].'">删除</a>]
				[<a href="category/editcate?catid='.$query['catid'].'">编辑</a>]</td></tr>';
				
				//echo $restr;exit;
				//$restr.=$query['id'].$query['subid'].$query['pid'];
			}
			$restr.='</tr>';
		}
		return $restr;
		
	}
	
	//增加新的一级栏目
	function addcate($sqlstr){
		$sqlstr=str_replace('table_info',$this->tname1,$sqlstr);
		$this->db->query($sqlstr);
		$result = $this->db->insert_id();//返回插入时的ID
		return $result;
		
	}
	
	/*根据级别显示不同树形图
	*/
	function maketree_bylevel($level){
		$treestr='|----';
		if($level>0)
		{
			for($i=0; $i<$level;$i++){
				$treestr.='---';
			}
			return $treestr;
		}
		else if($level==0){
			return $treestr;
		}
		else
		return '';
	}
	
	
	
}
