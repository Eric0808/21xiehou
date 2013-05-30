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
<td width="94%" valign="middle"><span style="color: #E1E2E3;font-size: 12px;"> 内容分类管理</span></td>
</tr>
</table>
<div class="container" id="cpcontainer">
<div class="explain-col">

</div>
<?php echo form_open('admin/news_info/add_cates',array('target'=>'rightFrame','name'=>'myform','id'=>'myform'));?>
<table class="tb tb2 " id="categorylist" style="width:95%;">
<tr class="header">
<th></th>
<th>排序</th>
<th>栏目名称</th>
<th>栏目描述</th>
<th>ID</th>
<th>操作</th></tr>
<?php foreach($cateList as $cate) {?>
<tr class="hover" >
<td width="10px"><a class="showchild" <?php if($cate->fid!=0) {echo 'style="display:none;"';} ?> catid="<?php echo $cate->catid;?>"  href="javascript:return return;">+</a></td>
<td width="60px"><input name="display[<?php echo $cate->listorder;?>]" type="text" size="2" value="<?php echo $cate->listorder;?>" /></td>
<td width="200px"><input type="text" class="txtnobd" onblur="this.className='txtnobd'" onfocus="this.className='txt'" size="25" name="name[<?php echo $cate->catid;?>]" value="<?php echo $cate->catname;?>">&nbsp;&nbsp;<a class="addtr newchild"  title="添加相关子类别" href='<?php echo site_url('admin/news_info/news_cates')."?catid=".$cate->catid."&catname=".$cate->catname;?>'  target="rightFrame"> </a></td>
<td width="300px"><input type="text" name="description[<?php echo $cate->catid;?>]" value="<?php echo $cate->description;?>" size="35"></td>
<td><font class="tips2">(catid:<?php echo $cate->catid;?>)</font></td>
<td> [<a href="javascript:linkok('<?php echo site_url('admin/news_info/del_cates').'?catid='.$cate->catid;?>')">删除</a>]
[<a href="update_cates?catid=<?php echo $cate->catid;?>">编辑</a>]
</td></tr>

<?php }?>
<tr class="hover"><td></td><td colspan="2"><a id="addcategory" href="javascript:return false;" class="addtr">添加一级栏目</a></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td colspan="15"><div class="fixsel"><div id="ajax_status_display"></div><input type="submit" class="btn" id="submit_listsubmit" name="listsubmit" title="按 Enter 键可随时提交您的修改" value="提交" /></div><br /><br /><br /><br /></td></tr>
</table>
</form>
<script type="text/javascript">
<!--
    function linkok(url){
    question = confirm("若该栏目包含子栏目，将一起删除，您确定删除吗？");
    if (question){
    window.location.href = url;
    }
    }
    //-->

		$(function(){
			function showchild(obj) {
				$(obj).unbind();
				var catid = $(obj).attr("catid");
				//$(obj).parent().parent().hide();admin.php?action=category&op=showchild&inajax=1&type=shop
				$.get("showsubajax?inajax=1&catid="+catid,
				  function(data){
					$(obj).parent().parent().after(data);
					$(obj).attr("local", "lock");
					togglebind();
					togglebind_newchild();
					$(obj).unbind();
					$(obj).click(function(){
						hiddenchild(this);
					});
					$(obj).empty();
					$(obj).append("-");
				  });
			}
			function hiddenchild(obj) {
				var catid = $(obj).attr("catid");
				var childs = $(".showchild[upid='"+catid+"']");
				for(var i = 0; i < childs.length; i++) {
					$(childs[i]).parent().parent().hide();
					hiddenchild(childs[i]);
				}
				$(obj).unbind();
				$(obj).click(function(){
					showchild_local(this);
				});
				$(obj).empty();
				$(obj).append("+");

			}
			function showchild_local(obj) {
				var catid = $(obj).attr("catid");
				$(".showchild[upid='"+catid+"']").parent().parent().show();
				$(obj).unbind();
				$(obj).click(function(){
					hiddenchild(this);
				});
				$(obj).empty();
				$(obj).append("-");
			}
			function togglebind() {
				$(".showchild[local!='lock']").unbind();
				$(".showchild[local!='lock']").click(function(){
					showchild(this);
					//$(this).parent().parent().hide();
				});
			}
			function togglebind_newchild() {
				$(".newchild").unbind();
				$(".newchild").click(function(){
					var catid = $(this).attr("catid");
					var tds = $(this).parent().parent().find("td");
					var pre = $(tds[2]).text();
					var ss = pre.split("|----");
					if(ss.length == 1) {
						pre = "|----";
					} else {
						pre = pre+"|----";
					}
					if(ss.length >= 4) {
						location.href="admin.php?action=category&op=newchild&upid="+catid+"&type=shop";
						return false;
					}
					$(this).parent().parent().after('<tr class="hover"><td><a style="display:none;" class="showchild" upid="'+catid+'" href="javascript:return return;">+</a></td><td><input type="text" value="0" size="2" name="newchilddisplay['+catid+'][]"></td><td>'+pre+'<input type="text" value="新建子分类名称" name="newchildcategory['+catid+'][]" size="15" onfocus="this.className=\'txt\'" onblur="this.className=\'txtnobd\'" class="txtnobd"></td><td></td><td></td></tr>');
				});
			}
			togglebind();
			//togglebind_newchild();
			$("#addcategory").click(function(){
				$(this).parent().parent().before('<tr class="hover"><td></td><td><input type="text" value="0" size="2" name="newdisplay[]"></td><td><input type="text" value="新建栏目名称" onfocus="if(value==\'新建栏目名称\') {value=\'\'}" onblur="if(value==\'\'){value=\'新建栏目名称\'}" name="newcategory[]" size="25" onfocus="this.className=\'txt\'" onblur="this.className=\'txtnobd\'" class="txtnobd" /></td><td><input type="text" name="newdescription[]" value="" size="35"></td></tr>');
			});

		});
	</script></body></html>