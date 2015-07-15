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
	 <?php if(!empty($rt['userress'])){ ?>
	 <div class="usertitle">收货地址簿</div>
	 <?php
		foreach($rt['userress'] as $row){
		?>	
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style=" border-bottom:1px solid #EEEDE5;padding:10px; margin:0px; line-height:24px; background-color:#fafafa">
			  <tr>
				<td >收货人：<?php echo $row['consignee'];?>&nbsp;&nbsp;[性别：<?php echo $row['sex']=='1' ? '男' : ($row['sex']=='2' ? '女' : '保密')?>]</td>
			  </tr>
			  <tr>
				
				<td>收货地址：<?php echo $row['provinces'].$row['citys'].$row['districts'].$row['address'];?></td>
			  </tr>
			  <tr>
				
				<td>手机：<?php echo $row['mobile'];?></td>
			  </tr>
			  <tr>
			   
				<td>电话：<?php echo $row['tel'];?></td>
			  </tr>
			
			  <tr>
				
				<td>邮编：<?php echo $row['zipcode'];?></td>
			  </tr>
			 
			  <tr>
				<td>
			   <img src="<?php echo SITE_URL.'theme/images/btu_up.gif';?>" height="26" width="66" border="0" onclick="ressinfoop('<?php echo $row['address_id'];?>','showupdate',this)" style="cursor:pointer"/>&nbsp;
			   <img src="<?php echo SITE_URL.'theme/images/btu_dell.gif';?>" height="26" width="66" border="0" onclick="ressinfoop('<?php echo $row['address_id'];?>','delete',this)" style="cursor:pointer"/>&nbsp;
			   <?php if($row['is_default']=='1'){?>
			   <img class="set_quxiao_icon" src="<?php echo SITE_URL.'theme/images/quxiaodefaultress.png';?>" height="26" border="0" onclick="ressinfoop('<?php echo $row['address_id'];?>','quxiao',this)" style="cursor:pointer"/>&nbsp;
			   <?php }else{?>
			   <img class="set_quxiao_icon" src="<?php echo SITE_URL.'theme/images/setdefaultress.png';?>" height="26" border="0" onclick="ressinfoop('<?php echo $row['address_id'];?>','setdefaut',this)" style="cursor:pointer"/>&nbsp;
			   <?php } ?>
			  </td>
			  </tr>
  </table>
  <?php } }  ?>
  
  <div class="add">
  	<div class="usertitle">修改收货地址</div>
    <form action="" method="" name="CONSIGNEE_ADDRESS" id="CONSIGNEE_ADDRESS" >
	<table width="100%" border="0" style="line-height:24px;padding:10px;" cellpadding="0" cellspacing="0">
	  <tr>
		<td align="left"><b class="cr2">*</b> 姓名：</td>
		</tr>
		<tr>
		<td align="left"><input name="consignee" class="pw"  value="" type="text"></td>
	  </tr>
		<tr>
		<td align="left"><b class="cr2">*</b> 性别：</td>
	  </tr>
	  <tr>
		<td align="left"> 
		  <label><input type="radio" name="sex" value="0" checked="checked"/> 保密</label>
		  <label><input type="radio" name="sex" value="1" /> 男 &nbsp;</label>
		  <label><input type="radio" name="sex" value="2" /> 女&nbsp;</label>
		  </td>
	  </tr>
	  <tr>
		<td align="left"><b class="cr2">*</b> 地区：</td>
	  </tr>
	  <tr>
		<td align="left">  
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
		<td align="left"><b class="cr2">*</b> 地址：</td>
	  </tr>
	  <tr>
		<td align="left"><input name="address" class="pw" value="" type="text"/></td>
	  </tr>
	  <tr>
		<td align="left"><b class="cr2">*</b> 邮箱：</td>
	  </tr>
	  <tr>
		<td align="left"><input type="text" class="pw" name="email"/></td>
	  </tr>
	  <tr>
		<td align="left"><b class="cr2">*</b> 邮编：</td>
	   </tr>
	   <tr>
		<td align="left"><input type="text" class="pw" name="zipcode"/></td>
	  </tr>
	  
	  <tr>
		<td align="left">手机：</td>
		</tr>
		<tr>
		<td align="left"><input type="text" class="pw" name="mobile"/></td>
	  </tr>
	  <tr>
		<td align="left"><b class="cr2">*</b> 固定电话：</td>
	  </tr>
	  <tr>
		<td align="left"><input type="text" class="pw" name="tel"/></td>
	  </tr>
	  <tr>
		<td align="left" style="padding-top:10px;"><input type="button" value=""  style=" overflow:hidden ; border:none; background:none; cursor:pointer; background:url(<?php echo SITE_URL.'theme/images/add_btu.gif';?>) no-repeat 0 0 ; width:140px; height:26px;" onclick="ressinfoop('0','add','CONSIGNEE_ADDRESS')"/>
		</td>
	  </tr>
	</table>
</form>
 </div>
<script type="text/javascript">
function ger_ress_copy(type,obj,seobj){
	parent_id = $(obj).val();
	if(parent_id=="" || typeof(parent_id)=='undefined'){ return false; }
	$.post(SITE_URL+'user.php',{action:'get_ress',type:type,parent_id:parent_id},function(data){
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

</div>
