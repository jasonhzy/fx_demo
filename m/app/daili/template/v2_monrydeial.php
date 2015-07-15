<style type="text/css">
table td:hover{ background:#ededed;}
</style>
<div id="main" style="padding:5px; min-height:300px">
<p class="radiustibox"><span class="radiusti">我的资金：<font color="#FF0000">￥<?php echo empty($rt['zmoney']) ? '0.00' : $rt['zmoney'];?></font></span></p>
<table  width="100%" border="0" cellpadding="0" cellspacing="0">
<?php if(!empty($rt['lists']))foreach($rt['lists'] as $k=>$row){
?>
<tr>
	<td align="left">
		<?php echo !empty($row['time']) ? date('Y-m-d H:i:s',$row['time']) : '无知';?>
		&nbsp;<?php if($row['money']>0){ echo '<font color="#3333FF">收入:'.$row['money'].'</font>'; }else{ echo '<font color="#fe0000">支出:'.abs($row['money']).'</font>'; }?>
		<p style="line-height:22px; position:relative; margin-bottom:10px; border-bottom:1px solid #d5d5d5"><?php echo $row['changedesc'];echo !empty($row['nickname']) ? '&nbsp;&nbsp;用户:'.$row['nickname'] : '';?><a href="<?php echo ADMIN_URL.'daili.php?act=monrydeial&id='.$row['cid'];?>" onclick="return confirm('确定删除吗');" style="position:absolute; right:5px; bottom:7px; z-index:99"><img src="<?php echo $this->img('delete.png');?>" align="middle" style="cursor:pointer; height:20px" /></a></p>
	</td>
</tr>
<?php } ?>
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