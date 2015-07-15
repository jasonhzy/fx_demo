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
	<div style="background:#f5f5f5; border:1px solid #d1d1d1;border-radius:5px;margin-top:10px; padding:10px;">
    <p style="line-height:26px; font-size:14px; text-align:left; padding-left:10px;">以下为电脑版管理后台信息</p>
	<form name="USERINFO" id="USERINFO" action="" method="post">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:30px;">
		  <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 帐号：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<span style="font-size:14px; font-weight:bold"><?php echo $rt['mobile_phone'];?></span>
			</td>
		  </tr>
		  <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 原密码：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<input type="password" value="" name="pass"  class="pw" placeholder="初始密码为A123456" /></td>
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
			<a href="javascript:;" onclick="update_user_pass2();" style="border-radius:5px;display:block;background:#E13934;cursor:pointer;width:140px; height:25px; line-height:25px; font-size:14px; color:#FFF">确认修改</a><span class="returnmes" style="padding-left:10px; color:#FF0000"></span>
			</td>
		  </tr>
		</table>
	</form>
	
	<p style="line-height:26px; font-size:14px; text-align:left; padding-left:10px;">提款银行信息</p>
	<form name="USERINFO2" id="USERINFO2" action="" method="post">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:30px;">
<!--		  <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 密码：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<input type="password" value="" name="ppass"  class="pw"/></td>
		  </tr>-->
		   <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 开户行：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<input type="text" value="<?php echo isset($rts['bankname']) ? $rts['bankname'] : '';?>" name="bankname"  class="pw"/></td>
		  </tr>
		  <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 支付宝：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<input type="text" value="<?php echo isset($rts['bankaddress']) ? $rts['bankaddress'] : '';?>" name="bankaddress"  class="pw"/></td>
		  </tr>
		   <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 户名：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<input type="text" value="<?php echo isset($rts['uname']) ? $rts['uname'] : '';?>" name="uname"  class="pw"/></td>
		  </tr>
		   <tr>
			<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 卡号：</td>
			<td width="75%" align="left" style="padding-bottom:2px;">
			<input type="text" value="<?php echo isset($rts['banksn']) ? $rts['banksn'] : '';?>" name="banksn"  class="pw"/></td>
		  </tr>
		  <tr>
			<td align="center" style="padding-top:10px;" colspan="2">
			<a href="javascript:;" onclick="return update_user_bank();" style="border-radius:5px;display:block;background:#3083CE;cursor:pointer;width:140px; height:25px; line-height:25px; font-size:14px; color:#FFF">确认提交</a><a href="<?php echo ADMIN_URL.'daili.php?act=setpasspay';?>" style="border-radius:5px;display:block;background:#E13934;cursor:pointer;width:180px; height:25px; line-height:25px; font-size:14px; color:#FFF; margin-top:10px">设置或修改提款密码</a><span class="returnmes2" style="padding-left:10px; color:#FF0000"></span>
			</td>
		  </tr>
		</table>
	</form>
	</div>
	<div class="clear10"></div>
	<div style="border-radius:14px;border:1px solid #e5e5e5;padding:10px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:30px;">
		  <tr>
			<td width="30%" align="right" style="padding-bottom:2px;">开启代理申请：</td>
			<td width="70%" align="left" style="padding-bottom:2px;">
			  <label style="cursor:pointer">
			  <input <?php echo $rt['is_dailiapply']=='1' ? 'checked="checked"' : '';?> type="checkbox" name="checkbox" value="1" onclick="ajax_open_dailiapply(this.checked)" />选中开启
			  </label>			
			  </td>
		  </tr>
		  <tr>
			<td width="30%" align="right" style="padding-bottom:2px;">申请代理发货：</td>
			<td width="70%" align="left" style="padding-bottom:2px;">
			  <label>
			  <input type="button" onclick="alert('准备开放中');" name="Submit" value="点击提交申请" style="border-radius:5px;cursor:pointer; padding:2px 5px 2px 5px" />
			  </label>			
			  </td>
		  </tr>
		</table>
	</div>
</div>
<script type="text/javascript">
function update_user_bank(){
	//passs = $('input[name="ppass"]').val();
	banknames = $('input[name="bankname"]').val();
	bankaddresss = $('input[name="bankaddress"]').val();
	unames = $('input[name="uname"]').val();
	banksns = $('input[name="banksn"]').val();

	if( banknames=="" || unames=="" || banksns==""){
		$('.returnmes2').html('请输入完整信息');
		return false;
	}

	if(confirm('确认修改吗')){
		createwindow();
		
		$.post('<?php echo ADMIN_URL;?>daili.php',{action:'update_user_bank',bankname:banknames,bankaddress:bankaddresss,uname:unames,banksn:banksns},function(data){ 
			$('.returnmes2').html(data);
			removewindow();
		});
	}
	return false;
}

function update_user_pass2(){
	passs = $('input[name="pass"]').val();
	newpasss = $('input[name="newpass"]').val();
	rpnewpasss = $('input[name="rpnewpass"]').val();
	if(passs=="" || newpasss=="" || newpasss==""){
		$('.returnmes').html('请输入完整信息');
		return false;
	}
	if(newpasss!=rpnewpasss){
		$('.returnmes').html('密码与确认密码不一致');
		return false;
	}
	if(confirm('确认修改吗')){
		createwindow();
		
		$.post('<?php echo ADMIN_URL;?>daili.php',{action:'update_user_pass',pass:passs,newpass:newpasss,rpnewpass:rpnewpasss},function(data){ 
			$('.returnmes').html(data);
			removewindow();
		});
	}
	return false;
}
function ajax_open_dailiapply(tt){
	if(tt==true){
		ty = '1';
	}else{
		ty = '2';
	}
	$.post('<?php echo ADMIN_URL;?>daili.php',{action:'ajax_open_dailiapply',ty:ty},function(data){ 
		
	});
}
</script>
