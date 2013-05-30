<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_CSS_PATH; ?>table_form.css" charset="UTF-8"/>
<script type="text/javascript" src="<?php echo STATIC_JS_PATH; ?>jquery.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo STATIC_JS_PATH; ?>formvalidator.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo STATIC_JS_PATH; ?>formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#upos_name").formValidator({empty:false,onshow:"请输入推荐位名称",onfocus:"长度应该为2-20位之间",oncorrect:"正确"}).inputValidator({min:2,max:20,onerror:"长度应该为2-20位之间"});
  })
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
                <td width="94%" valign="bottom"><span class="STYLE1"> 添加会员、顾问推荐位</span></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<?php echo form_open('admin/user_pos/add_pos',array('target'=>'rightFrame','name'=>'myform','id'=>'myform'));?>
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
     
      <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">推荐位名称：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2" ><input type="text" value="" id="upos_name" class="input-text" style="width:300px;" name="upos_name"></div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">类型：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2">
		<select id="cate" class="input-text" name="cate" disabled='true'>
		<?php if($_GET['type']==='0'){?>
		<option value='0' selected="selected">会员推荐</option>
		<?php }else{?>
		<option value='1' selected="selected">邂逅顾问推荐</option>
		<?php }?>
		</select>
		</div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">排序：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="text" value="" id="upos_order" class="input-text" name="upos_order"></div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" colspan="2" class="STYLE6">
		<div class="input-div2"><input type="submit" value="添加推荐位" id="dosubmit"/></div>
		</td>
      </tr>
    </table>
	</form>
	</td>
  </tr>
  
</table>
</body>
</html>
