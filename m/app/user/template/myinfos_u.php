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
<div id="main" style="padding:10px; min-height:300px">
	 <form name="USERINFO" id="USERINFO" action="" method="post">
     <table width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:30px; padding:10px; background:#f5f5f5; border:1px solid #d1d1d1;border-radius:5px;">
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
  <tr>
    <td align="center" style="padding-top:20px;" colspan="2">
	<a href="javascript:;" onclick="return update_user_info(1);" style="display:block;background:#e13935;cursor:pointer;width:110px; height:24px; line-height:24px; font-size:14px; color:#FFF; font-weight:bold; text-align:center;border-radius: 5px; overflow:hidden">确定修改</a>
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
