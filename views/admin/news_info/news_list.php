<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
<!--
body {
	margin-left: 3px;
	margin-top: 0px;
	margin-right: 3px;
	margin-bottom: 0px;
	
}
.option {
	color: #e1e2e3;
	font-size: 12px;
	text-decoration: none;
}
.STYLE1 {
	color: #e1e2e3;
	font-size: 12px;
}
.STYLE6 {color: #000000; font-size: 12; }
.STYLE10 {color: #000000; font-size: 12px; }
.STYLE19 {
	color: #344b50;
	font-size: 12px;
	padding:2px;
}
.STYLE21 {
	font-size: 12px;
	color: #3b6375;
}
.option1 {
	color: #3b6375;
	font-size: 12px;
	text-decoration: none;
}
.STYLE22 {
	font-size: 12px;
	color: #295568;
}
#pages {
padding: 14px 0 10px;
font: 12px/1.5 tahoma,arial,宋体b8b\4f53,sans-serif;
font-family: 宋体;
text-align: right;
}
#pages a.a1 {
background: url('<?php echo STATIC_IMG_PATH?>admin_img/pages.png') no-repeat 0 5px;
width: 56px;
padding: 0;
}
#pages a:hover {
background: #F1F1F1;
color: black;
text-decoration: none;
}
#pages a {
display: inline-block;
height: 22px;
line-height: 22px;
background: white;
border: 1px solid #E3E3E3;
text-align: center;
color: #333;
padding: 0 10px;
text-decoration: none;
}
#pages span {
display: inline-block;
height: 22px;
padding: 0 10px;
line-height: 22px;
background: #5A85B2;
border: 1px solid #5A85B2;
color: white;
text-align: center;
}

.table2 tr.hover:hover td {
background: #d3eaef;
}
.explain-col {
border: 1px solid #FFBE7A;
background: #FFFCED;
padding: 8px 10px;
line-height: 20px;
text-align: left;
margin:10px;
font: 12px/1.5 tahoma,arial,宋体b8b体4f53,sans-serif;
}
img{
vertical-align: middle;
}
-->
</style>
<script charset="utf-8" src="<?php echo STATIC_JS_PATH?>jquery.min.js" type="text/javascript"></script>
   <script type="text/javascript">
        $(function() {
           $("#checkall").add("#check_box").click(function() {
                $('input[name="ids[]"]').attr("checked",this.checked); 
            });
            var $subBox = $("input[name='ids[]']");
            $subBox.click(function(){
				$("#checkall").add("#check_box").attr("checked",$subBox.length == $("input[name='ids[]']:checked").length ? true : false);
            });
        });
    </script>
</head>

<body>
<style type="text/css">
	html{_overflow-y:scroll}
</style>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo STATIC_IMG_PATH?>admin_img/tb.gif" width="14" height="14" /></div></td>
                <td width="94%" valign="bottom"><span class="STYLE1"> 新闻列表</span></td>
              </tr>
            </table></td>
            <td><div align="right"><span class="STYLE1">
              <input type="checkbox" name="checkbox11" id="checkall" />
              全选      &nbsp;&nbsp;<img src="<?php echo STATIC_IMG_PATH?>admin_img/add.gif" width="10" height="10" /> <a class="option" href='<?php echo site_url('admin/news_info');?>' target="rightFrame">添加文章</a>&nbsp; <img src="<?php echo STATIC_IMG_PATH?>admin_img/del.gif" width="10" height="10" /> <a class="option" style="cursor:hand;" onclick='return confirm_delete();' target="rightFrame">删除</a>    &nbsp;</span><span class="STYLE1"> &nbsp;</span></div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<?php echo form_open('admin/news_info/del_news',array('target'=>'rightFrame','name'=>'myform','id'=>'myform'));?>
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" class="table2">
      <tr>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="center">
          <input type="checkbox" value="" id="check_box" />
        </div></td>
        <td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">ID</span></div></td>
        <td width="20%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">标题</span></div></td>
		 <td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">发布人</span></div></td>
        <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">发布时间</span></div></td>
        <td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">所属频道</span></div></td>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">编辑</span></div></td>
		<td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">点击次数</span></div></td>
        <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
      </tr>
	  <?php foreach($news as $new) {?>
      <tr class="hover">
        <td height="20" bgcolor="#FFFFFF"><div align="center">
           <input type="checkbox" name="ids[]" value="<?php echo $new['id'];?>" />
        </div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo $new['id'];?></span></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left" style="margin-left:10px;">
		<?php echo $new['title'];?>
		<?php echo !empty($new['image'])||!empty($new['image'])==true?'<img src="'.STATIC_IMG_PATH.'admin_img/small_img.gif" title="缩略图">' : '';?>
		<?php echo $new['posids']!=0?'<img src="'.STATIC_IMG_PATH.'admin_img/small_elite.gif" title="推荐">' : '';?>
		</div></td>
		 <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $new['editer'];?></div></td>
		<td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $new['addtime'];?></div></td>
		<td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $new['catname'];?></div></td>
		<td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $new['author'];?></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $new['hits'];?></div></td>
       
        <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE21">
		<a class="option1" title="删除" href="javascript:linkok('<?php echo site_url('admin/news_info/del_news').'?id='.$new['id'];?>')" target="rightFrame"><img src='<?php echo STATIC_IMG_PATH?>admin_img/delete.gif'/></a> 
		&nbsp;&nbsp;<a class="option1" title="编辑" href='<?php echo site_url('admin/news_info/edit_news').'?id='.$new['id'];?>' target="rightFrame"><img src='<?php echo STATIC_IMG_PATH; ?>admin_img/edit.png'/></a>		
		</div></td>
      </tr>
      <?php }?>
    </table>
	<div style="text-align: left;padding: 5px;">
		<select name="mov_posid" id="mov_posid"  title="请选择推荐位" >
		<option value="-1" >请选择推荐位</option>
		<?php foreach($posList as $key=>$pos) {?>
		<option value="<?php echo $pos['posid'];?>" ><?php echo $pos['name'];?></option>
		<?php }?>
		</select>
		<input type="button" name="move" value=" 批量推荐 " onclick="myform.action='<?php echo site_url('admin/news_info/move_tops')?>';myform.submit();" >
	</div>
	</form>
	</td>
  </tr>
  <tr>
  <td>
    <div id="pages">
	  <?php echo $pagestr;?>
	  </div>
   </td>
  </tr>
</table>
<script type="text/javascript">
<!--
    function linkok(url){
    question = confirm("你确定要删除该文章吗？");
    if (question){
    window.location.href = url;
    }
    }
    //-->
function confirm_delete(){
	if(confirm('你确定要删除文章吗？')) $('#myform').submit();
}
</script>
</body>
</html>
