<div id="main" style="padding:5px; min-height:300px">
<table  width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:25px;">
<tr>
<td bgcolor="#DFE0DC">&nbsp;用户</td>
<td bgcolor="#DFE0DC">来源</td>
<td bgcolor="#DFE0DC">时间</td>
<td bgcolor="#DFE0DC">操作</td>
</tr>
<?php if(!empty($rt['lists'])){
foreach($rt['lists'] as $row){
?>
<tr>
<td><?php echo !empty($row['nickname']) ? $row['nickname'] : $row['user_name'];?></td>
<td><a href="<?php echo $row['url'];?>" target="_blank"><?php echo $row['url'];?></a></td>
<td><?php echo date('Y-m-d H:i:s',$row['addtime']);?></td>
<td><a href="<?php echo ADMIN_URL.'user.php?act=myshare&id='.$row['id'];?>" onclick="return confirm('确定删除吗')">删除</a></td>
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
