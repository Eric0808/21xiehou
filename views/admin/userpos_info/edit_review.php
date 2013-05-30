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
	$("#treview").formValidator({empty:true,onshow:"请输入评价信息",onfocus:"长度应该为0-100位之间",oncorrect:"正确"}).inputValidator({min:0,max:100,onerror:"长度应该为0-100位之间"});
	$("#ureview").formValidator({empty:true,onshow:"请输入评价信息",onfocus:"长度应该为0-100位之间",oncorrect:"正确"}).inputValidator({min:0,max:100,onerror:"长度应该为0-100位之间"});
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
                <td width="94%" valign="bottom"><span class="STYLE1"> 更新推荐评价</span></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<?php echo form_open('admin/user_pos/update_review',array('target'=>'rightFrame','name'=>'myform','id'=>'myform'));?>
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
     <input type="hidden" value="<?php echo $id;?>" name="edit_id"/>
      <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">红娘评价：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2" >
		<textarea value="" id="treview" class="input-text" rows="4" style="margin:5px;width:300px;" name="treview"><?php echo $treview;?></textarea>
		
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">会员评价：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2">
		<textarea value="" id="ureview" class="input-text" rows="4" style="margin:5px;width:300px;" name="ureview"><?php echo $ureview;?></textarea>
		</div>
		</td>
      </tr>
	  
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" colspan="2" class="STYLE6">
		<div class="input-div2"><input type="submit" value="更新评价信息" id="dosubmit"/></div>
		</td>
      </tr>
    </table>
	</form>
	</td>
  </tr>
  
</table>
</body>
</html>
