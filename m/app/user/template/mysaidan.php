<div id="main" style="padding:5px; min-height:300px">
<p style="line-height:30px;"><a href="<?php echo ADMIN_URL.'user.php?act=mysaidaninfo'?>" style="display:block; float:right; width:81px; height:28px; text-align:center; background:url(<?php echo $this->img('buts2.png');?>) center center no-repeat; color:#FFF;">我要晒单</a></p>
<table  width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:24px;">
<tr>
<td bgcolor="#DFE0DC">&nbsp;序号</td>
<td bgcolor="#DFE0DC">分类</td>
<td bgcolor="#DFE0DC">标题</td>
<td bgcolor="#DFE0DC">图片</td>
<td bgcolor="#DFE0DC">时间</td>
<td bgcolor="#DFE0DC">操作</td>
</tr>
<?php if(!empty($rt['lists'])){
foreach($rt['lists'] as $k=>$row){
?>
<tr>
<td><?php echo 10*($rt['page']-1)+($k+1);?></td>
<td><?php echo $row['cat_name'];?></td>
<td><?php echo $row['article_title'];?></td>
<td style="padding-bottom:5px; padding-top:5px"><img src="<?php echo SITE_URL.$row['article_img'];?>" width="80" /></td>
<td><?php echo !empty($row['addtime']) ? date('Y-m-d H:i:s',$row['addtime']) : "无知";?></td>
<td>
<a href="<?php echo ADMIN_URL;?>user.php?act=mysaidaninfo&id=<?php echo $row['article_id'];?>" title="编辑"><img src="<?php echo $this->img('icon_edit.gif');?>" title="编辑"/></a>&nbsp;
<a href="<?php echo ADMIN_URL;?>user.php?act=mysaidan&id=<?php echo $row['article_id'];?>" title="删除"><img src="<?php echo $this->img('icon_drop.gif');?>" title="删除" alt="删除" onclick="return confirm('确定删除吗？')" /></a>
</td>
</tr>
<?php } } ?>
<tr>
<td colspan="6" style="text-align:left;" class="pagesmoney">
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