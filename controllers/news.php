<?php
 class News extends N_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		
	}
	public function index()
	{
		$category = $this->mp_cache->get('category');//获取缓存数据
		if($category===false)
		{
			$this->load->model('news_model');
			$category = $this->news_model->select_all_cate();
			$this->mp_cache->write($category, 'category');//设置缓存
		}
		$data['cateall'] = $category;
		$data['subcate'] = array();
		//获取婚恋百科二级栏目
		foreach($category as $var)
		{
			if($var['fid']==1)
			$data['subcate'][] = $var;
		}
		$this->load->library('position');//加载推荐位类
		$data['position_1'] = $this->position->data('news', 1, 0, 2, 300);
		$data['position_2'] = $this->position->data('news', 2, 0, 9, 300);
		$setting=array('jquery-1.4.2', 'Scripts/swfobject_modified', 'jq.imgchange');
		$content = $this->load->view('news/index', $data, true);
		$this->layout('21邂逅网-婚恋网站|北京婚恋网站|北京最好的婚恋网站-婚恋百科', $content, $setting);
		return ;
	}
	
	public function cate($id=null)
	{
		if( ! is_null($id) ){
		
			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
			$this->load->model('news_model', 'news_info');
			$category = $this->mp_cache->get('category');//获取缓存数据
			
			if($category===false)
			{
				$category = $this->news_info->select_all_cate();
				$this->mp_cache->write($category, 'category');//设置缓存
			}
			$data['catid'] = $id;
			$data['catName'] = $category[$id]['catname'];
			$reData = $this->news_info->get_news_list($page, $pageSize = 30, $setPages = 10, $where="WHERE `catid`=$id", $order='ORDER BY `addtime` DESC', '`id`,`title`,`addtime`');
			if(empty($reData)) exit('栏目不存在或者无内容！');
			$data['list'] = $reData[1];
		    $data['pagestr'] = $reData[0];
			
			$this->load->library('position');//加载推荐位类
			//$data['position_1'] = $this->position->data('news', 1, 0, 2, 300);
			$setting=array();
			$content = $this->load->view('news/list', $data, true);
			$this->layout($category[$id]['catname'], $content, $setting);
			return ;
			
		}
		
		show_404();
	}
	
	public function show($id=null)
	{	
		header('Content-Type:text/html;charset=utf-8'); 
		if( ! is_null($id) ){
			
			$this->load->model('news_model', 'news_info');
			$showNews = $this->news_info->get_one($id);
			if(empty($showNews))
			{
				$this->layout('文章不存在或已删除！', 404);
				return;
			}
			//点击量+1
			$data['hits'] = $showNews['hits']+1;
			$this->news_info->click_add_num($id, $data['hits']);
			$category = $this->mp_cache->get('category');//获取栏目缓存数据
			if($category===false)
			{
				$category = $this->news_info->select_all_cate();
				$this->mp_cache->write($category, 'category');//设置栏目缓存
			}
			$data['catName'] = $category[$showNews['catid']]['catname'];
			$data['catID'] = $showNews['catid'];
			$showNews['content'] = $this->news_info->preg_keyword($showNews['content']);//匹配关键词
			$CONTENT_POS = strpos($showNews['content'], '[nextpage]');
			if($CONTENT_POS !== false) {
				$data['content'] = explode('[nextpage]', $showNews['content']);
				$data['content_num'] = count($data['content']);
			}
			else
			{
				$data['content'] = (array)$showNews['content'];
				$data['content_num'] = count($data['content']);
				//var_dump($data['content']);exit;
			}
			
			$data['title'] = $showNews['title'];
			$data['from'] =  $showNews['source'];
			$data['time'] =  $showNews['addtime'];
			$data['editer'] =  $showNews['editer'];
			unset($showNews);
			//相关文章
			//$data['relex_news'] = null;
			$relex = $this->news_info->relex_news($data['catID'], 10, '`id`,`title`');
			
			if(is_array($relex)&& count($relex)>0)
			{
				shuffle($relex);
				$data['relex_news'] =$relex ;
				//var_dump($data['relex_news']);exit;
			}
			
			$this->load->library('position');//加载推荐位类
			$data['position_1'] = $this->position->data('news', 1, 0, 2, 300);
			$setting=array();
			
			//print_r($data['content']);exit;//测试输出
			$view_content = $this->load->view('news/show', $data, true);
			$this->layout($data['title'], $view_content, $setting);
			return ;
		}
		
		$this->layout('文章不存在或已删除！', 404);
	}
	
	
	
}