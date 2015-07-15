<div class="indexbox">
	<div class="indexbox2">
		<div class="banner">
			<?php $ad = $this->action('banner','banner','首页轮播',5);?>
			<div id="zSlider">
				<div id="picshow">
					<div id="picshow_img">
						<ul>
						<?php if(!empty($ad))foreach($ad as $row){?>
						  <li><a href="<?php echo $row['ad_url'];?>" target="_blank"><img src="<?php echo SITE_URL.$row['ad_img'];?>"></a></li>
						<?php } ?>
						</ul>
					</div>
					
				</div>
				<div id="select_btn">
					<ul>
					  <?php if(!empty($ad))foreach($ad as $row){?>
						  <li><a href="<?php echo $row['ad_url'];?>" target="_blank"><img src="<?php echo SITE_URL.$row['ad_img'];?>"></a></li>
					  <?php } ?>
					</ul>
				</div>	
			</div>
			<!-- 代码 结束 -->
		</div>
		
		<div class="allgoods">
			<div class="allgoodsleft">
				 <iframe src="<?php echo SITE_URL;?>rollproducts.php" scrolling="no" frameborder="0" width="780" height="685"></iframe>
			</div>
		<?php $ad = $this->action('banner','banner','首页右侧广告',4);?>
			<div class="allgoodsright">
			<?php if(!empty($ad))foreach($ad as $row){?>
			<p style="padding-bottom:5px;"><a href="<?php echo $row['ad_url'];?>"><img src="<?php echo SITE_URL.$row['ad_img'];?>" alt="" style="max-height:100%; max-width:100%"></a></p>
			<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="gungoods">
			<div class="gungoodsbox">
			<?php $this->element("indexgundonggoods",array('gungoods'=>$rt['gungoods'])); ?>
			</div>
		</div>
	</div>
</div>	