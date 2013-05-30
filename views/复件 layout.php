<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php if( isset($title) && !empty($title) ) echo $title, ' | '; ?><?php echo $this->config->config['site_name']; ?></title>
<meta name="keywords" content="<?php echo $this->config->config['site_keyword']; ?>">
<meta name="description" content="<?php echo $this->config->config['site_description']; ?>">
<?php 
if( isset($css) && is_array($css) ):
	foreach($css as $name):
?>
<link href="<?php echo STATIC_CSS_PATH;?><?php echo $name; ?>.css" rel="stylesheet" type="text/css">
<?php 
	endforeach;
endif; ?>


<SCRIPT type=text/javascript src="<?php echo STATIC_JS_PATH;?>jquery-1.4.2.js"></SCRIPT>
<script type=text/javascript src="<?php echo STATIC_JS_PATH;?>index.js"></script>
<script type=text/javascript src="<?php echo STATIC_JS_PATH;?>index_register.js"></script>
<script type="text/javascript">
var base_url =  base_url || '<?php echo base_url(); ?>';
Array.prototype.indexOf||(Array.prototype.indexOf=function(e){for(var t in this)if(this[t]===e)return t;return-1});
</script>
</head>

<body>
<!-- 吸顶效果 -->
  <div class="xiding">
    <div class="xidingc">
      <div class="xidingc01"><a href="#">征婚就选21邂逅网</a><a href="#"><img src="<?php echo STATIC_IMG_PATH;?>zhuye.gif" /></a><a href="#"><img src="<?php echo STATIC_IMG_PATH;?>xinlang.gif" /></a></div>
	  <form id="searchForm" name="searchForm" method="get" action="/search/fast/">
      <div class="zh"><span>征婚：</span>
	  <select name="sex" class="select64">
			<option value="2">老公</option>
            <option value="1">老婆</option>            
            </select>
      <span>年龄：</span>
	  <select name="min_age" id="min_age" class="select40">
            	  <option value="18">18</option>
				  <option value="19">19</option> <option value="21">21</option>
				  <option value="22">22</option>
				  <option value="23">23</option><option value="24">24</option><option value="25">25</option>
				  <option value="26">26</option><option value="27">27</option><option value="28" selected="selected">28</option>
				  <option value="29">29</option><option value="30">30</option> <option value="31">31</option>
				  <option value="32">32</option><option value="33">33</option><option value="34">34</option>
				  <option value="35">35</option><option value="36">36</option><option value="37">37</option>
				  <option value="38">38</option><option value="39">39</option><option value="40">40</option>
				  <option value="41">41</option><option value="42">42</option><option value="43">43</option>
				  <option value="44">44</option><option value="45">45</option><option value="46">46</option>
				  <option value="47">47</option><option value="48">48</option><option value="49">49</option>
				  <option value="50">50</option><option value="51">51</option><option value="52">52</option>
				  <option value="53">53</option><option value="54">54</option><option value="55">55</option>
				  <option value="56">56</option><option value="57">57</option><option value="58">58</option>
				  <option value="59">59</option><option value="60">60</option><option value="61">61</option>
				  <option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option>
				  </select>
	  <strong>至</strong>
	  <select name="max_age" id="max_age" class="select40">
				  <option value="18">18</option>
		 		  <option value="19">19</option> <option value="21">21</option><option selected="selected" value="22">22</option>
				  <option value="23">23</option><option value="24">24</option><option value="25">25</option>
				  <option value="26">26</option><option value="27">27</option><option value="28">28</option>
				  <option value="29">29</option><option value="30">30</option> <option value="31">31</option>
				  <option value="32">32</option><option value="33">33</option><option value="34">34</option>
				  <option value="35" selected="selected">35</option><option value="36">36</option><option value="37">37</option>
				  <option value="38">38</option><option value="39">39</option><option value="40">40</option>
				  <option value="41">41</option><option value="42">42</option><option value="43">43</option>
				  <option value="44">44</option><option value="45">45</option><option value="46">46</option>
				  <option value="47">47</option><option value="48">48</option><option value="49">49</option>
				  <option value="50">50</option><option value="51">51</option><option value="52">52</option>
				  <option value="53">53</option><option value="54">54</option><option value="55">55</option>
				  <option value="56">56</option><option value="57">57</option><option value="58">58</option>
				  <option value="59">59</option><option value="60">60</option><option value="61">61</option>
				  <option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option>
				  </select>
      <span>地区：</span>
	  <script>getProvinceSelect('select64','areaForm_workProvince1','areaForm_workProvince1','areaForm_workCity1','','10100000');</script>
	  <strong></strong>
	  <script>getCitySelect('select64','areaForm_workCity1','areaForm_workCity1','','');</script>
	  <span class="gray" style="display:none">您的居住地</span>
						<span style="display:none"><img src="http://img1.21xiehou.com/static/images/true.gif" alt="true" /></span>
						<span class="tab_false" style="display:none"><img src="http://img1.21xiehou.com/static/images/false.gif" alt="false" /></span></span>
       <input type="checkbox" name="has_avatar" id="has_avatar" value="1" checked style="margin:2px 0 0 5px;"/><strong>有照片</strong><input <input name="提交" type="submit" value="" class="xdaniu" />
      </div>
	  </form>
      <div class="xdlogin"><a href="<?php echo base_url(); ?>login/">登录</a><a href="#"><img src="<?php echo STATIC_IMG_PATH;?>qq.gif" /></a><a href="#"><img src="<?php echo STATIC_IMG_PATH;?>xl.gif" /></a><a href="<?php echo base_url(); ?>register/first/">免费注册</a></div>
    </div>
  </div>
<!-- 吸顶效果 end -->
<div id="bj"><!-- 最里层背景 --></div>
<div id="topbj"><!-- 头部背景 --></div>
<!-- top -->
<div id="top">
  <div class="bt">中国真实婚恋交友平台的领航者</div>
  <div class="rel"><a href="#" title="联系电话">&nbsp;&nbsp;</a></div>
  <div class="nav">
	<ul id="nav">
	<li class="<?php if($current==='main'){ echo 'navon';} ?>"><a href="<?php echo base_url();?>" title="首页">首页</a></li>
	<?php foreach($menu as $pro=>$name): ?>
		<li class="<?php if($pro===$current){ echo 'navon';} ?>"><a href="<?php echo base_url();?><?php echo $pro;?>/"><?php echo $name;?></a></li>
	<?php endforeach; ?>
	 <div style="clear:both;"></div>
	</ul>
  </div>
</div>
<div style="clear:both; height:0; overflow:hidden;"></div>
<!-- top end -->
<!-- main -->
<?php if(isset($content)) echo $content; ?>
<!-- main end -->
<!-- for -->
  <div id="for" class="white"><p><a href="#">关于邂逅</a> | <a href="#">媒体报道</a> |  <a href="#">网站合作</a> | <a href="#">服务声明</a> | <a href="#">隐私保护</a> | <a href="#">诚聘英才</a> | <a href="#">意见反馈</a> | <a href="#">友情链接</a></p>客服热线：<span>400-818-7778</span> 传真号码：<span>010-59005600</span> 技术热线：<span>010-59005618</span> 客服邮箱：<span>jcxh99@126.com</span><br />
地址：背景朝阳区外大街乙<span>6</span>号朝外<span>SOHO-D</span>座<span>7</span>层<span>0727-0730</span>室 邮编：<span>100020</span><br />
版权所有：北京京城邂逅信息咨询有限公司 京<span>ICP</span>备<span>0507962</span>号 京公网安备<span>110105000694</span><br />
<span>Copyright@199-2010 21xiehou.com, All Rights Reserved</span></div>
<!-- for end -->
<?php 
if( isset($javascript) && is_array($javascript) ):
	foreach($javascript as $name):
?>
<script src="<?php echo STATIC_JS_PATH;?><?php echo $name; ?>.js" type="text/javascript"></script>
<?php 
	endforeach;
endif; ?>
<?php if($current==='main'){?>

<script src="<?php echo STATIC_JS_PATH;?>Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type=text/javascript src="<?php echo STATIC_JS_PATH;?>jq.imgchange.js"></script>
<script type="text/javascript">
$(document).ready(  function(){});
function slideUp(){
$("#divObj").slideUp(2000);//hide()函数,实现隐藏,括号里还可以带一个时间参数(毫秒)例如hide(2000)以2000毫秒的速度隐藏,还可以带slow,fast
}
function slideDown(){
$("#divObj").slideDown(2000);//显示,参数说明同上
}
</script>

<script type="text/javascript">
swfobject.registerObject("FlashID");
swfobject.registerObject("FlashID");
swfobject.registerObject("FlashID");
swfobject.registerObject("FlashID");
$('#demo').jCarouselLite({visible:8,scroll:8,speed:1000,auto:4000})
swfobject.registerObject("FlashID2");
</script>
<?php }?>
</body>
</html>