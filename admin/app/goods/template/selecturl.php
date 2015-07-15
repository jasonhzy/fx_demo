<style type="text/css">
.contentbox li{ width:25%; text-align:left; line-height:26px; float:left}
</style>
<div class="contentbox">
   <table cellspacing="1" cellpadding="5" width="100%">
	 <tr>
		<th align="left">点击选择</th>
	</tr>
	</table>
	<ul style="padding:0px 10px 0px 10px">
		<li><a href="javascript:;" onclick="seturl('<?php echo SITE_URL.'m/';?>')">商城首页</a></li>
		<li><a href="javascript:;" onclick="seturl('<?php echo SITE_URL.'m/user.php';?>')">会员中心</a></li>
		<li><a href="javascript:;" onclick="seturl('<?php echo SITE_URL.'m/user.php?act=dailicenter';?>')">我的分销</a></li>
		<li><a href="javascript:;" onclick="seturl('<?php echo SITE_URL.'m/user.php?act=myerweima';?>')">我的二维码</a></li>
		<?php foreach($artlist as $row){?>
		<li><a href="javascript:;" onclick="seturl('<?php echo !empty($row['art_url']) ? $row['art_url'] : SITE_URL.'m/art.php?id='.$row['article_id'];?>')"><?php echo $row['article_title'];?></a></li>
		<?php } ?>
		<div style="clear:both; border-bottom:2px solid #ccc; margin-bottom:10px"></div>
		
		<?php foreach($catelist as $row){?>
		<li><a href="javascript:;" onclick="seturl('<?php echo SITE_URL.'m/catalog.php?cid='.$row['cat_id'];?>')"><?php echo $row['cat_name'];?></a></li>
		<?php } ?>
		<div style="clear:both; border-bottom:2px solid #ccc; margin-bottom:10px"></div>
		<?php foreach($lists as $row){?>
		<li style="height:70px; width:50%;">
		<img src="<?php echo SITE_URL.$row['goods_thumb'];?>" width="60" height="60" style="float:left; padding:1px; border:1px solid #ededed; margin-right:4px;" />
		<a href="javascript:;" onclick="seturl('<?php echo SITE_URL.'m/product.php?id='.$row['goods_id'];?>')" ><?php echo $row['goods_name'];?></a>
		</li>
		<?php } ?>
		<div style="clear:both; border-bottom:2px solid #ccc; margin-bottom:10px"></div>
	</ul>
	
	<div style="clear:both"></div>
	<?php $this->element('page',array('pagelink'=>$pagelink));?>
</div>
<script type="text/javascript">
function seturl(url){
	window.parent.setrun(url);
	alert("已选择:"+url);
}
</script>
	