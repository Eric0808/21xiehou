<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?php echo STATIC_IMG_PATH?>admin_img/admincp.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STATIC_IMG_PATH?>admin_img/calendar.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script charset="utf-8" src="<?php echo STATIC_JS_PATH?>common.js" type="text/javascript"></script>
<script charset="utf-8" src="<?php echo STATIC_JS_PATH?>admin/jquery.js" type="text/javascript"></script>
<script charset="utf-8" src="<?php echo STATIC_IMG_PATH?>admin_img/admincp.js" type="text/javascript"></script>
<script charset="utf-8" src="<?php echo STATIC_IMG_PATH?>admin_img/calendar.js" type="text/javascript"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="24" bgcolor="#353c44">
<tr>
<td width="6%" height="19" valign="middle"><div align="center"><img src="<?php echo STATIC_IMG_PATH?>admin_img/tb.gif" width="14" style="ertical-align: middle;" height="14" /></div></td>
<td width="94%" valign="middle"><span style="color: #E1E2E3;font-size: 12px;"> 添加<?php echo '<'.$_GET['catname'].'>'?>子栏目</span></td>
</tr>
</table>
<table class="tb tb2 " id="tips" style="width:100%;">
<tr><th  class="partition">提示</th></tr>
<tr ><td class="tipsblock" ><ul id="tipslis"><li></li><li></li></ul></td></tr></table>
<?php echo form_open('admin/news_info/add_cates',array('target'=>'rightFrame','name'=>'myform','id'=>'myform'));?>
<table class="tb tb2 " id="categorylist" style="width:95%;">
<tr class="header">
<th>  排序</th>
<th>  栏目名称</th>
<th>   栏目描述</th>
</tr>
<input type="hidden" value="<?php echo $fid;?>" name="fid">
<tr class="hover">
<td width="60px"><input type="text" value="0" size="2" name="newdisplay[]"></td>
<td width="200px"><input type="text" value="新建栏目名称" name="newcategory[]" size="25" onfocus="this.className='txt'" onblur="this.className='txtnobd'" class="txtnobd" /></td>
<td width="300px"><input type="text" name="newdescription[]" value="" size="35"></td>
</tr>
<tr class="hover"><td></td><td colspan="2"><a id="addcategory" href="javascript:return false;" class="addtr">添加一个子栏目</a></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td colspan="15"><div class="fixsel"><div id="ajax_status_display"></div><input type="submit" class="btn" id="submit_listsubmit" name="listsubmit" title="按 Enter 键可随时提交您的修改" value="Submit" /></div><br /><br /><br /><br /></td></tr>
</table>
</form>
<script type="text/javascript">
		$(function(){
			$("#addcategory").click(function(){
				$(this).parent().parent().before('<tr class="hover"><td><input type="text" value="0" size="2" name="newdisplay[]"></td><td><input type="text" value="新建栏目名称" name="newcategory[]" size="25" onfocus="this.className=\'txt\'" onblur="this.className=\'txtnobd\'" class="txtnobd" /></td><td><input type="text" name="newdescription[]" value="" size="35"></td>');
			});

		});
	</script></body></html>