<style type="text/css">
.pw,.pwt{
height:26px; line-height:26px;
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
	 <form name="USERINFO" id="USERINFO" action="" method="post">
     <table width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:30px; padding:10px">
<!--			<tr>
				<td  align="left" width="100%" colspan="2">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="left">
						<img id="img_avatar" src="<?php echo !empty($rt['userinfo']['headimgurl']) ? $rt['userinfo']['headimgurl'] : (!empty($rt['userinfo']['avatar']) ? SITE_URL.$rt['userinfo']['avatar'] : $this->img('noavatar_big.jpg'));?>" alt="" style="border:2px solid #ccc; width:85px; height:85px;" />
						</td>
						<td align="left" valign="bottom">
						<input name="avatar" id="avatar" type="hidden" value="<?php echo isset($rt['userinfo']['avatar'])? $rt['userinfo']['avatar'] : "";?>"><iframe id="iframe_t" name="iframe_t" border="0" src="<?php echo ADMIN_URL;?>uploadajax/" scrolling="no" width="140" frameborder="0" height="36"></iframe>
				<p style="color:#FF0000; font-size:12px;">(上传大小不能超过500kb)</p>
						</td>
					</tr>
				</table>
				</td>
			</tr>-->
<tr>
	<td width="20%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 性别：</td>
    <td width="80%" align="left" style="padding-bottom:2px;">
      		<label><input name="sex" value="0" <?php echo !isset($rt['userinfo']['sex'])||$rt['userinfo']['sex']==0 ? 'checked="checked"' : "";?> type="radio">
			保密&nbsp;&nbsp;</label><label>
			<input name="sex" value="1" type="radio" <?php echo isset($rt['userinfo']['sex'])&&$rt['userinfo']['sex']==1 ? 'checked="checked"' : "";?>/>
			男&nbsp;&nbsp;</label><label>
			<input name="sex" value="2" type="radio" <?php echo isset($rt['userinfo']['sex'])&&$rt['userinfo']['sex']==2 ? 'checked="checked"' : "";?>/>
		女&nbsp;&nbsp; </label>
	  </td>
  </tr>

<!--<tr>
	<td width="20%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 生日： </td>
    <td width="80%" align="left" style="padding-bottom:2px;">
		<?php 
		list($yes,$mouth,$day) = isset($rt['userinfo']['birthday'])&&!empty($rt['userinfo']['birthday']) ? explode('-',$rt['userinfo']['birthday']) : array('0000','00','00');
		?>
		<select name="yes" class="pwt">
		<?php 
		$maxyes= date('Y');
		for($i=$maxyes;$i>=1955;$i--){
			echo '<option value="'.$i.'"'.($i==$yes ? 'selected="selected"' : "").'>'.$i.'</option>';
		}
		?>
		</select>
		<select name="mouth" class="pwt">
		<?php 
		for($i=12;$i>=1;$i--){
			$i = sprintf('%02d',$i);
			echo '<option value="'.$i.'"'.($i==$mouth ? 'selected="selected"' : "").'>'.$i.'</option>';
		}
		?>
		</select>
		<select name="day" class="pwt">
		<?php 
		for($i=31;$i>=1;$i--){
			$i = sprintf('%02d',$i);
			echo '<option value="'.$i.'"'.($i==$day ? 'selected="selected"' : "").'>'.$i.'</option>';
		}
		?>
		</select>
		 </td>
	</tr>
-->
<tr>
	<td width="20%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 昵称：</td>
    <td width="80%" align="left" style="padding-bottom:2px;">
    <input type="text" value="<?php echo isset($rt['userinfo']['nickname'])&&!empty($rt['userinfo']['nickname']) ? $rt['userinfo']['nickname'] : "";?>" name="nickname"  class="pw"/></td>
  </tr>
<tr>
	<td width="20%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 邮箱：</td>
    <td width="80%" align="left" style="padding-bottom:2px;">
    <input type="text" value="<?php echo isset($rt['userinfo']['email'])&&!empty($rt['userinfo']['email']) ? $rt['userinfo']['email'] : "";?>" name="email"  class="pw"/></td>
  </tr>

<tr>
	<td width="20%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 手机：</td>
    <td width="80%" align="left" style="padding-bottom:2px;">
    <input type="text" value="<?php echo isset($rt['userinfo']['mobile_phone'])&&!empty($rt['userinfo']['mobile_phone']) ? $rt['userinfo']['mobile_phone'] : "";?>" name="mobile_phone"  class="pw"/></td>
  </tr>

<!--<tr>
	<td width="20%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 电话：</td>
    <td width="80%" align="left" style="padding-bottom:2px;">
    <input type="text" value="<?php echo isset($rt['userinfo']['home_phone'])&&!empty($rt['userinfo']['home_phone']) ? $rt['userinfo']['home_phone'] : "";?>" name="home_phone"  class="pw"/></td>
  </tr>-->
<tr>
	<td width="20%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 姓名：</td>
    <td width="80%" align="left" style="padding-bottom:2px;">
    <input type="text" value="<?php echo isset($rt['userress']['consignee'])&&!empty($rt['userress']['consignee']) ? $rt['userress']['consignee'] : "";?>" name="consignee"  class="pw"/></td>
  </tr>

<tr>
	<td width="20%" align="right" style="height:20px; line-height:20px;"><b class="cr2">*</b> 区域：</td>
    <td width="80%" align="left" style="padding-bottom:2px;">
<select name="province" id="select_province" class="pwt" onchange="ger_ress_copy('2',this,'select_city')">
	<option value="0">选择省</option>
	<?php 
	if(!empty($rt['province'])){
	foreach($rt['province'] as $row){
	?>
	<option value="<?php echo $row['region_id'];?>" <?php echo $rt['userress']['province']==$row['region_id']? 'selected="selected"' :"";?>><?php echo $row['region_name'];?></option>	
	<?php } } ?>													
	</select>
	
	<select name="city" id="select_city" class="pwt" onchange="ger_ress_copy('3',this,'select_district')">
	<option value="0">选择城市</option>
	<?php
	if(!empty($rt['city'])){
	foreach($rt['city'] as $row){
	?>
	<option value="<?php echo $row['region_id'];?>" <?php echo $rt['userress']['city']==$row['region_id']? 'selected="selected"' :"";?>><?php echo $row['region_name'];?></option>	
	<?php } } ?>	
	</select>
	
	<select <?php echo !isset($rt['userress']['district'])? 'style="display: none;"':"";?> name="district" class="pwt" id="select_district">
	<option value="0">选择区</option>	
	<?php 
	if(!empty($rt['district'])){
	foreach($rt['district'] as $row){
	?>
	<option value="<?php echo $row['region_id'];?>" <?php echo $rt['userress']['district']==$row['region_id']? 'selected="selected"' :"";?>><?php echo $row['region_name'];?></option>	
	<?php } } ?>													
	</select>

    </td>
  </tr>

<tr>
	<td width="20%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 地址：</td>
    <td width="80%" align="left" style="padding-bottom:2px;">
    <input type="text" value="<?php echo isset($rt['userress']['address'])&&!empty($rt['userress']['address']) ? $rt['userress']['address'] : "";?>" name="address"  class="pw" /></td>
  </tr>
<!--<tr>
	<td width="20%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 邮编：</td>
    <td width="80%" align="left" style="padding-bottom:2px;">
    <input type="text" value="<?php echo isset($rt['userress']['zipcode'])&&!empty($rt['userress']['zipcode']) ? $rt['userress']['zipcode'] : "";?>" name="zipcode"  class="pw"/></td>
  </tr>-->
  <tr>
    <td align="center" style="padding-top:20px;" colspan="2"><input type="button" value=""  style="overflow:hidden; border:none; background:none;cursor:pointer; background:url(<?php echo SITE_URL;?>theme/images/btu2.gif) no-repeat 0 0 ; width:102px; height:25px;" onclick="update_user_info(1)" />
	</td>
  </tr>
   <tr>
    <td align="center" colspan="2">
	<span class="returnmes" style="color:#FF0000"></span>
	</td>
  </tr>
</table>
</form>
</div>
<script type="text/javascript">
function run(imgs){
	$('#USERINFO #img_avatar').attr('src','<?php echo SITE_URL;?>'+imgs);
	$('input[name="avatar"]').val(imgs);
}
function ger_ress_copy(type,obj,seobj){
	parent_id = $(obj).val();
	if(parent_id=="" || typeof(parent_id)=='undefined'){ return false; }
	$.post('<?php echo ADMIN_URL;?>user.php',{action:'get_ress',type:type,parent_id:parent_id},function(data){
		if(data!=""){
			$(obj).parent().find('#'+seobj).html(data);
			if(type==3){
				$(obj).parent().find('#'+seobj).show();
			}
			if(type==2){
				$(obj).parent().find('#select_district').hide();
				$(obj).parent().find('#select_district').html("");
			}
		}else{
			alert(data);
		}
	});
}

</script>
