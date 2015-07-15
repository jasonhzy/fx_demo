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
.pages{ margin-top:20px;}
.pages a{ background:#ededed; padding:2px 4px 2px 4px; border-bottom:2px solid #ccc; border-right:2px solid #ccc; margin-right:5px;}
</style>
<div id="main" style="padding:5px; min-height:300px">
	 <table  width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:25px;">
		<tr>
		<td bgcolor="#DFE0DC">&nbsp;下单时间</td>
		<td bgcolor="#DFE0DC">订单状态</td>
		<td bgcolor="#DFE0DC">操   作</td>
	  </tr>
	  <?php
	   if(!empty($rt['orderlist'])){
	   foreach($rt['orderlist'] as $k=>$row){
	   ++$k;
	  ?>
		<tr>
		<td style="border-bottom:1px dotted #ccc"><?php echo date('Y-m-d H:i:s',$row['add_time']);?></td>
		<td style="border-bottom:1px dotted #ccc"><?php echo $row['status'];?></td>
		<td style="border-bottom:1px dotted #ccc"><p style="line-height:18px;"><?php echo $row['op'];?><br/><a href="<?php echo ADMIN_URL;?>user.php?act=orderinfo&order_id=<?php echo $row['order_id'];?>">详情</a></p></td>
	  </tr>
	  <?php } } ?>
	  <tr>
	  <td  colspan="3" style="text-align:left;" class="pagesmoney">
	  <?php if(!empty($rt['orderpage'])){?>
	  <div class="pages" style=""><?php echo $rt['orderpage']['first'].$rt['orderpage']['previ'].$rt['orderpage']['next'].$rt['orderpage']['Last'];?></div>
	  <?php } ?>
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
