<div class="danr01"><img src="<?php echo STATIC_IMG_PATH;?>banrT.jpg" /></div>


<!-- daohang -->
<div class="daohang"><p>当前位置：<a href="<?php echo base_url();?>">首页</a> > <a href="<?php echo base_url(),'news/';?>">婚恋百科</a> > <a href="<?php echo base_url(),'news/cate/',$catid;?>"><?php echo $catName; ?></a></p></div>
<!-- daohang end -->


<!-- main -->
<div class="main hwcen01" style=" margin-top:10px;">
  <div class="hwbot01" style="bottom:-80px;"><img src="<?php echo STATIC_IMG_PATH;?>hwbot01.gif" /></div>
  <div class="left">
  <div class="hwtop01"><img src="<?php echo STATIC_IMG_PATH;?>hwtop01.gif" /></div>
    <div class="hudie"><img src="<?php echo STATIC_IMG_PATH;?>hudie.png" /></div>
    <div class="hllist">
      <ul>
	  <?php foreach($list as $key=>$value){
		if($key>=0 && $key<10){
	  ?>
        <li>·<a href="<?php echo base_url(),'news/show/',$value['id'];?>"><?php echo $value['title'];?> </a><span>(<?php echo $value['addtime'];?>) </span></li>
		<?php
		 }		
		}?>
      </ul>
	  <ul>
	  <?php foreach($list as $key=>$value){
		if($key>=10 && $key<20){
	  ?>
        <li>·<a href="<?php echo base_url(),'news/show/',$value['id'];?>"><?php echo $value['title'];?> </a><span>(<?php echo $value['addtime'];?>) </span></li>
		<?php
		 }		
		}?>
      </ul>
	  <ul>
	  <?php foreach($list as $key=>$value){
		if($key>=20 && $key<30){
	  ?>
        <li>·<a href="<?php echo base_url(),'news/show/',$value['id'];?>"><?php echo $value['title'];?> </a><span>(<?php echo $value['addtime'];?>) </span></li>
		<?php
		 }		
		}?>
      </ul>
      
    </div>
    <div class="fenye"><?php echo $pagestr;?></div>
  </div>
  <div class="right">
    <div class="zntop">
      <h1><img src="<?php echo STATIC_IMG_PATH;?>zhzn.gif" /></h1>
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

<!-- main end -->