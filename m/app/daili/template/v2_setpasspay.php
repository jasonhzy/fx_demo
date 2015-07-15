<style type="text/css">
.pw,.pwt{
height:26px; line-height:normal;
border: 1px solid #ddd;
border-radius: 5px;
background-color: #fff; padding-left:5px; padding-right:5px;
-moz-border-radius:5px;/*仅Firefox支持，实现圆角效果*/
-webkit-border-radius:5px;/*仅Safari,Chrome支持，实现圆角效果*/
-khtml-border-radius:5px;/*仅Safari,Chrome支持，实现圆角效果*/
border-radius:5px;/*仅Opera，Safari,Chrome支持，实现圆角效果*/
}
.pw{ width:90%;}
.usertitle{
height:22px; line-height:22px;color:#666; font-weight:bold; font-size:14px; padding:5px;
border-radius: 5px;
background-color: #ededed; padding-left:5px; padding-right:5px;
-moz-border-radius:5px;/*仅Firefox支持，实现圆角效果*/
-webkit-border-radius:5px;/*仅Safari,Chrome支持，实现圆角效果*/
-khtml-border-radius:5px;/*仅Safari,Chrome支持，实现圆角效果*/
border-radius:5px;/*仅Opera，Safari,Chrome支持，实现圆角效果*/
}
</style>
<div id="main" style="padding:5px; min-height:300px">
	<div style="background:#f5f5f5; border:1px solid #d1d1d1;border-radius:5px; margin-top:10px; padding:10px;">
	<form name="USERINFO" id="USERINFO" action="" method="post">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:30px;">
		  <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 原密码：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<input type="password" value="" name="pass"  class="pw" placeholder="初始密码为空" /></td>
		  </tr>
		  <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 新密码：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<input type="password" value="" name="newpass"  class="pw"/></td>
		  </tr>
		  <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b>确认密码：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<input type="password" value="" name="rpnewpass"  class="pw"/></td>
		  </tr>
		  <tr>
			<td align="center" style="padding-top:10px;" colspan="2">
			<a href="javascript:;" onclick="update_user_passpay();" style="border-radius:5px;display:block;background:#E13934;cursor:pointer;width:140px; height:25px; line-height:25px; font-size:14px; color:#FFF">确认修改</a><span class="returnmes" style="padding-left:10px; color:#FF0000"></span>
			</td>
		  </tr>
		</table>
	</form>
	</div>
	
</div>
<script type="text/javascript">
function update_user_passpay(){
	passs = $('input[name="pass"]').val();
	newpasss = $('input[name="newpass"]').val();
	rpnewpasss = $('input[name="rpnewpass"]').val();
	if(newpasss=="" || newpasss==""){
		$('.returnmes').html('请输入完整信息');
		return false;
	}
	if(newpasss!=rpnewpasss){
		$('.returnmes').html('密码与确认密码不一致');
		return false;
	}
	if(confirm('确认修改吗')){
		createwindow();
		
		$.post('<?php echo ADMIN_URL;?>daili.php',{action:'update_user_passpay',pass:passs,newpass:newpasss,rpnewpass:rpnewpasss},function(data){ 
			$('.returnmes').html(data);
			removewindow();
		});
	}
	return false;
}
</script>
