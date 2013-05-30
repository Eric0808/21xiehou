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
	$("#uname").formValidator({empty:false,onshow:"请输入用户名",onfocus:"长度应该为3-12个字符之间",oncorrect:"用户名可用"}).inputValidator({min:3,max:12,onerror:"长度应该为3-12个字符之间"}).ajaxValidator({
	    type : "get",
		url : "<?php echo site_url('admin/admin_info/ajaxck_uname')?>",
		data :"",
		datatype : "html",
		async:'false',
		success : function(data){	
            if( data == "1" )
			{
                return true;
			}
            else
			{
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "用户名已存在，请选择其他用户名",
		onwait : "请稍候..."
	});
	$("#password").formValidator({empty:false,onshow:"请输入登录密码",onfocus:"密码应该为6-20位之间",oncorrect:"正确"}).inputValidator({min:6,max:20,onerror:"密码应该为6-20位之间"});
	$("#pwdconfirm").formValidator({empty:false,onshow:"请再次输入登录密码",onfocus:"请再次输入登录密码",oncorrect:"密码输入一致"}).compareValidator({desid:"password",operateor:"=",onerror:"输入两次密码不同。"});
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
                <td width="94%" valign="bottom"><span class="STYLE1"> 添加管理员</span></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<?php echo form_open('admin/admin_info/add_admin',array('target'=>'rightFrame','name'=>'myform','id'=>'myform'));?>
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
     
      <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">登录用户名：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="text" value="" id="uname" class="input-text" name="uname"></div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">真实姓名：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="text" value="" id="truename" class="input-text" name="truename"></div>
		</td>
      </tr>
      <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">登录密码：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="password" value="" id="password" class="input-text" name="password"></div>
		</td>
      </tr>
       <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">确认密码：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2"><input type="password" value="" id="pwdconfirm" class="input-text" name="pwdconfirm"></div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" class="STYLE6">
		<div class="input-div1"><span class="STYLE19">角色：</span></div>
		</td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">
		<div  class="input-div2">
		   <select id="role" class="input-text" name="role">
		   <option value="-1" selected="selected">请选择角色</option>
		   <?php foreach($roleList as $role){?>
			<?php if($role['disabled']==0){?>
			 <option value="<?php echo $role['roleid']?>"><?php echo $role['rolename']?></option>
		    <?php }?>
		   <?php }?>
		   </select>
		</div>
		</td>
      </tr>
	  <tr>
        <td height="30" width="10%" bgcolor="#FFFFFF" colspan="2" class="STYLE6">
		<div class="input-div2"><input type="submit" value="添加管理员" id="dosubmit"/></div>
		</td>
        
      </tr>
    </table>
	</form>
	</td>
  </tr>
  
</table>
</body>
</html>
