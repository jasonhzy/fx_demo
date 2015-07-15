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
		
		<div class="gungoods">
			<ul class="gunnav">
				<li>特别推荐</li>
			</ul>
			<div class="gungoodsbox">
			<?php $this->element("indexgundonggoods",array('gungoods'=>$rt['gungoods'])); ?>
			</div>
		</div>
		
		<div class="indexbrand">
			<div class="indexbrandleft">
				<ul class="brandnav">
				<li>热门品牌</li>
				</ul>
				<div class="clear"></div>
				<ul class="lll">
				<?php if(!empty($rt['brandlist'])) foreach($rt['brandlist'] as $k=>$row){ ++$k; if($k>16)break;?>
				<li><a href="<?php echo SITE_URL.'brand.php?bid='.$row['brand_id'];?>" title="<?php echo $row['brand_name'];?>"><img src="<?php echo $row['brand_logo'];?>" width="120" height="62"/></a></li>
			<?php } ?>
				<div class="clear"></div>
				</ul>
			</div>
			<div class="indexbrandright">
				<ul class="indexnew">
					<h2>新闻资讯</h2>
					<?php if(!empty($rt['newlist']))foreach($rt['newlist'] as $row){?>
					<li><a target="_blank" href="<?php echo SITE_URL.'new.php?id='.$row['article_id'];?>"><?php echo $row['article_title'];?></a></li>
					<?php } ?>
					<div class="clear"></div>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="gungoods">
			<ul class="gunnav">
				<li>限时抢购</li>
			</ul>
			<div class="gungoodsbox">
				<ul class="qianggou">
				<?php if(!empty($rt['qianggou_goods']))foreach($rt['qianggou_goods'] as $k=>$row){?>
					<li>
						<div class="imbbox">
						<a href="<?php echo $row['url'];?>" target="_blank"><img title="<?php echo $row['goods_name'];?>" src="<?php echo $row['goods_thumb'];?>" alt="<?php echo $row['goods_name'];?>" width="200" onload="loadimg(this,200,200)"/></a>
						</div>
						<p class="pname"><a href="<?php echo $row['url'];?>" target="_blank"><?php echo $row['goods_name'];?></a></p>
						<p class="price"><del>￥<?php echo $row['price'];?></del><b>￥<?php echo $row['zprice'];?></b></p>
						<div class="titmes" id="lefttime_<?php echo $k;?>">--:--:--</div>
					</li>
				<?php } $k1 = $k; $k2 = $k; ?>
				<div class="clear"></div>	
				</ul>
			</div>
		</div>

		<div class="gungoods">
			<ul class="gunnav">
				<li>热门团购</li>
			</ul>
			<div class="gungoodsbox">
				<div class="gungoodsbox">
					<ul class="tuangou">
					<?php if(!empty($rt['grouplist']))foreach($rt['grouplist'] as $row){ ++$k1; ?>
						<li>
							<div class="imbbox">
							<a href="<?php echo SITE_URL.'groupbuy.php?gid='.$row['group_id'];?>" target="_blank"><img title="<?php echo $row['goods_name'];?>" src="<?php echo $row['goods_thumb'];?>" alt="<?php echo $row['goods_name'];?>" width="200" onload="loadimg(this,200,200)"/></a>
							</div>
							<p class="pname"><a href="<?php echo SITE_URL.'groupbuy.php?gid='.$row['group_id'];?>" target="_blank"><?php echo $row['group_name'];?></a></p>
							<p class="price"><b>￥<?php echo $row['price'];?></b><del>￥<?php echo $row['shop_price'];?></del></p>
							<div class="offdis"><?php echo sprintf('%.1f',($row['price']/$row['shop_price'])*10);?>折</div>
							<div class="titmes" id="lefttime_<?php echo $k1;?>">--:--:--</div>
						</li>
					<?php } ?>
					<div class="clear"></div>	
					</ul>
				</div>
			</div>
		</div>
		
<script language=JavaScript>
window.load = givetime();
var endtimes=new Array();//结束时间
<?php if(!empty($rt['qianggou_goods']))foreach($rt['qianggou_goods'] as $k=>$row){?>
endtimes[<?php echo $k;?>]="<?php echo date('m/d/Y H:i:s',$row['promote_end_date']);?>";
<?php } ?>

<?php if(!empty($rt['grouplist']))foreach($rt['grouplist'] as $k=>$row){ ++$k2; ?>
endtimes[<?php echo $k2;?>]="<?php echo date('m/d/Y H:i:s',$row['end_time']);?>";
<?php } ?>

var nowtimes;
function givetime(){
	nowtimes=new Date("<?php echo date('m/d/Y H:i:s',mktime());?>");//当前服务器时间
	window.setTimeout("DownCount()",1000)
}
function DownCount(){
	nowtimes=Number(nowtimes)+1000;
	for(var i=0;i<<?php echo (count($rt['qianggou_goods'])+count($rt['grouplist']));?>;i++)
	{
		var theDay=new Date(endtimes[i]);
		theDay=theDay++;
		if(theDay<=nowtimes)
		{
			document.getElementById("lefttime_"+i).innerHTML = "促销结束";
		}
		else{
				timechange(theDay,i);
			
		}
	}
	window.setTimeout("DownCount()",1000)
}
function timechange(theDay,i){
	var theDays=new Date(theDay);
	var seconds = (theDays - nowtimes)/1000;
	var minutes = Math.floor(seconds/60);
	var hours = Math.floor(minutes/60);
	var days = Math.floor(hours/24);
	var CDay= days;
	var CHour= hours % 24;
	var CMinute= minutes % 60;
	var CSecond= seconds % 60;
	var CHour=CHour+CDay*24;
	if(CMinute<10)
	{
		CMinute="0"+CMinute;
	}
	if(CHour<10)
	{
		CHour="0"+CHour;
	}
	if(CSecond<10)
	{
		CSecond="0"+CSecond;
	}
	document.getElementById("lefttime_"+i).innerHTML = '倒计时 '+CHour + ":" + CMinute + ":" + CSecond;
}
</script>

		<div class="indexcategoods">
			<iframe src="<?php echo SITE_URL;?>rollproducts.php" scrolling="no" frameborder="0" width="1020" height="680"></iframe >
		</div>
		
	</div>
</div>	