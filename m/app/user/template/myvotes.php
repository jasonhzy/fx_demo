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
<td bgcolor="#DFE0DC">&nbsp;图片</td>
<td bgcolor="#DFE0DC">产品</td>
<td bgcolor="#DFE0DC">时间</td>
<td bgcolor="#DFE0DC">操作</td>
</tr>
<?php if(!empty($rt['usercolllist'])){
foreach($rt['usercolllist'] as $row){
?>
<tr>
<td style="padding:5px; text-align:left"><img src="<?php echo SITE_URL.$row['avatar'];?>" width="60" style="padding:1px; border:1px solid #ccc"/></td>
<td><?php echo $row['nickname'];?></td>
<td><?php echo date('Y-m-d H:i:s',$row['add_time']);?></td>
<td><a href="javascript:;" onclick="return delmycoll(<?php echo $row['rec_id']; ?>,this)">删除</a> <a href="<?php echo ADMIN_URL.'sd.php?id='.$row['shop_id'];?>" target="_blank">查看详情</a></td>
</tr>
<?php } } ?>
<tr>
<td colspan="4" style="text-align:left;" class="pagesmoney">
<div class="clear10"></div>
<style>
.pagesmoney a{ display:block; line-height:20px;margin-right:5px; color:#222; background-color:#ededed; border-bottom:2px solid #ccc; border-right:2px solid #ccc; text-decoration:none; float:left; padding-left:5px; padding-right:5px; text-align:center}
.pagesmoney a:hover{ text-decoration:underline}
</style>
<?php
if(!empty($rt['usercollpage'])){
echo $rt['usercollpage']['previ'];?>
<?php
 if(isset($rt['usercollpage']['list'])&&!empty($rt['usercollpage']['list'])){
 foreach($rt['usercollpage']['list'] as $aa){
 echo $aa."\n";
 }
 }
?>
<?php echo $rt['usercollpage']['next'];
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
