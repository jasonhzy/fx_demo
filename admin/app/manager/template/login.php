<style type="text/css">
.main{ border:none; background:none}
.maincontent{ text-align:center; width:100%; margin-left:0px}
.loginbox{ text-align:center}
</style>
<div class="loginbox">
<div class="logintitle">&nbsp;</div>
<div class="logincontent">
	<table  align="center" width="370">
	<tr>
		<td colspan="2" style="height:20px;padding-left:50px;" align="center"><span class="error_msg" style="color:#FF0000; font-size:13px"></span>
		</td>
	</tr>
  	<tr>
	 <th width="70" align="right">用户名：</th><td align="left"> <input type="text" name="adminname" class="uname"  style="width:200px; height:25px;"/></td>
	</tr>
	<tr>
	 <th align="right">密码：</th><td align="left">  <input type="password" name="password" class="pass" style="width:200px;height:25px;"/></td>
	</tr>
	<tr>
	 <th align="right">验证码：</th><td align="left">  <input type="text" name="vifcode"  size="10" class="vifcode"  style="width:134px; height:25px;"/>&nbsp;&nbsp;<img  src="<?php echo ADMIN_URL;?>captcha.php" onclick="this.src='<?php echo ADMIN_URL;?>captcha.php?'+Math.random()" align="absmiddle"/></td>
	</tr>
	<tr>
	 <td colspan="2" align="left" style="padding-left:70px;">
	 <img src="<?php echo $this->img('login.gif');?>" alt="登录" class="login_button"/>
	 </td>
	</tr>
  </table>
</div>
</div>
<?php  $thisurl = ADMIN_URL.'login.php'; ?>
<script type="text/javascript">
$('.login_button').click(function(){
	submit_data();
});
	
//回车键提交
document.onkeypress=function(e)
{
	　　var code;
	　　if  (!e)
	　　{
	　　		var e=window.event;
	　　}
	　　if(e.keyCode)
	　　{
	　　		code=e.keyCode;
	　　}
	　　else if(e.which)
	　　{
	　　		code   =   e.which;
	　　}
	　　if(code==13) //回车键
	　　{
			submit_data();
	　　}
}

function submit_data(){
		name = $('.uname').val(); 
        pas = $('.pass').val();
		vifcodes = $('.vifcode').val();
		if(name == "" || pas == "" || vifcodes == "") return false;
		createwindow();
		$.post('<?php echo $thisurl;?>',{action:'login',adminname:name,password:pas,vifcode:vifcodes},function(data){ 
			removewindow();
			if(data != ""){
				$('.error_msg').html(data);
			}else{
			 	location.href='<?php echo ADMIN_URL;?>';
				return;
			}
		});
}	

</script>