<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_CSS_PATH; ?>table_form.css" charset="UTF-8"/>
<link rel="stylesheet" href="<?php echo STATIC_PATH; ?>xedit/common.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo STATIC_PATH; ?>xedit/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_PATH; ?>xedit/xheditor-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_PATH; ?>xedit/xheditor_lang/zh-cn.js"></script>
<script type="text/javascript">
$(pageInit);
function pageInit()
{
	
	$('#elm1').xheditor({upLinkUrl:"<?php echo site_url('admin/news_info/Upload');?>",upLinkExt:"zip,rar,txt",upImgUrl:"<?php echo site_url('admin/news_info/Upload');?>",upImgExt:"jpg,jpeg,gif",upFlashUrl:"<?php echo site_url('admin/news_info/Upload');?>",upFlashExt:"swf"});
}

</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo STATIC_IMG_PATH; ?>admin_img/tb.gif" width="14" height="14" /></div></td>
                <td width="94%" valign="bottom"><span class="STYLE1">编辑文章</span></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<?php echo form_open_multipart('admin/news_info/edit_news',array('target'=>'rightFrame','name'=>'myform','id'=>'myform'));?>
	<input type="hidden" name="edit_id" value=<?php echo $id?>>
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
     <input  type="hidden" name="edit_id" value="<?php echo $id;?>"/>
      <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">标题：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="text" value=<?php echo $title?> id="title" class="input-text" name="title" style="width:400px;"></div>
		</td>
      </tr>
	   <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">栏目：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2">
		<select id="news_cate" class="input-text" name="news_cate">
		<option value=<?php echo $catid?> selected>&nbsp;&nbsp;&nbsp;└─<?php echo $catname?></option>
		<?php echo $cateList;?>
		</select>
		</div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">文章来源：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="text" value=<?php echo $source?> id="source" class="input-text" style="width:400px;" name="source" ></div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">作者：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="text" value=<?php echo $editer?> id="author" class="input-text" name="author" ><span style="color:red;">注：留空则默认为“管理员”</span></div>
		</td>
      </tr>
	  
      <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">是否发布：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2">
		<input name="ispost" id="ispost" type="checkbox" checked="checked" style="margin-right:5px;" value="1" /><label for="isbank" style="margin-right:10px;">打钩为是</label>
		</div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">文章缩略图：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2">
		<label> <input name="image_upload" type="file" size="50"><img height="100px" width="100px" src="<?php echo ROOT_PATH.$image?>"></img></label>
		</div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">文章大图：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2">
		<label> <input name="pic_upload" type="file" size="50"><img height="100px" width="100px" src="<?php echo ROOT_PATH.$picture?>"></img></label>
		</div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">摘要：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2">
		<textarea name="news_desc" class="input-text" cols="60" rows="6"><?php echo $news_desc?></textarea>
		</div>
		</td>
      </tr>
       <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1" ><span class="STYLE19">内容：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2" style="padding:10px;">
		<textarea id="elm1" name="elm1" rows="12" cols="80" style="width: 80%;height: 350px;"><?php echo stripslashes($content);?></textarea>
		</div>
		</td>
      </tr>
	 
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" colspan="2" class="STYLE6">
		<div class="input-div2" style="padding-left: 400px;"><input type="submit" value="更新文章" id="dosubmit"/></div>
		</td>
        
      </tr>
    </table>
	</form>
	</td>
  </tr>
  
</table>
</body>
</html>
