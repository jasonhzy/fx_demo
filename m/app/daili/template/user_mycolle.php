<div id="main" style="padding:5px; min-height:300px">
<table  width="100%" border="0" cellpadding="0" cellspacing="0">
<?php if(!empty($rt['lists'])){
foreach($rt['lists'] as $row){
?>
<tr>
<td style="border-bottom:1px solid #ededed; padding:5px 0px 5px 0px; margin-bottom:5px;" align="left">
<a href="<?php echo ADMIN_URL.'product.php?id='.$row['goods_id'];?>"><img src="<?php echo SITE_URL.$row['goods_thumb'];?>" width="60" style="padding:1px; border:1px solid #ccc; margin-left:5px; margin-right:5px; float:left"/></a>
<p style="line-height:20px;"><?php echo $row['goods_name'].'&nbsp;&nbsp;<font color=red>￥'.$row['pifa_price'].'</font>';?></p>
<p style="line-height:20px;"><?php echo date('Y-m-d H:i:s',$row['add_time']);?></p>
<p>
<img src="<?php echo ADMIN_URL;?>images/btubuys.gif" width="64" height="22" onclick="return addToCart('<?php echo $row['goods_id'];?>')" style="cursor:pointer"/>
<a href="javascript:void(0)" class="delcartid" id="<?php echo $k;?>"><img src="<?php echo ADMIN_URL;?>images/btudell.gif" width="64" height="22"/></a>
</p>
</td>
</tr>
<?php } } ?>
<tr>
<td style="text-align:left;" class="pagesmoney">
<div class="clear10"></div>
<style>
.pagesmoney a{ display:block; line-height:20px;margin-right:5px; color:#222; background-color:#ededed; border-bottom:2px solid #ccc; border-right:2px solid #ccc; text-decoration:none; float:left; padding-left:5px; padding-right:5px; text-align:center}
.pagesmoney a:hover{ text-decoration:underline}
</style>
<?php
if(!empty($rt['pages'])){
echo $rt['pages']['previ'];?>
<?php
 if(isset($rt['pages']['list'])&&!empty($rt['pages']['list'])){
 foreach($rt['pages']['list'] as $aa){
 echo $aa."\n";
 }
 }
?>
<?php echo $rt['pages']['next'];
}
?>
</td>
</tr>
</table>

</div>
<script type="text/javascript">
function delmycoll(ids,obj){
	thisobj = $(obj).parent().parent();
	if(confirm("确定删除吗？")){
		createwindow();
		$.post(SITE_URL+'user.php',{action:'delmycoll',ids:ids},function(data){
			removewindow();
			if(data == ""){
				thisobj.hide(300);
			}else{
				alert(data);	
			}
		});
	}else{
		return false;	
	}
}
</script>
