<?php 
class Globalfunc
{
	//@set_time_limit(0);
	public function __construct()
	{
		
	}
	
	function howLongAgo($datetime)
	{
		$seconds = time() - strtotime($datetime);
		$time = intval($seconds/31104000);
		if($time>=1) return $time.'年前';
		$time = intval($seconds/2592000);
		if($time>=1) return $time.'个月前';
		$time = intval($seconds/86400);
		if($time>=1)
		{
			if($time==1) return '昨天';
			if($time==2) return '前天';
			return $time.'天前';
		}
		$time = intval($seconds/3600);
		if($time>=1) return $time.'小时前';
		$time = intval($seconds/60);
		if($time>=1) return $time.'分钟前';
		return $seconds.'秒前';
	}
	
	function array_fullness($array)
	{
		$nulls = 0;
		foreach($array as $v) if(empty($v) or intval($v)<0) $nulls++;
		return 100-intval($nulls/count($array)*100);
	}
	
	function arr_constellation()
	{
		return array('','白羊座','金牛座','双子座','巨蟹座','狮子座','处女座','天秤座','天蝎座','射手座','摩羯座','水瓶座','双鱼座');
	}
	
	/**
	 * 根据生日中的月份和日期来计算所属星座*
	 * @param int $birth_month
	 * @param int $birth_date
	 * @return string
	 */
	function get_constellation($birth_month,$birth_date)
	{
		//判断的时候，为避免出现1和true的疑惑，或是判断语句始终为真的问题，这里统一处理成字符串形式
		$birth_month = strval($birth_month);
		$constellation_name = array('水瓶座','双鱼座','白羊座','金牛座','双子座','巨蟹座','狮子座','处女座','天秤座','天蝎座','射手座','摩羯座');
		if ($birth_date <= 22)
		{
			if ('1' !== $birth_month)
			{
				$constellation = $constellation_name[$birth_month-2];
			}
			else
			{
				$constellation = $constellation_name[11];
			}
		}
		else
		{
			$constellation = $constellation_name[$birth_month-1];
		}
		return $constellation;
	}

	/**
	* 根据生日中的年份来计算所属生肖
	*
	* @param int $birth_year
	* @return string
	*/
	function get_animal($birth_year,$format='1')
	{
		//1900年是子鼠年
		if($format=='2') $animal = array('子鼠','丑牛','寅虎','卯兔','辰龙','巳蛇','午马','未羊','申猴','酉鸡','戌狗','亥猪');
		elseif($format=='1') $animal = array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
		$my_animal = ($birth_year-1900)%12;
		return $animal[$my_animal];
	}

	/**
	* 根据生日来计算年龄
	*
	* 用Unix时间戳计算是最准确的，但不太好处理1970年之前出生的情况
	* 而且还要考虑闰年的问题，所以就暂时放弃这种方式的开发，保留思想
	*
	* @param int $birth_year
	* @param int $birth_month
	* @param int $birth_date
	* @return int
	*/
	function get_age($birth_year,$birth_month,$birth_date)
	{
		$now_age = 1; //实际年龄，以出生时为1岁计
		$full_age = 0; //周岁，该变量放着，根据具体情况可以随时修改
		$now_year   = date('Y',time());
		$now_date_num  = date('z',time()); //该年份中的第几天
		$birth_date_num = date('z',mktime(0,0,0,$birth_month,$birth_date,$birth_year));
		$difference = $now_date_num - $birth_date_num;

		if ($difference > 0)
		{
			$full_age = $now_year - $birth_year;
		}
		else
		{
			$full_age = $now_year - $birth_year - 1;
		}
		$now_age = $full_age + 1;
		return $now_age;
	}
	
	function make_random_char($pond, $num)
	{
		//随机产生6位密码
		$max_char=strlen($pond)-1;
		$pd='';
		for($i=0;$i<$num;$i++){
			$pd.=$pond[mt_rand(0,$max_char)];
		}
		return $pd;
	}
	
	/**
	 * 生成随机字符串
	 * @param string $lenth 长度
	 * @return string 字符串
	 */
	function create_randomstr($lenth = 6) {
		$randomStr = $this->make_random_char('123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ', $lenth);
		return base64_encode($randomStr);
	}
	
	/**
	 * 字符截取 支持UTF8/GBK
	 * @param $string
	 * @param $length
	 * @param $dot
	 */
	function str_cut($string, $length, $dot = '...') {
		$strlen = strlen($string);
		if($strlen <= $length) return $string;
		$string = str_replace(array(' ','&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵',' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
		$strcut = '';
		if('utf-8') {
			$length = intval($length-strlen($dot)-$length/3);
			$n = $tn = $noc = 0;
			while($n < strlen($string)) {
				$t = ord($string[$n]);
				if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
					$tn = 1; $n++; $noc++;
				} elseif(194 <= $t && $t <= 223) {
					$tn = 2; $n += 2; $noc += 2;
				} elseif(224 <= $t && $t <= 239) {
					$tn = 3; $n += 3; $noc += 2;
				} elseif(240 <= $t && $t <= 247) {
					$tn = 4; $n += 4; $noc += 2;
				} elseif(248 <= $t && $t <= 251) {
					$tn = 5; $n += 5; $noc += 2;
				} elseif($t == 252 || $t == 253) {
					$tn = 6; $n += 6; $noc += 2;
				} else {
					$n++;
				}
				if($noc >= $length) {
					break;
				}
			}
			if($noc > $length) {
				$n -= $tn;
			}
			$strcut = substr($string, 0, $n);
			$strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
		} 
		return $strcut.$dot;
	}
	
	/**
	 * 分页函数
	 *
	 * @param $num 信息总数
	 * @param $curr_page 当前分页
	 * @param $perpage 每页显示数
	 * @param $urlrule URL规则
	 * @param $array 需要传递的数组，用于增加额外的方法
	 * @return 分页
	 */
	function pages($num, $curr_page, $perpage = 20, $setpages = 10, $showTotal = true) {
		
			$urlrule = $this->url_par('page={$page}');
		
		$multipage = '';
		if($num > $perpage) {
			$page = $setpages+1;
			$offset = ceil($setpages/2-1);
			$pages = ceil($num / $perpage);
			if (!defined('PAGES')) define('PAGES', $pages);
			$from = $curr_page - $offset;
			$to = $curr_page + $offset;
			$more = 0;
			if($page >= $pages) {
				$from = 2;
				$to = $pages-1;
			} else {
				if($from <= 1) {
					$to = $page-1;
					$from = 2;
				}  elseif($to >= $pages) {
					$from = $pages-($page-2);
					$to = $pages-1;
				}
				$more = 1;
			}
			if($showTotal){
			    $multipage .= '<a class="a1">'.$num.'条'.'</a>';
			}
			if($curr_page>0) {
				$multipage .= ' <a href="'.$this->pageurl($urlrule, $curr_page-1).'" class="a1">'.'上一页'.'</a>';
				if($curr_page==1) {
					$multipage .= ' <span>1</span>';
				} elseif($curr_page>6 && $more) {
					$multipage .= ' <a href="'.$this->pageurl($urlrule, 1).'">1</a>..';
				} else {
					$multipage .= ' <a href="'.$this->pageurl($urlrule, 1).'">1</a>';
				}
			}
			for($i = $from; $i <= $to; $i++) {
				if($i != $curr_page) {
					$multipage .= ' <a href="'.$this->pageurl($urlrule, $i).'">'.$i.'</a>';
				} else {
					$multipage .= ' <span>'.$i.'</span>';
				}
			}
			if($curr_page<$pages) {
				if($curr_page<$pages-5 && $more) {
					$multipage .= ' ..<a href="'.$this->pageurl($urlrule, $pages).'">'.$pages.'</a> <a href="'.$this->pageurl($urlrule, $curr_page+1).'" class="a1">'.'下一页'.'</a>';
				} else {
					$multipage .= ' <a href="'.$this->pageurl($urlrule, $pages).'">'.$pages.'</a> <a href="'.$this->pageurl($urlrule, $curr_page+1).'" class="a1">'.'下一页'.'</a>';
				}
			} elseif($curr_page==$pages) {
				$multipage .= ' <span>'.$pages.'</span> <a href="'.$this->pageurl($urlrule, $curr_page).'" class="a1">'.'下一页'.'</a>';
			} else {
				$multipage .= ' <a href="'.$this->pageurl($urlrule, $pages).'">'.$pages.'</a> <a href="'.$this->pageurl($urlrule, $curr_page+1).'" class="a1">'.'下一页'.'</a>';
			}
		}
		return $multipage;
	}
	/**
	 * 返回分页路径
	 *
	 * @param $urlrule 分页规则
	 * @param $page 当前页
	 * @param $array 需要传递的数组，用于增加额外的方法
	 * @return 完整的URL路径
	 */
	function pageurl($urlrule, $page, $array = array()) {
		if(strpos($urlrule, '~')) {
			$urlrules = explode('~', $urlrule);
			$urlrule = $page < 2 ? $urlrules[0] : $urlrules[1];
		}
		$findme = array('{$page}');
		$replaceme = array($page);
		if (is_array($array)) foreach ($array as $k=>$v) {
			$findme[] = '{$'.$k.'}';
			$replaceme[] = $v;
		}
		$url = str_replace($findme, $replaceme, $urlrule);
		$url = str_replace(array('http://','//','~'), array('~','/','http://'), $url);
		return $url;
	}

	/**
	 * URL路径解析，pages 函数的辅助函数
	 *
	 * @param $par 传入需要解析的变量 默认为，page={$page}
	 * @param $url URL地址
	 * @return URL
	 */
	function url_par($par, $url = '') {
		if($url == '') $url =$this->get_url();
		$pos = strpos($url, '?');
		if($pos === false) {
			$url .= '?'.$par;
		} else {
			$querystring = substr(strstr($url, '?'), 1);
			parse_str($querystring, $pars);
			$query_array = array();
			foreach($pars as $k=>$v) {
				if($k != 'page') $query_array[$k] = $v;
			}
			$http_query = http_build_query($query_array);
			$querystring = !empty($http_query) ? $http_query.'&'.$par : $par;
			$url = substr($url, 0, $pos).'?'.$querystring;
		}
		return $url;
	}
	
		/**
	 * 获取当前页面完整URL地址
	 */
	function get_url() {
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		$php_self = $_SERVER['PHP_SELF'] ? $this->safe_replace($_SERVER['PHP_SELF']) : $this->safe_replace($_SERVER['SCRIPT_NAME']);
		$path_info = isset($_SERVER['PATH_INFO']) ? $this->safe_replace($_SERVER['PATH_INFO']) : '';
		$relate_url = isset($_SERVER['REQUEST_URI']) ? $this->safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$this->safe_replace($_SERVER['QUERY_STRING']) : $path_info);
		return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	}
		/**
	 * 安全过滤函数
	 *
	 * @param $string
	 * @return string
	 */
	function safe_replace($string) {
		$string = str_replace('%20','',$string);
		$string = str_replace('%27','',$string);
		$string = str_replace('%2527','',$string);
		$string = str_replace('*','',$string);
		$string = str_replace('"','&quot;',$string);
		$string = str_replace("'",'',$string);
		$string = str_replace('"','',$string);
		$string = str_replace(';','',$string);
		$string = str_replace('<','&lt;',$string);
		$string = str_replace('>','&gt;',$string);
		$string = str_replace("{",'',$string);
		$string = str_replace('}','',$string);
		$string = str_replace('\\','',$string);
		return $string;
	}
	
	/**
	 * 生成试题txt文件
	 *
	 * @param $string
	 * @return bool
	 */
	 
	 function Createtxt($dir, $name, $data){
		if(!file_exists($dir)){
			mkdir($dir, 0777) or die("创建目录".$dir."失败");
		}
		$fileName = $dir . '/' . $name . '.txt';
		if(!file_exists($fileName)){
			@fopen($fileName, "w");
			if(is_writable($fileName)){
				if(!$handle = fopen($fileName, "a")){echo "文件不可打开";exit;}
				if(!fwrite($handle, $data)){echo "文件不可写";exit;}
				fclose($handle);
			}
		}
	 }
	 /**
	 * 生成试题txt文件
	 *
	 * @param $string
	 * @return bool
	 */
	 function Delete_File($filePath){
		if(file_exists($filePath)){
			if(!unlink($filePath)){
			   echo '文件或目录没有权限删除';EXIT();
			}
		}
		
	 }
	 
	 
	 
	 
	public static function utf_substr($str, $len)
	{
		for($i=0;$i<$len;$i++)
		{
			$temp_str=substr($str,0,1);
			if(ord($temp_str) > 127){
				$i++;
				if($i<$len){
					$new_str[]=substr($str,0,3);
					$str=substr($str,3);
				}
			}else{
				$new_str[]=substr($str,0,1);
				$str=substr($str,1);
			}
		}
		return join($new_str);
	}
	
	/**
	* 转化 \ 为 /
	* 
	* @param	string	$path	路径
	* @return	string	路径
	*/
	function dir_path($path) {
		$path = str_replace('\\', '/', $path);
		if(substr($path, -1) != '/') $path = $path.'/';
		return $path;
	}
	/**
	* 创建目录
	* 
	* @param	string	$path	路径
	* @param	string	$mode	属性
	* @return	string	如果已经存在则返回true，否则为flase
	*/
	function dir_create($path, $mode = 0777) {
		if(is_dir($path)) return TRUE;
		$ftp_enable = 0;
		$path = dir_path($path);
		$temp = explode('/', $path);
		$cur_dir = '';
		$max = count($temp) - 1;
		for($i=0; $i<$max; $i++) {
			$cur_dir .= $temp[$i].'/';
			if (@is_dir($cur_dir)) continue;
			@mkdir($cur_dir, 0777,true);
			@chmod($cur_dir, 0777);
		}
		return is_dir($path);
	}
	/**
	* 拷贝目录及下面所有文件
	* 
	* @param	string	$fromdir	原路径
	* @param	string	$todir		目标路径
	* @return	string	如果目标路径不存在则返回false，否则为true
	*/
	function dir_copy($fromdir, $todir) {
		$fromdir = dir_path($fromdir);
		$todir = dir_path($todir);
		if (!is_dir($fromdir)) return FALSE;
		if (!is_dir($todir)) dir_create($todir);
		$list = glob($fromdir.'*');
		if (!empty($list)) {
			foreach($list as $v) {
				$path = $todir.basename($v);
				if(is_dir($v)) {
					dir_copy($v, $path);
				} else {
					copy($v, $path);
					@chmod($path, 0777);
				}
			}
		}
		return TRUE;
	}
	/**
	* 转换目录下面的所有文件编码格式
	* 
	* @param	string	$in_charset		原字符集
	* @param	string	$out_charset	目标字符集
	* @param	string	$dir			目录地址
	* @param	string	$fileexts		转换的文件格式
	* @return	string	如果原字符集和目标字符集相同则返回false，否则为true
	*/
	function dir_iconv($in_charset, $out_charset, $dir, $fileexts = 'php|html|htm|shtml|shtm|js|txt|xml') {
		if($in_charset == $out_charset) return false;
		$list = dir_list($dir);
		foreach($list as $v) {
			if (pathinfo($v, PATHINFO_EXTENSION) == $fileexts && is_file($v)){
				file_put_contents($v, iconv($in_charset, $out_charset, file_get_contents($v)));
			}
		}
		return true;
	}
	/**
	* 列出目录下所有文件
	* 
	* @param	string	$path		路径
	* @param	string	$exts		扩展名
	* @param	array	$list		增加的文件列表
	* @return	array	所有满足条件的文件
	*/
	function dir_list($path, $exts = '', $list= array()) {
		$path = dir_path($path);
		$files = glob($path.'*');
		foreach($files as $v) {
			if (!$exts || pathinfo($v, PATHINFO_EXTENSION) == $exts) {
				$list[] = $v;
				if (is_dir($v)) {
					$list = dir_list($v, $exts, $list);
				}
			}
		}
		return $list;
	}
	/**
	* 设置目录下面的所有文件的访问和修改时间
	* 
	* @param	string	$path		路径
	* @param	int		$mtime		修改时间
	* @param	int		$atime		访问时间
	* @return	array	不是目录时返回false，否则返回 true
	*/
	function dir_touch($path, $mtime = TIME, $atime = TIME) {
		if (!is_dir($path)) return false;
		$path = dir_path($path);
		if (!is_dir($path)) touch($path, $mtime, $atime);
		$files = glob($path.'*');
		foreach($files as $v) {
			is_dir($v) ? dir_touch($v, $mtime, $atime) : touch($v, $mtime, $atime);
		}
		return true;
	}
	/**
	* 目录列表
	* 
	* @param	string	$dir		路径
	* @param	int		$parentid	父id
	* @param	array	$dirs		传入的目录
	* @return	array	返回目录列表
	*/
	function dir_tree($dir, $parentid = 0, $dirs = array()) {
		global $id;
		if ($parentid == 0) $id = 0;
		$list = glob($dir.'*');
		foreach($list as $v) {
			if (is_dir($v)) {
				$id++;
				$dirs[$id] = array('id'=>$id,'parentid'=>$parentid, 'name'=>basename($v), 'dir'=>$v.'/');
				$dirs = dir_tree($v.'/', $id, $dirs);
			}
		}
		return $dirs;
	}

	/**
	* 删除目录及目录下面的所有文件
	* 
	* @param	string	$dir		路径
	* @return	bool	如果成功则返回 TRUE，失败则返回 FALSE
	*/
	function dir_delete($dir) {
		$dir = dir_path($dir);
		if (!is_dir($dir)) return FALSE;
		$list = glob($dir.'*');
		foreach($list as $v) {
			is_dir($v) ? dir_delete($v) : @unlink($v);
		}
		return @rmdir($dir);
	}
	
	/**
	* 将字符串转换为数组
	*
	* @param	string	$data	字符串
	* @return	array	返回数组格式，如果，data为空，则返回空数组
	*/
	function string2array($data) {
		if($data == '') return array();
		@eval("\$array = $data;");
		return $array;
	}
	/**
	* 将数组转换为字符串
	*
	* @param	array	$data		数组
	* @param	bool	$isformdata	如果为0，则不使用new_stripslashes处理，可选参数，默认为1
	* @return	string	返回字符串，如果，data为空，则返回空
	*/
	function array2string($data, $isformdata = 1) {
		if($data == '') return '';
		if($isformdata) {
		$data = $this->new_stripslashes($data);
		return addslashes(var_export($data, TRUE));
		}
		else{
		return var_export($data, TRUE);
		}
	}
	
	/**
	 * 返回经stripslashes处理过的字符串或数组
	 * @param $string 需要处理的字符串或数组
	 * @return mixed
	 */
	function new_stripslashes($string) {
		if(!is_array($string)) return stripslashes($string);
		foreach($string as $key => $val) $string[$key] = $this->new_stripslashes($val);
		return $string;
	}
	
	
	function upload_image($imagepath,$path,$showjs = false)
	{
		$maxAttachSize = 2097152;//2M
		$upExt      = array('jpg','jpeg','gif','png');//上传扩展名
		$name 	    = $imagepath['name'];
		$tmp_name   = $imagepath['tmp_name'];
		$size       = $imagepath['size'];
		$fileInfo   = pathinfo($name);
		$extension  = $fileInfo['extension'];
		$uploadfile = $path.'/'.date("YmdHis").mt_rand(1000,9999).'.'.$extension;
		if($size > $maxAttachSize){
		
		    echo "<script>alert('请不要上传大小超过{$this->formatBytes($maxAttachSize)}的文件');window.history.back();</script>";
			exit;
		}
		if($name == ''){
			echo "<script>alert('请先选择要上传的图片文件');window.history.back();</script>";
			exit;
		}
		if(!in_array($extension, $upExt)){
			echo "<script>alert('上传文件只可以是JPEG或GIF类型的!');window.history.back();</script>";
			exit;
		}
		
		if(move_uploaded_file($tmp_name,$uploadfile))
		{
			if($showjs){
			echo "<script>alert('上传图片成功!');window.history.back();</script>";
			}
			return $uploadfile;
		}else if(copy($tmp_name,$uploadfile))
		{
			if($showjs){
			echo "<script>alert('上传图片成功!');window.history.back();</script>";
			}
			return $uploadfile;
		}else return false;
	}
	
	public function Upload_file($uploadDir, $reUrl)
	{
		header('Content-Type: text/html; charset=UTF-8');

		$inputName='filedata';//表单文件域name
		$attachDir=$uploadDir;//上传文件保存路径，结尾不要带/
		$dirType=1;//1:按天存入目录 2:按月存入目录 3:按扩展名存目录  建议使用按天存
		$maxAttachSize=2097152;//最大上传大小，默认是2M
		$upExt='txt,rar,zip,jpg,jpeg,gif,png,swf,wmv,avi,wma,mp3,mid';//上传扩展名
		$msgType=2;//返回上传参数的格式：1，只返回url，2，返回参数数组
		$immediate=isset($_GET['immediate'])?$_GET['immediate']:0;//立即上传模式，仅为演示用
		ini_set('date.timezone','Asia/Shanghai');//时区

		$err = "";
		$msg = "''";
		$tempPath=$attachDir.'/'.date("YmdHis").mt_rand(10000,99999).'.tmp';
		$localName='';

		if(isset($_SERVER['HTTP_CONTENT_DISPOSITION'])&&preg_match('/attachment;\s+name="(.+?)";\s+filename="(.+?)"/i',$_SERVER['HTTP_CONTENT_DISPOSITION'],$info)){//HTML5上传
			file_put_contents($tempPath,file_get_contents("php://input"));
			$localName=urldecode($info[2]);
		}
		else{//标准表单式上传
			$upfile=@$_FILES[$inputName];
			if(!isset($upfile))$err='文件域的name错误';
			elseif(!empty($upfile['error'])){
				switch($upfile['error'])
				{
					case '1':
						$err = '文件大小超过了php.ini定义的upload_max_filesize值';
						break;
					case '2':
						$err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
						break;
					case '3':
						$err = '文件上传不完全';
						break;
					case '4':
						$err = '无文件上传';
						break;
					case '6':
						$err = '缺少临时文件夹';
						break;
					case '7':
						$err = '写文件失败';
						break;
					case '8':
						$err = '上传被其它扩展中断';
						break;
					case '999':
					default:
						$err = '无有效错误代码';
				}
			}
			elseif(empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none')$err = '无文件上传';
			else{
				move_uploaded_file($upfile['tmp_name'],$tempPath);
				$localName=$upfile['name'];
			}
		}

		if($err==''){
			$fileInfo=pathinfo($localName);
			$extension=$fileInfo['extension'];
			if(preg_match('/^('.str_replace(',','|',$upExt).')$/i',$extension))
			{
				$bytes=filesize($tempPath);
				if($bytes > $maxAttachSize)$err='请不要上传大小超过'.$this->formatBytes($maxAttachSize).'的文件';
				else
				{
					switch($dirType)
					{
						case 1: $attachSubDir = 'day_'.date('ymd'); break;
						case 2: $attachSubDir = 'month_'.date('ym'); break;
						case 3: $attachSubDir = 'ext_'.$extension; break;
					}
					$attachDir = $attachDir.'/'.$attachSubDir;
					if(!is_dir($attachDir))
					{
						@mkdir($attachDir, 0777);
						@fclose(fopen($attachDir.'/index.htm', 'w'));
					}
					PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
					$newFilename=date("YmdHis").mt_rand(1000,9999).'.'.$extension;
					$targetPath = $attachDir.'/'.$newFilename;
					
					rename($tempPath,$targetPath);
					@chmod($targetPath,0755);
					
					//$targetPath=$this->jsonString($targetPath);
					$targetPath=explode('uploads', $targetPath);
					$targetPath = $reUrl . $targetPath[1];
					if($immediate=='1')$targetPath='!'.$targetPath;
					if($msgType==1)$msg="'$targetPath'";
					else $msg="{'url':'".$targetPath."','localname':'".$this->jsonString($localName)."','id':'1'}";//id参数固定不变，仅供演示，实际项目中可以是数据库ID
				}
			}
			else $err='上传文件扩展名必需为：'.$upExt;

			@unlink($tempPath);
		}

		echo "{'err':'".$this->jsonString($err)."','msg':".$msg."}";
	}
	
	function jsonString($str)
	{
		return preg_replace("/([\\\\\/'])/",'\\\$1',$str);
	}
	
	function formatBytes($bytes) {
		if($bytes >= 1073741824) {
			$bytes = round($bytes / 1073741824 * 100) / 100 . 'GB';
		} elseif($bytes >= 1048576) {
			$bytes = round($bytes / 1048576 * 100) / 100 . 'MB';
		} elseif($bytes >= 1024) {
			$bytes = round($bytes / 1024 * 100) / 100 . 'KB';
		} else {
			$bytes = $bytes . 'Bytes';
		}
		return $bytes;
	}
	
}
?>