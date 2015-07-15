 <style type="text/css" media="screen, projection">
	/* Not required for Tabs, just to make this demo look better... */
	body, h1, h2 {
		font-family: "Trebuchet MS", Trebuchet, Verdana, Helvetica, Arial, sans-serif; padding:0px; margin:0px;
	}
	h1 {
		margin: 1em 0 1.5em;
		font-size: 18px;
	}
	h2 {
		margin: 2em 0 1.5em;
		font-size: 16px;
	}
	p {
		margin: 0;
	}
	pre, pre+p, p+p {
		margin: 1em 0 0;
	}
	code {
		font-family: "Courier New", Courier, monospace;
	}
	.fragmentgoods li{ width:191px; height:290px; overflow:hidden; float:left; text-align:center; margin:2px; cursor:pointer}
	.fragmentgoods li:hover{border-color:#ddd;box-shadow:0 0 5px #ddd;overflow:visible;}
	.ui-tabs-panel{ padding-left:0px; padding-right:0px;}
	.clear{ clear:both;}
	.ui-tabs-nav{ height:32px; line-height:32px; text-align:left; border-bottom:2px solid #9a0000; margin:0px; padding:0px}
	.ui-tabs-nav li{ float:left; width:70px; height:32px; line-height:32px; text-align:center; }
	.ui-tabs-nav li a{  height:32px; line-height:32px;}
	.ui-tabs-nav li span{ margin:0px; padding:0px}
	.ui-tabs-selected a{ background-color:#9a0000;  }
	.ui-tabs-selected a span{color:#FFF}
	.subrelate{ padding:3px; margin-bottom:10px;}
	.subrelate a{ color:#333; margin:4px; text-decoration:none}
	.subrelate a:hover{ color:#D90000; text-decoration:underline}
	.pname,.price{ height:22px; line-height:22px; width:230px; margin:0px auto; text-align:center; overflow:hidden}
	.pname a{ color:#333; text-decoration:none}
	.pname a:hover{ color:#D9000; text-decoration:underline}
	.price del{ margin-right:3px;}
	.price b{ margin-left:3px;color:#D90000}
</style>
 <script type="text/javascript">
	$(function() {
		$('#rotate > ul').tabs({ fx: { opacity: 'toggle' } }).tabs('rotate', 5000);
	});
</script>
<div id="rotate" style="background-color:#FFF;">
	<ul class="ui-tabs">
	<?php if(!empty($rt['cats']))foreach($rt['cats'] as $k=>$row){?>
		<li><a href="#fragment-<?php echo ++$k;?>" id="<?php echo $k;?>" onclick="window.open('<?php echo $row['cat_url'];?>')"><span><?php echo $row['cat_name'];?></span></a></li>
		<?php } ?>
	</ul>
	
	<?php if(!empty($rt['cats']))foreach($rt['cats'] as $k=>$row){?>
	<div id="fragment-<?php echo ++$k;?>" class="fragmentgoods">
		<ul style="float:left; width:784px; overflow:hidden">
		<?php if(!empty($rt['cated'][$row['tcid']]))foreach($rt['cated'][$row['tcid']] as $kk=>$rows){
		$name = !empty($rows['gname']) ? $rows['gname'] : $rows['goods_name'];
		$url = !empty($rows['url']) ? $rows['url'] : SITE_URL.'product.php?id='.$rows['goods_id'];
		$img = !empty($rows['img']) ? SITE_URL.$rows['img'] : SITE_URL.$rows['goods_thumb'];
		?>
		 <li style="padding-top:10px; text-align:center;">
		  <p><a target="_blank" href="<?php echo $url;?>"><img title="<?php echo $name;?>" src="<?php echo $img;?>" alt="<?php echo $name;?>" onload="loadimg(this,191,260)" /></a></p>
		  <p class="pname"><a href="<?php echo $url;?>"><?php echo $name;?></a></p>
		  <p class="price"><del>￥<?php echo $rows['shop_price'];?></del><b>￥<?php echo $rows['pifa_price'];?></b></p>
		 </li>
		 <?php } ?>
		 <div class="clear"></div>
		</ul>
		<div style="width:225px; float:right; height:620px; border:1px solid #ccc;">
			<div style="width:225px; height:45px; background:url(<?php echo $this->img('mz-navbg.jpg');?>) center center no-repeat; font-size:14px; line-height:45px; text-align:center">相关分类</div>
			<div class="subrelate">
			<?php if(!empty($row['subcate']))foreach($row['subcate'] as $crow){ ?>
			<a target="_blank" href="<?php echo SITE_URL.'catalog.php?cid='.$crow['cat_id'];?>"><?php echo $crow['cat_name'];?></a>
			<?php } ?>
			</div>
			<?php if(!empty($row['cat_img'])){?><p><a href="<?php echo $row['cat_url'];?>" target="_blank"><img src="<?php echo SITE_URL.$row['cat_img'];?>" width="225" alt="<?php echo $row['cat_name'];?>" /></a></p><?php } ?>
			<?php if(!empty($row['cat_img2'])){?>
			<p><a href="<?php echo $row['cat_url'];?>" target="_blank"><img src="<?php echo SITE_URL.$row['cat_img2'];?>" width="225" alt="<?php echo $row['cat_name'];?>" /></a></p><?php } ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php } ?>
</div>
