<div class="main" style=" padding-bottom:0px;">
   <div class="bknav">
   <?php foreach((array)$subcate as $value){?>
   <a href="<?php echo base_url(),'news/cate/',$value['catid'];?>"><?php echo $value['catname'];?></a>
  <?php }?>
   </div>
   <div class="zixun">
     <div class="jia01"></div>
     <div class="jia02"></div>
     <div class="jia03"></div>
     <div class="jia04"></div>
     <div class="zixunJS">
     <script type="text/javascript">
function setTab(/*string*/name,/*int*/ itemCnt,/*int*/ curItem, /**/classHide, /**/classShow)
{
	 for(i=1;i<=itemCnt;i++)
	{
		eval("document.getElementById('tab_" + name + "_" + i + "').className='" + classHide + "'");
	} 
	eval("document.getElementById('tab_" + name + "_" + curItem + "').className='" + classShow + "'");
 
 for(i=1;i<=itemCnt;i++)
 {
  eval("ele_hide = document.getElementById('con_" + name + "_" + i +"')");
  if(ele_hide) ele_hide.style.display = "none";
 }
 eval("ele_play = document.getElementById('con_" + name + "_" + curItem + "')");
 if(ele_play) ele_play.style.display = "block";
}
</script>
       <div class="banner" id="banner">
  <div class="banner_tab clearfix">
    <ul>
      <li id="tab_tophome_1" class="on"><a href="#" target="_blank"  onmousemove="startIndex=1;setTab('tophome',4,1,'out','on');" onclick="javascript:pgvSendClick({hottag:'KF.SERVICE.INDEX.PHONE_2'});"><span>关注用户关注用户关注用户关注用关注用户关注用户...</span><img src="<?php echo STATIC_IMG_PATH;?>ad_1.jpg"  class="tab_img" alt="电话按键指引"/></a></li>
      <li id="tab_tophome_2" class="out"><a href="#" target="_blank" onmousemove="startIndex=2;setTab('tophome',4,2,'out','on');" onclick="javascript:pgvSendClick({hottag:'KF.SERVICE.INDEX.SELF_2'});"><span>关注用户关注用户关注用户关注用关注用户关注用户...</span><img src="<?php echo STATIC_IMG_PATH;?>ad_3.jpg"  class="tab_img" alt="自助服务"/></a></li>
      <li id="tab_tophome_3" class="out"><a href="#" target="_blank" onmousemove="startIndex=3;setTab('tophome',4,3,'out','on');" onclick="javascript:pgvSendClick({hottag:'KF.SERVICE.INDEX.STUDY_2'});"><span>关注用户关注用户关注用户关注用关注用户关注用户...</span><img src="<?php echo STATIC_IMG_PATH;?>ad_2.jpg"  class="tab_img" alt="腾讯学堂"/></a></li>
      <li id="tab_tophome_4" class="out"><a href="#" target="_blank" onmousemove="startIndex=4;setTab('tophome',4,4,'out','on');" onclick="javascript:pgvSendClick({hottag:'KF.SERVICE.INDEX.SOSO_2'});"><span>关注用户关注用户关注用户关注用关注用户关注用户...</span><img src="<?php echo STATIC_IMG_PATH;?>ad_4.jpg"  class="tab_img" alt="问问专区"/></a></li>
    </ul>
  </div>
  <div>
    <div id="con_tophome_1"><a href="#" target="_blank" onclick="javascript:pgvSendClick({hottag:'KF.SERVICE.INDEX.PHONE_1'});"><img src="<?php echo STATIC_IMG_PATH;?>ad_1.jpg"/></a></div>
    <div id="con_tophome_2"  class="hidecontent"><a href="#" target="_blank" onclick="javascript:pgvSendClick({hottag:'KF.SERVICE.INDEX.SELF_1'});"><img src="<?php echo STATIC_IMG_PATH;?>ad_3.jpg"/></a></div>
    <div id="con_tophome_3"  class="hidecontent"><a href="#" target="_blank" onclick="javascript:pgvSendClick({hottag:'KF.SERVICE.INDEX.STUDY_1'});"><img src="<?php echo STATIC_IMG_PATH;?>ad_2.jpg" /></a></div>
    <div id="con_tophome_4"  class="hidecontent"><a href="#" target="_blank" onclick="javascript:pgvSendClick({hottag:'KF.SERVICE.INDEX.SOSO_1'});"><img src="<?php echo STATIC_IMG_PATH;?>ad_4.jpg"/></a></div>
    <div class="clear"></div>
  </div>
</div>
<script type="text/javascript">
 var pause = false;
 var con_num = 4;
 var startIndex = 1;
 function setLoop(){
  try{
   var oScroll = document.getElementById('banner');
   oScroll.noWrap = true;
   oScroll.onmouseover = function(e){pause = true;};
   oScroll.onmouseout = function(e){pause = false;};
   setInterval('scrollTopHome()', 3000);
   }catch(e){alert(e.toString());}
 }
 function scrollTopHome(){
  if(pause) return;
  startIndex += 1;
  if(startIndex > con_num){startIndex = 1;}
  setTab('tophome',4,startIndex,'out','on');
 } 
 setLoop();
</script>

     </div>
     <div class="zixunrit">
	 <?php foreach($position_1 as $key=>$var) {?>
       <div class="zixunrit01">
         <h1><a href="<?php echo base_url(),'news/show/',$var['data']['id'];?>"><?php echo $var['data']['title'];?></a></h1>
         <p><?php echo $var['data']['news_desc'];?><a href="<?php echo base_url(),'news/show/',$var['data']['id'];?>">[详细]</a></p>
       </div>
       <?php }?>
       <div class="zixunrit02">
       </div>
       <div class="zixunrit03">
         <ul>
		 <?php foreach($position_2 as $key=>$var) {?>
       <li><a href="<?php echo base_url(),'news/cate/',$var['catid'];?>" class="chen">【<?php echo $cateall[$var['catid']]['catname']?>】</a> <a href="<?php echo base_url(),'news/show/',$var['data']['id'];?>" class="blue01"><?php echo $this->globalfunc->str_cut($var['data']['title'],40,'');?></a> </li>
       <?php }?>
         </ul>
       </div>
     </div>
   </div>
   <div style="clear:both;"></div>
 </div>
<!-- main end -->


<div class="mainH">
  <!-- 婚恋教室 -->
  <div class="hljs">
    <div class="hljstop">
      <span class="yh16">婚恋教室</span>
      <a href="#">更多>></a>
      <div style="clear:both; height:0; overflow:hidden;"></div>
    </div>
    <div class="hljsbot">
      <h1>惊！男人择偶最看重这10件事</h1>
      <p>很多工作或事业都比较好的女生总是搞不懂，自己那么优秀怎么就没有优秀的男生青睐呢?甚至是自己都快进入剩...... <a href="#">【详细】</a> </p>
<dl class="k100">
        <dt><img src="<?php echo STATIC_IMG_PATH;?>tu4.gif" /></dt>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
      </dl>      
    </div>
  </div>
  <!-- 婚恋教室 end -->
  
  <!-- 热点专题 -->
  <div class="rezt">
    <div class="rezttop"><img src="<?php echo STATIC_IMG_PATH;?>hot.png" />热点专题</div>
    <div class="teztot">
      <dl>
        <dt><img src="<?php echo STATIC_IMG_PATH;?>tu6.gif" /></dt>
        <dd class="bluea">好夫妻是相互夸出来的</dd>
        <dd class="huia">在婚姻幸福的十大杀手中，
排名首...<a href="#">【详细】</a></dd>
      </dl>
      <dl>
        <dt><img src="<?php echo STATIC_IMG_PATH;?>tu6.gif" /></dt>
        <dd class="bluea">好夫妻是相互夸出来的</dd>
        <dd class="huia">在婚姻幸福的十大杀手中，
排名首...<a href="#">【详细】</a></dd>
      </dl>
      <dl>
        <dt><img src="<?php echo STATIC_IMG_PATH;?>tu6.gif" /></dt>
        <dd class="bluea">好夫妻是相互夸出来的</dd>
        <dd class="huia">在婚姻幸福的十大杀手中，
排名首...<a href="#">【详细】</a></dd>
      </dl>
      <div style="clear:both; height:0; overflow:hidden;"></div>
      <p><a href="#">了解往日更多专题>></a></p>
    </div>
  </div>
  <!-- 热点专题 end -->
  <div style="height:0; clear:both; overflow:hidden;"></div>
</div>
<div class="banr" style="margin-top:10px;">
  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="935" height="110">
    <param name="movie" value="<?php echo STATIC_IMG_PATH;?>横幅广告2.swf" />
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="11.0.0.0" />
    <!-- 此 param 标签提示使用 Flash Player 6.0 r65 和更高版本的用户下载最新版本的 Flash Player。如果您不想让用户看到该提示，请将其删除。 -->
    <param name="expressinstall" value="<?php echo STATIC_JS_PATH;?>Scripts/expressInstall.swf" />
    <!-- 下一个对象标签用于非 IE 浏览器。所以使用 IECC 将其从 IE 隐藏。 -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="<?php echo STATIC_IMG_PATH;?>横幅广告2.swf" width="935" height="110">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="11.0.0.0" />
      <param name="expressinstall" value="<?php echo STATIC_JS_PATH;?>Scripts/expressInstall.swf" />
      <!-- 浏览器将以下替代内容显示给使用 Flash Player 6.0 和更低版本的用户。 -->
      <div>
        <h4>此页面上的内容需要较新版本的 Adobe Flash Player。</h4>
        <p><a href="http://www.adobe.com/go/getflashplayer">点此获取较新版本的 Adobe Flash Player。</a></p>
      </div>
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object>
</div>
<div class="mainH">
  <!-- 精品推荐 -->
  <div class="rezt">
    <div class="rezttop"><img src="<?php echo STATIC_IMG_PATH;?>hot.png" />精品推荐<a href="#">更多</a></div>
    <div class="teztot">
      <dl>
        <dt><img src="<?php echo STATIC_IMG_PATH;?>tu6.gif" /></dt>
        <dd class="bluea">好夫妻是相互夸出来的</dd>
        <dd class="huia">在婚姻幸福的十大杀手中，
排名首...<a href="#">【详细】</a></dd>
      </dl>
      <ul>
        <li><span>·</span><a href="#">揭秘：关于男女亲热8个意外功效 </a></li>
        <li><span>·</span><a href="#">揭秘：关于男女亲热8个意外功效 </a></li>
        <li><span>·</span><a href="#">揭秘：关于男女亲热8个意外功效 </a></li>
        <li><span>·</span><a href="#">揭秘：关于男女亲热8个意外功效 </a></li>
        <li><span>·</span><a href="#">揭秘：关于男女亲热8个意外功效 </a></li>
        <li><span>·</span><a href="#">揭秘：关于男女亲热8个意外功效 </a></li>
        <li><span>·</span><a href="#">揭秘：关于男女亲热8个意外功效 </a></li>
        <li><span>·</span><a href="#">揭秘：关于男女亲热8个意外功效 </a></li>
        <li><span>·</span><a href="#">揭秘：关于男女亲热8个意外功效 </a></li>
      </ul>
      <div style="clear:both; height:0; overflow:hidden;"></div>
    </div>
  </div>
  <!-- 精品推荐 end -->
  <!-- 单身部落 -->
  <div class="hljs">
    <div class="hljstop">
      <span class="yh16">单身部落</span>
      <a href="#">更多>></a>
      <div style="clear:both; height:0; overflow:hidden;"></div>
    </div>
    <div class="hljsbot">
      <h1>惊！男人择偶最看重这10件事</h1>
      <p>很多工作或事业都比较好的女生总是搞不懂，自己那么优秀怎么就没有优秀的男生青睐呢?甚至是自己都快进入剩...... <a href="#">【详细】</a> </p>
      <dl class="k100">
        <dt><img src="<?php echo STATIC_IMG_PATH;?>tu4.gif" /></dt>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
      </dl>
    </div>
  </div>
  <!-- 单身部落 end -->
  <div style="height:0; clear:both; overflow:hidden;"></div>
</div>
<div class="mainH">
  <!-- 爱情故事 -->
  <div class="hljs">
    <div class="hljstop">
      <span class="yh16">爱情故事</span>
      <a href="#">更多>></a>
      <div style="clear:both; height:0; overflow:hidden;"></div>
    </div>
    <div class="hljsbot">
      <h1>惊！男人择偶最看重这10件事</h1>
      <p>很多工作或事业都比较好的女生总是搞不懂，自己那么优秀怎么就没有优秀的男生青睐呢?甚至是自己都快进入剩...... <a href="#">【详细】</a> </p>
      <dl class="k100">
        <dt><img src="<?php echo STATIC_IMG_PATH;?>tu4.gif" /></dt>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
        <dd><span>·</span><a href="#">相亲成功9大要素你知道吗？</a></dd>
      </dl>
    </div>
  </div>
  <!-- 爱情故事 end -->
  <div class="rezt">
    <div class="rezttu"><img src="<?php echo STATIC_IMG_PATH;?>tu7.gif" /></div>
    <div class="reztbq"><a href="#">名媛淑女</a>  <a href="#">精英男士</a>  <a href="#">爱情顾问</a> <a href="#">邂逅搜索</a>  <a href="#">热点专题</a>  <a href="#">成功故事</a>  <a href="#">注册会员</a>     <a href="#">登录</a>  <a href="#">交友</a>   <a href="#">婚礼策划</a>   <a href="#">我的邂逅</a></div>
  </div>
  <div style="height:0; clear:both; overflow:hidden;"></div>
</div>