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
	
	$("#rname").formValidator({empty:false,onshow:"请输入角色名称",onfocus:"长度应该为2-12位之间",oncorrect:"正确"}).inputValidator({min:2,max:12,onerror:"长度应该为2-12位之间"});
	$("#rdesc").formValidator({empty:true,onshow:"选填项",onfocus:"请输入角色描述",oncorrect:"正确"}).inputValidator({min:0,max:50,onerror:"长度应该为0-50位之间"});
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
                <td width="94%" valign="bottom"><span class="STYLE1"> 编辑角色</span></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<?php echo form_open('admin/role_info/role_update',array('target'=>'rightFrame','name'=>'myform','id'=>'myform'));?>
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
	<input  type="hidden" name="role_id" value="<?php echo $role_id;?>"/>     
      <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">角色名称：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="text" value=<?php echo $info['rolename']?> id="rname" class="input-text" name="rname"></div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">角色描述：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><textarea value="" id="rdesc" class="input-text"  rows="3" style="margin:5px;width:200px;" name="rdesc"><?php echo $info['description']?></textarea></div>
		</td>
      </tr>
      <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">是否启用：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="checkbox" value="0" checked="checked" id="isenable" class="input-text" name="isenable"/></div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">操作权限：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<?php foreach($arroptions as $key=>$menu) {?>
		<div  class="input-div2" style="margin-bottom:5px;">
		  <fieldset>
		  <legend><?php echo $key;?></legend>
		  <?php foreach($menu as $li=>$item) {?>
		  <input name="option[]" id="<?php echo $key.$li;?>" type="checkbox" <?php
		  echo $item['a']==in_array($item['a'],$role_info) ? 'checked="checked"' : ''?>  style="margin-left:5px;" value="<?php echo $item['c'].'|'.$item['a']?>" /><label for="<?php echo $key.$li;?>" style="margin-right:10px;"><?php echo $item['name']?></label>
		  <?php }?> 
		  </fieldset>
		</div>
		<?php }?> 
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" colspan="2" class="STYLE6">
		<div class="input-div2"><input type="submit" value="保存角色" id="dosubmit"/></div>
		</td>
        
      </tr>
    </table>
	</form>
	</td>
  </tr>
  
</table>
</body>
</html>
