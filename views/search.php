<!-- daohang -->
<div class="daohang"><p>当前位置：<a href="<?php echo base_url();?>">首页</a> > <a href="<?php echo base_url(),'search/index/';?>">爱情搜索</a> </p></div>
<!-- daohang end -->
<div class="main">
  <div class="left" style="height:1200px;">
    <div class="hsjia01"><img src="<?php echo STATIC_IMG_PATH;?>hsJia01.gif" /></div>
    <div class="hsjia02"><img src="<?php echo STATIC_IMG_PATH;?>hsJia02.gif" /></div>
    <div class="leftbot"><img src="<?php echo STATIC_IMG_PATH;?>zlbot01.gif" /></div>
    <!--爱情搜索左侧-->
      <div class="aqssTOP">爱情搜索</div> 
      <div class="aqssBOT">
	  <?php echo form_open('search/index',array('name'=>'searchform','id'=>'searchform','method'=>'post'));?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right" width="40%">性别：</td>
    <td><input type="radio" name="sex" id="sex" value="1" <?php echo isset($_SESSION['search_basecond']) && $_SESSION['search_basecond']['where']['sex']=='1' ? 'checked="checked"' : '';?> />女&nbsp;&nbsp;&nbsp;
	<input type="radio" name="sex" id="sex" value="2" <?php echo isset($_SESSION['search_basecond']) && $_SESSION['search_basecond']['where']['sex']=='2' ? 'checked="checked"' : '';?>>男</td>
  </tr>
  <tr>
    <td align="right">所在地区：</td>
    <td>
	  <script>getProvinceSelect('select64','work_province','work_province','work_city','','10100000');</script>
	&nbsp;&nbsp;
	  <script>getCitySelect('select64','work_city','work_city','','');</script>
	</td>
  </tr>
  <tr>
    <td align="right">年龄：</td>
    <td>
<select name="min_age" id="min_age" class="select64">
<option value="">不限</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
<option value="32">32</option>
<option value="33">33</option>
<option value="34">34</option>
<option value="35">35</option>
<option value="36">36</option>
<option value="37">37</option>
<option value="38">38</option>
<option value="39">39</option>
<option value="40">40</option>
<option value="41">41</option>
<option value="42">42</option>
<option value="43">43</option>
<option value="44">44</option>
<option value="45">45</option>
<option value="46">46</option>
<option value="47">47</option>
<option value="48">48</option>
<option value="49">49</option>
<option value="50">50</option>
<option value="51">51</option>
<option value="52">52</option>
<option value="53">53</option>
<option value="54">54</option>
<option value="55">55</option>
<option value="56">56</option>
<option value="57">57</option>
<option value="58">58</option>
<option value="59">59</option>
<option value="60">60</option>
<option value="61">61</option>
<option value="62">62</option>
<option value="63">63</option>
<option value="64">64</option>
<option value="65">65</option>
<option value="66">66</option>
<option value="67">67</option>
<option value="68">68</option>
<option value="69">69</option>
<option value="70">70</option>
<option value="71">71</option>
<option value="72">72</option>
<option value="73">73</option>
<option value="74">74</option>
<option value="75">75</option>
<option value="76">76</option>
<option value="77">77</option>
<option value="78">78</option>
<option value="79">79</option>
<option value="80">80</option>
<option value="81">81</option>
<option value="82">82</option>
<option value="83">83</option>
<option value="84">84</option>
<option value="85">85</option>
<option value="86">86</option>
<option value="87">87</option>
<option value="88">88</option>
<option value="89">89</option>
<option value="90">90</option>
<option value="91">91</option>
<option value="92">92</option>
<option value="93">93</option>
<option value="94">94</option>
<option value="95">95</option>
<option value="96">96</option>
<option value="97">97</option>
<option value="98">98</option>
</select>&nbsp;至&nbsp;
<select name="max_age" id="max_age" class="select64">
<option value="">不限</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
<option value="32">32</option>
<option value="33">33</option>
<option value="34">34</option>
<option value="35">35</option>
<option value="36">36</option>
<option value="37">37</option>
<option value="38">38</option>
<option value="39">39</option>
<option value="40">40</option>
<option value="41">41</option>
<option value="42">42</option>
<option value="43">43</option>
<option value="44">44</option>
<option value="45">45</option>
<option value="46">46</option>
<option value="47">47</option>
<option value="48">48</option>
<option value="49">49</option>
<option value="50">50</option>
<option value="51">51</option>
<option value="52">52</option>
<option value="53">53</option>
<option value="54">54</option>
<option value="55">55</option>
<option value="56">56</option>
<option value="57">57</option>
<option value="58">58</option>
<option value="59">59</option>
<option value="60">60</option>
<option value="61">61</option>
<option value="62">62</option>
<option value="63">63</option>
<option value="64">64</option>
<option value="65">65</option>
<option value="66">66</option>
<option value="67">67</option>
<option value="68">68</option>
<option value="69">69</option>
<option value="70">70</option>
<option value="71">71</option>
<option value="72">72</option>
<option value="73">73</option>
<option value="74">74</option>
<option value="75">75</option>
<option value="76">76</option>
<option value="77">77</option>
<option value="78">78</option>
<option value="79">79</option>
<option value="80">80</option>
<option value="81">81</option>
<option value="82">82</option>
<option value="83">83</option>
<option value="84">84</option>
<option value="85">85</option>
<option value="86">86</option>
<option value="87">87</option>
<option value="88">88</option>
<option value="89">89</option>
<option value="90">90</option>
<option value="91">91</option>
<option value="92">92</option>
<option value="93">93</option>
<option value="94">94</option>
<option value="95">95</option>
<option value="96">96</option>
<option value="97">97</option>
<option value="98">98</option>
</select>
</td>
  </tr>
  <tr>
    <td align="right">身高：</td>
    <td>
<select name="min_height" id="min_height" class="select64">
<option value="">不限</option>
<option value="0" selected="selected">保密</option>
<option value="154">155以下</option>
<option value="155">155</option>
<option value="156">156</option>
<option value="157">157</option>
<option value="158">158</option>
<option value="159">159</option>
<option value="160">160</option>
<option value="161">161</option>
<option value="162">162</option>
<option value="163">163</option>
<option value="164">164</option>
<option value="165">165</option>
<option value="166">166</option>
<option value="167">167</option>
<option value="168">168</option>
<option value="169">169</option>
<option value="170">170</option>
<option value="171">171</option>
<option value="172">172</option>
<option value="173">173</option>
<option value="174">174</option>
<option value="175">175</option>
<option value="176">176</option>
<option value="177">177</option>
<option value="178">178</option>
<option value="179">179</option>
<option value="180">180</option>
<option value="181">180以上</option>
</select>&nbsp;至&nbsp;
<select name="max_height" id="max_height" class="select64">
<option value="">不限</option>
<option value="0" selected="selected">保密</option>
<option value="154">155以下</option>
<option value="155">155</option>
<option value="156">156</option>
<option value="157">157</option>
<option value="158">158</option>
<option value="159">159</option>
<option value="160">160</option>
<option value="161">161</option>
<option value="162">162</option>
<option value="163">163</option>
<option value="164">164</option>
<option value="165">165</option>
<option value="166">166</option>
<option value="167">167</option>
<option value="168">168</option>
<option value="169">169</option>
<option value="170">170</option>
<option value="171">171</option>
<option value="172">172</option>
<option value="173">173</option>
<option value="174">174</option>
<option value="175">175</option>
<option value="176">176</option>
<option value="177">177</option>
<option value="178">178</option>
<option value="179">179</option>
<option value="180">180</option>
<option value="181">180以上</option>
</select>
</td>
  </tr>
  <tr>
    <td align="right">学历：</td>
    <td>
<select name="degree" id="degree" class="select64">
<option value="">不限</option>
<option value="3">高中或中专</option>
<option value="4">大专</option>
<option value="5">大学本科</option>
<option value="6">硕士</option>
<option value="7">博士</option>
</select>&nbsp;以上</td>
  </tr>
  <tr>
    <td align="right">月薪：</td>
    <td>
<select name="salary" id="salary" class="select64">
<option value="">不限</option>
<option value="1">2000以下</option>
<option value="2">2000~4000</option>
<option value="3">4000~6000</option>
<option value="4">6000~8000</option>
<option value="5">8000~1万</option>
<option value="6">1万~1.5万</option>
<option value="7">1.5万~2万</option>
<option value="8">2万~3万</option>
<option value="9">3万~5万</option>
<option value="10">5万~8万</option>
<option value="11">8万~10万</option>
<option value="12">10万以上</option>
</select>&nbsp;以上</td>
  </tr>
  <tr>
    <td align="right">婚史：</td>
    <td>
<select name="marriage" id="marriage" class="select64">
<option value="">不限</option>
<option value="4">不限</option>
<option value="0" selected="selected">保密</option>
<option value="1">未婚</option>
<option value="2">离异</option>
<option value="3">丧偶</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">有无子女：</td>
    <td>
<select name="children" id="children" class="select64">
<option value="">不限</option>
<option value="0" selected="selected">不限</option>
<option value="1">没有</option>
<option value="2">有</option>
<option value="3">和我一起</option>
<option value="4">有,有时和我住在一起</option>
<option value="5">有，不和我住在一起</option>
</select>
	</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="base_search" type="image" src="<?php echo STATIC_IMG_PATH;?>ksss.gif"  /></td>
  </tr>
</table>

      </div>
      <div class="aqssTOP" style="margin-top:15px;">高级搜索</div> 
      <div class="aqssBOT">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right" width="40%">诚信星级：</td>
    <td>
<select name="credit" id="credit" class="select64">
<option value="">不限</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">职业：</td>
    <td>
	<select name="job" id="job" class="select64">
<option value="">不限</option>
<option value="0" <?php echo !isset($_GET['job']) ? 'selected="selected"' : ''?>>保密</option>
<option value="1">工程机械</option>
<option value="2">高级管理</option>
<option value="3">作家</option>
<option value="4">电子/仪表</option>
<option value="5">仓储/物流</option>
<option value="6">自由职业者</option>
<option value="7">艺术家</option>
<option value="8" <?php echo isset($_GET['job']) && $_GET['job']=='8' ? 'selected="selected"' : ''?>>记者</option>
<option value="9" <?php echo isset($_GET['job']) && $_GET['job']=='9' ? 'selected="selected"' : ''?>>演员</option>
<option value="10" <?php echo isset($_GET['job']) && $_GET['job']=='10' ? 'selected="selected"' : ''?>>模特</option>
<option value="11">美容/保健</option>
<option value="12">财会</option>
<option value="13">采购/贸易</option>
<option value="14">餐饮/旅游</option>
<option value="15">房地产</option>
<option value="16">公关/商务</option>
<option value="17">公务员</option>
<option value="18">私营业主</option>
<option value="19">通信技术</option>
<option value="20">传媒</option>
<option value="21">警察/军人</option>
<option value="22">销售</option>
<option value="23">学术/科研</option>
<option value="24">医疗/护理</option>
<option value="25">咨询/顾问</option>
<option value="26">其他</option>
<option value="27">互联网</option>
<option value="28">市场拓展</option>
<option value="29">医药</option>
<option value="30">航空服务业</option>
<option value="31">化工</option>
<option value="32">计算机</option>
<option value="33">教育/培训</option>
<option value="34">金融</option>
<option value="35">客户服务</option>
<option value="36">服务业</option>
<option value="37">行政/后勤</option>
<option value="38">设计/创意</option>
<option value="39">生产/加工</option>
<option value="40">服装设计</option>
<option value="41">教授</option>
<option value="42" <?php echo isset($_GET['job']) && $_GET['job']=='42' ? 'selected="selected"' : ''?>>教师</option>
<option value="43" <?php echo isset($_GET['job']) && $_GET['job']=='43' ? 'selected="selected"' : ''?>>公务员</option>
<option value="44">留学生</option>
<option value="45">职员</option>
<option value="46">蓝领</option>
<option value="47">工程师</option>
<option value="48">白领</option>
<option value="49">经理</option>
<option value="50">高级经理</option>
<option value="51">企业家</option>
<option value="52" <?php echo isset($_GET['job']) && $_GET['job']=='52' ? 'selected="selected"' : ''?>>在校学生</option>
<option value="53">律师</option>
<option value="54">军人</option>
<option value="55" <?php echo isset($_GET['job']) && $_GET['job']=='55' ? 'selected="selected"' : ''?>>空姐</option>
<option value="56" <?php echo isset($_GET['job']) && $_GET['job']=='56' ? 'selected="selected"' : ''?>>护士</option>
<option value="57" <?php echo isset($_GET['job']) && $_GET['job']=='57' ? 'selected="selected"' : ''?>>医生</option>
<option value="58">其他</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">公司类型：</td>
    <td>
<select name="companytype" id="companytype" class="select64">
<option value="">不限</option>
<option value="1">政府机关</option>
<option value="2">事业单位</option>
<option value="3">世界500强</option>
<option value="4">外资企业</option>
<option value="5">上市公司</option>
<option value="6">国营企业</option>
<option value="7">私营企业</option>
<option value="8">自有公司</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">住房：</td>
    <td>
<select name="house" id="house" class="select64">
<option value="">不限</option>
<option value="1">和父母同住</option>
<option value="2">有房</option>
<option value="3">租房</option>
<option value="4">婚后有房</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">购车：</td>
    <td>
<select name="car" id="car" class="select64">
<option value="">不限</option>
<option value="1">暂未购车</option>
<option value="2">已经购车</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">户口地区：</td>
    <td>
	<script>getProvinceSelect('select64','birth_province','birth_province','birth_city','','10100000');</script>
	&nbsp;&nbsp;
	  <script>getCitySelect('select64','birth_city','birth_city','','');</script>
	</td>
  </tr>
  <tr>
    <td align="right">民族：</td>
    <td>
<select name="min_jon" id="min_jon" class="select64">
<option value="">不限</option>
<option value="1">汉族</option>
<option value="2">藏族</option>
<option value="3">朝鲜族</option>
<option value="4">蒙古族</option>
<option value="5">回族</option>
<option value="6">满族</option>
<option value="7">维吾尔族</option>
<option value="8">壮族</option>
<option value="9">彝族</option>
<option value="10">苗族</option>
<option value="11">侗族</option>
<option value="12">瑶族</option>
<option value="13">白族</option>
<option value="14">布依族</option>
<option value="15">傣族</option>
<option value="16">京族</option>
<option value="17">黎族</option>
<option value="18">羌族</option>
<option value="19">怒族</option>
<option value="20">佤族</option>
<option value="21">水族</option>
<option value="22">畲族</option>
<option value="23">土族</option>
<option value="24">阿昌族</option>
<option value="25">哈尼族</option>
<option value="26">高山族</option>
<option value="27">景颇族</option>
<option value="28">珞巴族</option>
<option value="29">锡伯族</option>
<option value="30">德昂(崩龙)族</option>
<option value="31">保安族</option>
<option value="32">基诺族</option>
<option value="33">门巴族</option>
<option value="34">毛南族</option>
<option value="35">赫哲族</option>
<option value="36">裕固族</option>
<option value="37">撒拉族</option>
<option value="38">独龙族</option>
<option value="39">普米族</option>
<option value="40">仫佬族</option>
<option value="41">仡佬族</option>
<option value="42">东乡族</option>
<option value="43">拉祜族</option>
<option value="44">土家族</option>
<option value="45">纳西族</option>
<option value="46">傈僳族</option>
<option value="47">布朗族</option>
<option value="48">哈萨克族</option>
<option value="49">达斡尔族</option>
<option value="50">鄂伦春族</option>
<option value="51">鄂温克族</option>
<option value="52">俄罗斯族</option>
<option value="53">塔塔尔族</option>
<option value="54">塔吉克族</option>
<option value="55">柯尔克孜族</option>
<option value="56">乌兹别克族</option>
<option value="57">国外</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">宗教信仰：</td>
    <td>
<select name="belief" id="belief" class="select64">
<option value="">不限</option>
<option value="0" selected="selected">保密</option>
<option value="1">不信教</option>
<option value="2">不可知论者无神论者</option>
<option value="3">儒家门徒</option>
<option value="4">佛教</option>
<option value="5">道教</option>
<option value="6">天主教</option>
<option value="7">基督教</option>
<option value="8">伊斯兰教</option>
<option value="9">犹太教</option>
<option value="10">印度教</option>
<option value="11">新教</option>
<option value="12">喇嘛教</option>
<option value="13">其它教派</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">是否吸烟：</td>
    <td>
<select name="smoking" id="smoking" class="select64">
<option value="">不限</option>
<option value="1">不吸烟</option>
<option value="2">稍微抽一点儿</option>
<option value="3">抽的很凶</option>
<option value="4">抽雪茄/烟斗</option>
<option value="0" selected="selected">保密</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">是否喝酒：</td>
    <td>
<select name="drinking" id="drinking" class="select64">
<option value="">不限</option>
<option value="1">不喝酒</option>
<option value="2">稍微喝一点/社交场合喝</option>
<option value="3">喝的很凶</option>
<option value="0" selected="selected">保密</option>
</select>
	</td>
  </tr>
  <tr>
    <td align="right">生肖：</td>
    <td>
<select name="animal" id="animal" class="select64">
<option value="">不限</option>
<option value="1">鼠</option>
<option value="2">牛</option>
<option value="3">虎</option>
<option value="4">兔</option>
<option value="5">龙</option>
<option value="6">蛇</option>
<option value="7">马</option>
<option value="8">羊</option>
<option value="9">猴</option>
<option value="10">鸡</option>
<option value="11">狗</option>
<option value="12">猪</option>
</select>
</td>
  </tr>
  <tr>
    <td align="right">星座：</td>
    <td>
<select name="constellation" id="constellation" class="select64">
<option value="">不限</option>
<option value="1">白羊座</option>
<option value="2">金牛座</option>
<option value="3">双子座</option>
<option value="4">巨蟹座</option>
<option value="5">狮子座</option>
<option value="6">处女座</option>
<option value="7">天秤座</option>
<option value="8">天蝎座</option>
<option value="9">射手座</option>
<option value="10">摩羯座</option>
<option value="11">水瓶座</option>
<option value="12">双鱼座</option>
</select>
</td>
  </tr>
  <tr>
    <td align="right">血型：</td>
    <td>
<select name="bloodtype" id="bloodtype" class="select64">
<option value="">不限</option>
<option value="1">A型</option>
<option value="2">B型</option>
<option value="3">AB型</option>
<option value="4">O型</option>
<option value="5">不确定</option>
</select>
	</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="high_search" type="image" src="<?php echo STATIC_IMG_PATH;?>gjss.gif" /></td>
  </tr>
</table>
 </form>
      </div>
    <!--爱情搜索左侧 end-->

  </div>
  <div class="right" style="height:1240px;">
    <div class="rightbot"><img src="<?php echo STATIC_IMG_PATH;?>zlbot.gif" /></div>
    <div class="zntop">
      <h1><img src="<?php echo STATIC_IMG_PATH;?>zltop.gif" /></h1>
      <p>为了保护你的安全，请您在征婚时提高防范意识。 </p>
      <p>在双方确立正式婚姻关系之前，尽量避免与对方发生任何形式的财物往来。对方方方方方方如果向您提&nbsp;&nbsp;<a href="#">[详情内容]</a></p>
    </div>
    <div class="banrx"><img src="<?php echo STATIC_IMG_PATH;?>banrDJ.gif" /></div>
    <div class="dsbl">
      <h1><img src="<?php echo STATIC_IMG_PATH;?>dsbl.gif" /></h1>
      <dl>
        <dt><img src="<?php echo STATIC_IMG_PATH;?>tu01.jpg" /></dt>
        <dd class="gray">明确自己想从婚姻中得到什么——是得到彼此的陪伴、得到爱，还是出... <a href="#">[详细]</a></dd>
        <div style="clear:both; height:0; overflow:hidden;"></div>
      </dl>
      <ul>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
      </ul>
    </div>
    <div class="dsbl">
      <h1><img src="<?php echo STATIC_IMG_PATH;?>aqgs.gif" /></h1>
      <ul>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li><a href="#">婚恋交友：再婚之7大注意问题</a></li>
        <li style="background:none; text-align:right;"><a href="#">更多>></a></li>
      </ul>
    </div>
  </div>
  <div style="clear:both; height:0; overflow:hidden;"></div>

</div>