
<?php echo form_open('login/index',array('name'=>'loginform','id'=>'loginform','onsubmit'=>'return checkform(this);','method'=>'post'));?>

<table width="90%" border="0" style="margin:20px 0 0 20px;">
  <tr>
    <td width="24%">登录邮箱：</td>
    <td width="76%"><input type="text" name="username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : '';?>" style="width:150px; height:16px;"/> </td>
  </tr>
  <tr>
    <td>登录密码：</td>
    <td><input type="password" name="pwd" style="width:150px; height:16px;" /> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input name="auto" type="checkbox" value="" /><span>记住登录状态</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <table width="100%" border="0">
      <tr>
        <td>
		<input type="hidden" name="hash_code" value="<?php echo $hash_code;?>"/>
          <input type="submit" name="login" value="登录"/>
        </td>
        <td><a href="http://www.21xiehou.com/page/zhaohuimima/" target="_blank">忘记密码？</a></td>
      </tr>
    </table></td>
  </tr>
</table>  </form>
             
		<script>
            <!--
            function checkform(form)
            {
                username = form.username.value;
                if (username == "")
                {
                    alert("请输入用户名");
                    form.username.focus();
                    return false;
                }

                if (username.length<6)
                {
                    alert("用户名不得少于6位");
                    form.username.focus();
                    return false;
                }

                password = form.pwd.value;

                if (pwd == "")
                {
                    alert("请输入登录密码");
                    form.password.focus();
                    return false;
                }
            }
            -->
        </script>