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
	 <form name="USERINFO" id="USERINFO" action="" method="post">
     <table width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:30px; padding:10px">
	 <tr>
		<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b>姓名：</td>
		<td width="75%" align="left" style="padding-bottom:2px;">
		<input placeholder="" type="text" value="<?php echo isset($rt['userress']['consignee'])&&!empty($rt['userress']['consignee']) ? $rt['userress']['consignee'] : "";?>" name="consignee"  class="pw"/></td>
  	</tr>
	<tr>
	<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 手机：</td>
    <td width="75%" align="left" style="padding-bottom:2px;">
    <input placeholder=""  type="text" value="<?php echo isset($rt['userinfo']['mobile_phone'])&&!empty($rt['userinfo']['mobile_phone']) ? $rt['userinfo']['mobile_phone'] : "";?>" name="mobile_phone"  class="pw"/></td>
  	</tr>

	<tr>
	<td width="25%" align="right" style="padding-bottom:2px;"><b class="cr2">*</b> 内容：</td>
    <td width="75%" align="left" style="padding-bottom:2px;">
	<textarea name="textarea" class="pw" style="height:80px"/></textarea>
	</td>
  	</tr>
  <tr>
    <td align="center" style="padding-top:10px;" colspan="2">
	<a href="" style="border-radius:5px;display:block;background:#E13934;cursor:pointer;width:140px; height:25px; line-height:25px; font-size:14px; color:#FFF; margin-top:10px">提交预约</a>
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
