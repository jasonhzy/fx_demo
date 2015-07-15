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
<script type="text/javascript" src="<?php echo ADMIN_URL;?>js/edit/kindeditor.js"></script>
<form id="form1" name="form1" method="post" action="">
	 <table cellspacing="2" cellpadding="5" width="100%">
	<tr>
		<td class="label" width="10%">分类:</td>
		<td width="90%">
		<select name="cat_id" id="cat_id" class="pwt">
		<?php 
		if(!empty($catids)){
		 foreach($catids as $row){ 
		 if($row['id'] == 81){
		?>
		<option value="<?php echo $row['id'];?>"  <?php echo $row['id']==$rt['cat_id'] ? 'selected="selected"' : '';?>><?php echo $row['name'];?></option>
			<?php 
				if(!empty($row['cat_id'])){
				foreach($row['cat_id'] as $rows){ 
					?>
					<option value="<?php echo $rows['id'];?>"  <?php echo $rows['id']==$rt['cat_id'] ? 'selected="selected"' : '';?>>&nbsp;&nbsp;<?php echo $rows['name'];?></option>
					<?php 
					if(!empty($rows['cat_id'])){
					foreach($rows['cat_id'] as $rowss){ 
					?>
							<option value="<?php echo $rowss['id'];?>"  <?php echo $rowss['id']==$rt['cat_id'] ? 'selected="selected"' : '';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rowss['name'];?></option>
					<?php
					}//end foreach
					}//end if
				}//end foreach
				} // end if
				} //end 91
		 }//end foreach
		} ?>
		</select> 
		</td>
	  </tr>
	  <tr>
		<td class="label">标题:</td>
		<td><input style="width:350px; height:24px; line-height:24px; border:1px solid #ccc" name="article_title" id="article_title"  type="text" size="43" value="<?php echo isset($rt['article_title']) ? $rt['article_title'] : '';?>" class="pw"><span style="color:#FF0000">*</span><span class="article_title_mes"></span></td>
	  </tr>
	  <!--<tr>
			<td class="label">地区：</td>
			<td>
			<select name="province" id="select_province" onchange="ger_ress_copy('2',this,'select_city')" class="pwt">
			<option value="0">选择省</option>
			<?php 
			if(!empty($rt['ress']['province'])){
			foreach($rt['ress']['province'] as $row){
			?>
			<option value="<?php echo $row['region_id'];?>" <?php echo $rt['province']==$row['region_id']? 'selected="selected"' :"";?>><?php echo $row['region_name'];?></option>	
			<?php } } ?>													
			</select>
			
			<select name="city" id="select_city" onchange="ger_ress_copy('3',this,'select_district')" class="pwt">
			<option value="0">选择城市</option>
			<?php
			if(!empty($rt['ress']['city'])){
			foreach($rt['ress']['city'] as $row){
			?>
			<option value="<?php echo $row['region_id'];?>" <?php echo $rt['city']==$row['region_id']? 'selected="selected"' :"";?>><?php echo $row['region_name'];?></option>	
			<?php } } ?>	
			</select>
			
			<select <?php echo !isset($rt['ress']['district'])? 'style="display: none;"':"";?> name="district" id="select_district" class="pwt">
			<option value="0">选择区</option>	
			<?php 
			if(!empty($rt['ress']['district'])){
			foreach($rt['ress']['district'] as $row){
			?>
			<option value="<?php echo $row['region_id'];?>" <?php echo $rt['district']==$row['region_id']? 'selected="selected"' :"";?>><?php echo $row['region_name'];?></option>	
			<?php } } ?>													
			</select>
			 </td>
	  </tr>-->
	  <tr>
		<td class="label">图文:</td>
		<td>
		  <input name="article_img" id="articlephoto" type="hidden" value="<?php echo isset($rt['article_img']) ? $rt['article_img'] : '';?>" size="43" class="pw"/>
		  <br />
		  <iframe id="iframe_t" name="iframe_t" border="0" src="<?php echo SITE_URL; ?>upload.php?action=<?php echo isset($rt['article_img'])&&!empty($rt['article_img'])? 'show' : '';?>&ty=articlephoto&files=<?php echo isset($rt['article_img']) ? $rt['article_img'] : '';?>" scrolling="no" width="380" frameborder="0" height="25"></iframe>
		</td>
	  </tr>
	  <tr>
		<td class="label">状态:</td>
		<td><input id="is_show" name="is_show" value="1" type="checkbox" <?php echo !isset($rt['is_show']) || $rt['is_show']==1 ? 'checked="checked"' : '';?>>审核</td>
	  </tr>
	  <tr>
		<td class="label">内容:</td>
		<td><textarea name="content" id="content" style="width:97%;height:500px;display:none;" class="pw"><?php echo isset($rt['content']) ? $rt['content'] : '';?></textarea>
		<script>KE.show({id : 'content',cssPath : '<?php echo SITE_URL.'/css/edit.css';?>'});</script>
		</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>
		<input class="new_save" value="<?php echo $id>0 ? '修改' : '添加';?>保存" type="Submit" style="padding:3px; cursor:pointer">
		</td>
	  </tr>
	 </table>
	 </form>
</div>
<script type="text/javascript">
<!--
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
-->
</script>