<div id="main" style="padding:5px; min-height:300px">
<p style="line-height:30px;">我的余额：<font color="#FF0000"><?php echo empty($rt['zmoney']) ? 0 : $rt['zmoney'];?>元</font></p>
<p style="height:32px; line-height:32px; padding-top:5px; padding-bottom:10px;">
        <input type="submit" id="cart" class="addcar" value="我要提款" style="cursor:pointer;" onclick="">
</p>
<p style="background:url(<?php echo $this->img('dian2.jpg');?>) left center no-repeat; line-height:24px; padding-left:10px;">账变记录</p>
<table  width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:24px;">
<tr>
<td bgcolor="#DFE0DC">&nbsp;序号</td>
<td bgcolor="#DFE0DC">时间</td>
<td bgcolor="#DFE0DC">类型</td>
<td bgcolor="#DFE0DC">收入</td>
<td bgcolor="#DFE0DC">支出</td>
<td bgcolor="#DFE0DC">账变原因</td>
<td bgcolor="#DFE0DC">操作</td>
</tr>
<?php if(!empty($rt['lists'])){
foreach($rt['lists'] as $k=>$row){
?>
<tr>
<td><?php echo 10*($rt['page']-1)+($k+1);?></td>
<td><?php echo !empty($row['time']) ? date('Y-m-d H:i:s',$row['time']) : '无知';?></td>
<td>消费</td>
<td><?php echo $row['money']>0 ? $row['money'].'元' : '--';?></td>
<td><?php echo $row['money']<=0 ? str_replace('-','',$row['money']).'元' : '--';?></td>
<td><?php echo $row['changedesc'];?></td>
<td><a href="javascript:;" onclick="return delmycoll(<?php echo $row['cid']; ?>,this)">删除</a></td>
</tr>
<?php } } ?>
<tr>
<td colspan="7" style="text-align:left;" class="pagesmoney">
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