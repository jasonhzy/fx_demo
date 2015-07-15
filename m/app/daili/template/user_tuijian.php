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
	<ul class="goodslists">
	<?php if(!empty($rt['categoodslist']))foreach($rt['categoodslist'] as $k=>$row){?>
		<li style="width:46%; float:left; margin:2%;">
			<a style="background:#fff; padding:5px; display:block;border:1px solid #ededed;border-radius:5px;" href="<?php echo ADMIN_URL.'product.php?id='.$row['goods_id'];?>">
				<div style=" height:150px; overflow:hidden; text-align:center;">
					<img src="<?php echo SITE_URL.$row['goods_img'];?>" style="max-width:99%;display:inline;" alt="<?php echo $row['goods_name'];?>"/>
				</div>
				<p style="line-height:20px; height:20px; overflow:hidden; text-align:center"><?php echo $row['goods_name'];?></p>
				<p style="line-height:22px; height:22px; overflow:hidden; text-align:center"><b style=" color:#FE0000; font-size:14px;">折扣价:￥<?php echo str_replace('.00','',$row['pifa_price']);?></b></p>
			</a>
		</li>
	<?php } ?>
	<div class="clear"></div>
	</ul>
	<div class="clear10"></div>
	<?php if(!empty($rt['pages'])){?>
	<div class="pages">
		<?php echo str_replace('上一页','<img src="'.ADMIN_URL.'images/prev.jpg" align="absmiddle" />',$rt['pages']['previ']);?>
		<?php 
		if(!empty($rt['pages']['list']))foreach($rt['pages']['list'] as $kk=>$v){
			?>
			<a href="<?php echo $v;?>" class="<?php echo $kk==$page?'ll this' : 'll';?>"><?php echo $kk;?></a>
			<?php
		}
		?>	
		<?php echo str_replace('下一页','<img src="'.ADMIN_URL.'images/next.jpg" align="absmiddle" />',$rt['pages']['next']);?>
	</div>
	<div class="clear"></div>
	<?php } ?>

</div>
