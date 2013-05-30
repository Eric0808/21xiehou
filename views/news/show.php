<!-- daohang -->
<div class="daohang"><p>当前位置：<a href="<?php echo base_url();?>">首页</a> > <a href="<?php echo base_url(),'news/';?>">婚恋百科</a> > <a href="<?php echo base_url(),'news/cate/',$catID;?>"><?php echo $catName; ?></a></p></div>
<!-- daohang end -->

<script language="javascript">
$(window).load(function(){
	$("#0").css('background','red');
})
function cli_page(id)
{
		var val = $("#s_"+id).html();
		$("#content").html(val);
		
		var page = $("#allpage").html();
		for(var i=0;i<page;i++)
		{
			if(i==id)
			{
				$("#"+id).css('background','red');
			}else{
				$("#"+i).css('background','#ffffff');
			}
		}
	
}
</script>
<!-- main -->
<div class="main hwcen01" style=" margin-top:10px;">
  <div class="hwbot01" style="bottom:-80px;"><img src="<?php echo STATIC_IMG_PATH;?>hwbot01.gif" /></div>
  <div class="left" style="height:auto;">
  <div class="hwtop01"><img src="<?php echo STATIC_IMG_PATH;?>hwtop01.gif" /></div>
    <div class="hudie"><img src="<?php echo STATIC_IMG_PATH;?>hudie.png" /></div>
    <div class="hlbiaot"><?php echo $title;?></div>
    <div class="hlcen" id="content">
      <p><?php echo $content[0];?></p>	 
      
    </div>
    <div class="fenye1">
	共
	  <a href="#" id='allpage' class="jia18"><?php echo $content_num;?></a>
	  页 &nbsp;
	  <?php foreach($content as $k=>$v){?>
	  <a href="#" id="<?php echo $k;?>" onclick="cli_page(this.id)"><?php echo $k+1;?></a>
	  <div id="s_<?php echo $k;?>" style="display:none"><?php echo $v;?></div>
	  <?php }?>
	</div>
    <div class="hlcenbot">责任编辑：<?php echo $editer;?><br /><?php echo $time;?>    
    </div>
    <div class="lhlie">
      <h1>相关文章</h1>
      <ul>
	  <?php 
		if( isset($relex_news)):
			foreach($relex_news as $var):
		?>
		 <li>·<a href="<?php echo base_url(),'news/show/',$var['id'];?>"><?php echo $var['title'];?> </a></li>
		<?php 
			endforeach;
		endif; ?>
       
        
      </ul>
    </div>
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
        <li style="background:none; text-align:right;"><a href="#">更多>></a></li>
      </ul>
    </div>
  </div>
  <div style="clear:both; height:0; overflow:hidden;"></div>

</div>

<!-- main end -->