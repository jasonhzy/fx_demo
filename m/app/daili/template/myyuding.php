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
	 <table  width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:25px;">
		<tr>
		<td width="45" bgcolor="#DFE0DC">&nbsp;序号</td>
		<td bgcolor="#DFE0DC">商   家</td>
		<td bgcolor="#DFE0DC">就餐时间</td>
		<td bgcolor="#DFE0DC">操   作</td>
	  </tr>
	  <?php
	   if(!empty($rt)){
	   foreach($rt as $k=>$row){
	   ++$k;
	  ?>
		<tr>
		<td>&nbsp;<?php echo 10*($page-1)+$k;?></td>
		<td><?php echo $row['nickname'];?></td>
		<td><?php echo $row['best_time'];?></td>
		<td><a style="color:#FF0000" onclick="return confirm('确定删除吗？')" href="<?php echo SITE_URL.'user.php?act=myyuding&id='.$row['mes_id'];?>">删除</a>&nbsp;&nbsp;<a style="color:#FF0000" href="<?php echo ADMIN_URL.'user.php?act=myyudingdetail&id='.$row['mes_id'];?>">详情</a></td>
	  </tr>
	  <?php } } ?>
	  <tr>
	  <td  colspan="4" style="text-align:left;" class="pagesmoney">
	  <div class="pages" style=""><?php echo $pagelink['first'].$pagelink['previ'].$pagelink['next'].$pagelink['Last'];?></div>
	  </td>
	  </tr>
	</table>

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

