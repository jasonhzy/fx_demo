<?php
$shareinfo = $lang['shareinfo'];
if(!empty($shareinfo)){
?>
<div style=" position:relative;height:44px; line-height:44px; background:url(<?php echo $this->img('gzbg.png');?>) repeat; position:fixed; top:0px; left:0px; width:100%; z-index:9999">
	<img src="<?php echo $shareinfo['headimgurl'];?>" height="40" style="margin:2px 8px 2px 10px; float:left" />
	<p style=" padding-top:2px; padding-bottom:2px; line-height:20px; color:#FFF; font-weight:bold">
	来自好友<font color="#00761d"><?php echo $shareinfo['nickname'];?></font>的推荐<br/>立即关注，将获得更多的折扣！
	</p>
	<a href="<?php echo ADMIN_URL.'art.php?id=7';?>" style=" position:absolute; right:10px; top:6px; z-index:99; cursor:pointer; height:35px;"><img src="<?php echo $this->img('guanzhu.png');?>" /></a>
</div>
<?php } ?>

<?php $ad = $this->action('banner','banner','首页轮播',5);?>
<!--顶栏焦点图--> 
<div class="flexslider" style="margin-bottom:0px;">
	 <ul class="slides">
	 <?php if(!empty($ad))foreach($ad as $row){
	 $a = basename($row['ad_img']);
	 ?>			 
		<!--<li><img src="<?php echo SITE_URL.str_replace($a,'thumb_b/'.$a,$row['ad_img']);?>" width="100%" alt="<?php echo $row['ad_name'];?>"/></li>-->
		<li><img src="<?php echo SITE_URL.$row['ad_img'];?>" width="100%" alt="<?php echo $row['ad_name'];?>"/></li>
	 <?php } ?>												
	  </ul>
</div>
<style type="text/css">
.menunav{
-webkit-box-shadow: 0 -.1rem #fff inset;
display: -webkit-box;
width:65%; float:right;
}
.menunav a{
display: block;
-webkit-box-flex: 1;
text-align: center;
width: 100%;
font-size: 12px;
color: #666;
position: relative;
}
.menunav a i{
display: block;
width: 100%;
height:43px;
clear: both;
}
.menunav a:nth-child(1) i {
background: url(<?php echo $this->img('m-act-cat.png');?>) no-repeat center;
background-size: auto 60%;
}
.menunav a:after {
content: '';
display: block;
height: 40%;
position: absolute;
right: 0;
top: 20%;
border-right: 1px solid #d7d7d7;
}
.menunav a:nth-child(2) i {
background: url(<?php echo $this->img('m-act-cart.png');?>) no-repeat center;
background-size: auto 60%;
}
.menunav a:nth-child(3) i {
background: url(<?php echo $this->img('m-act-wuliu.png');?>) no-repeat center;
background-size: auto 60%;
}
.menunav a:nth-child(4) i {
height: 28px; padding-top:15px;
background: url(<?php echo $this->img('uclicon.png');?>) no-repeat center 7px;
background-size: 28px auto;
}
</style>
<div id="main" style="padding:5px; padding-top:0px">
<div class="logoqu">
<?php if(!empty($lang['site_logo'])&&file_exists(SYS_PATH.$lang['site_logo'])){?>
	<img src="<?php echo  SITE_URL.$lang['site_logo'];?>" class="logos" style="max-height:100px; max-width:100px"/>
<?php } ?>
	<div class="menunav">
	<a href="<?php echo ADMIN_URL.'catalog.php';?>"><i></i>所有商品</a>
	<a href="<?php echo ADMIN_URL.'mycart.php';?>"><i></i>购物车</a>
	<a href="<?php echo ADMIN_URL.'user.php?act=orderlist';?>"><i></i>查物流</a>
	<a href="<?php echo ADMIN_URL.'art.php?id=6';?>"><i></i>新手指南</a>
	</div>
</div>
<!--<?php if(!empty($lang['shareinfo'])){?><p><a href="<?php echo ADMIN_URL.'art.php?id=7';?>"><img src="<?php echo $this->img('mmexport1415475496230.jpeg');?>" style="width:100%"/></a></p><?php } ?>-->
<?php if(!empty($rt['cat']))foreach($rt['cat'] as $row){?>
	<div class="indexitem">
		<p class="ptitle"><span><a href="<?php echo ADMIN_URL.'catalog.php?cid='.$row['cat_id'];?>">[<?php echo $row['cat_name'];?>]</a></span></p>
		<?php if(!empty($row['cat_img'])&&file_exists(SYS_PATH.$row['cat_img'])){?>
		<p><a href="<?php echo $row['cat_url'];?>"><img src="<?php echo SITE_URL.$row['cat_img'];?>" style="width:100%"/></a></p>
		<?php } ?>
		<ul class="goodslists">
		<?php if(!empty($rt['goods'][$row['cat_id']]))foreach($rt['goods'][$row['cat_id']] as $k=>$rows){?>
			<li style="width:50%; float:left;">
				<div style="padding:4px;">
				<a style="background:#fff; padding:5px; display:block;" href="<?php echo ADMIN_URL.($row['is_jifen']=='1'?'exchange':'product').'.php?id='.$rows['goods_id'];?>">
					<div style=" height:150px; overflow:hidden; text-align:center;">
						<img src="<?php echo SITE_URL.$rows['goods_img'];?>" style="max-width:99%;display:inline;" alt="<?php echo $rows['goods_name'];?>"/>
					</div>
					<p style="line-height:20px; height:20px; overflow:hidden; text-align:center"><?php echo $rows['goods_name'];?></p>
					<p style="line-height:26px; height:26px; overflow:hidden;"><b style=" margin-top:5px;line-height:22px;color:#FE0000; font-size:14px; float:left; margin-right:5px; padding-left:3px; padding-right:5px;">￥<?php echo str_replace('.00','',$rows['pifa_price']);?></b></p>
<!--					<p style="height:auto; overflow:hidden;"><img src="<?php echo $this->img('priceicon6.png');?>" style="float:left; max-width:40%" /><img src="<?php echo $this->img('buybut4.png');?>" style="float:right;max-width:50%" /></p>-->
				</a>
				</div>
			</li>
		<?php } ?>
		<div class="clear"></div>
		</ul>
	</div>
<?php } ?>
<?php if(!empty($rt['listsjf'])){?>
<!--积分兑换-->
	<div class="indexitem">
		<p class="ptitle" style="position:relative"><span><a href="<?php echo ADMIN_URL.'exchange.php';?>">[积分兑换]</a></span><a style=" position:absolute; right:0px; bottom:0px; z-index:99; color:#d92816; font-size:16px" href="<?php echo ADMIN_URL.'exchange.php';?>"><img src="<?php echo $this->img('more3.png');?>" align="absmiddle" /></a></p>
		<ul class="goodslists">
		<?php foreach($rt['listsjf'] as $k=>$row){?>
			<li style="width:50%; float:left;">
				<div style="padding:4px;">
				<a style="background:#fff; padding:5px; display:block;" href="<?php echo ADMIN_URL.'exchange.php?id='.$row['goods_id'];?>">
					<div style=" height:120px; overflow:hidden; text-align:center;">
						<img src="<?php echo SITE_URL.$row['goods_img'];?>" style="max-width:99%;display:inline;" alt="<?php echo $row['goods_name'];?>"/>
					</div>
					<p style="line-height:20px; height:20px; overflow:hidden; text-align:center"><?php echo $row['goods_name'];?></p>
					<p style="line-height:22px; height:22px; overflow:hidden; text-align:center; background:#ededed; border:1px solid #ccc;border-radius: 5px;"><b style="color:#FE0000; font-size:14px;">所需积分:<?php echo $row['need_jifen'];?></b></p>
				</a>
				</div>
			</li>
		<?php } ?>
		<div class="clear"></div>
		</ul>
	</div>
<?php } ?>	
</div>
<?php
 $thisurl = Import::basic()->thisurl();
 $rr = explode('?',$thisurl);
 $t2 = isset($rr[1])&&!empty($rr[1]) ? $rr[1] : "";
 $dd = array();
 if(!empty($t2)){
 	$rr2 = explode('&',$t2);
	if(!empty($rr2))foreach($rr2 as $v){
		$rr2 = explode('=',$v);
		if($rr2[0]=='from' || $rr2[0]=='isappinstalled'|| $rr2[0]=='code'|| $rr2[0]=='state') continue;
		$dd[] = $v;
	}
 }
 $thisurl = $rr[0].'?'.(!empty($dd) ? implode('&',$dd) : 'tid=0');
?>
<script type="text/javascript">
  function _report(a,c){
		$.post('<?php ADMIN_URL;?>product.php',{action:'ajax_share',type:a,msg:c,thisurl:'<?php echo Import::basic()->thisurl();?>',imgurl:'<?php echo $this->img('logo4.png');?>',title:'<?php echo $title;?>'},function(data){
		});
  }

  document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        window.shareData = {  
            "imgUrl": "<?php echo !empty($lang['site_logo'])? SITE_URL.$lang['site_logo'] : $this->img('logo4.png');?>",
            "LineLink": '<?php echo $thisurl;?>',
            "Title": "<?php echo $lang['metatitle'];?>",
            "Content": "<?php echo $lang['metadesc'];?>"
        };
        // 发送给好友
        WeixinJSBridge.on('menu:share:appmessage', function (argv) {
            WeixinJSBridge.invoke('sendAppMessage', { 
                "img_url": window.shareData.imgUrl,
                "img_width": "640",
                "img_height": "640",
                "link": window.shareData.LineLink,
                "desc": window.shareData.Content,
                "title": window.shareData.Title
            }, function (res) {
                _report('send_msg', res.err_msg);
            })
        });
        // 分享到朋友圈
        WeixinJSBridge.on('menu:share:timeline', function (argv) {
            WeixinJSBridge.invoke('shareTimeline', {
                "img_url": window.shareData.imgUrl,
                "img_width": "640",
                "img_height": "640",
                "link": window.shareData.LineLink,
                "desc": window.shareData.Content,
                "title": window.shareData.Title
            }, function (res) {
                _report('timeline', res.err_msg);
            });
        });
        // 分享到微博
        WeixinJSBridge.on('menu:share:weibo', function (argv) {
            WeixinJSBridge.invoke('shareWeibo', {
                "content": window.shareData.Content,
                "url": window.shareData.LineLink,
            }, function (res) {
                _report('weibo', res.err_msg);
            });
        });
        }, false)
</script>

<!--footer-->
<!--QUYU-->
<div id="opquyu">
	
</div>
<div id="opquyubox">
	<p><img src="<?php echo $this->img('homeMenuTop.png');?>" width="100%" /></p>
	<div style="line-height:26px;">
		<h2 style="border-bottom:1px solid #ededed;"><a href="<?php echo ADMIN_URL.'exchange.php';?>">积分兑换</a></h2>
	<?php if(!empty($lang['menu']))foreach($lang['menu'] as $row){?>
		<h2 style="border-bottom:1px solid #ededed;"><a href="<?php echo ADMIN_URL.'catalog.php?cid='.$row['id'];?>"><?php echo $row['name'];?></a></h2>
		<?php if(!empty($row['cat_id'])){?>
		<div style=" line-height:14px;">
			<?php foreach($row['cat_id'] as $rows){?>
			<a href="<?php echo ADMIN_URL.'catalog.php?cid='.$rows['id'];?>"><?php echo $rows['name'];?></a><a href="<?php echo ADMIN_URL.'catalog.php?cid='.$rows['id'];?>"><?php echo $rows['name'];?></a><a href="<?php echo ADMIN_URL.'catalog.php?cid='.$rows['id'];?>"><?php echo $rows['name'];?></a>
			<?php } ?>
		</div>
	<?php } } ?>
	</div>
	<div style=" height:45px;"></div>
</div>

<!--FOOTER-->
<?php if(!strpos($_SERVER['PHP_SELF'],'user.php') && !strpos($_SERVER['PHP_SELF'],'daili.php')){?>
<div style=" margin-top:30px; background:#6EABD4">
<table style="margin:0 auto" border="0" cellpadding="0" cellspacing="0" width="320"><tbody><tr><td><img src="<?php echo $this->img('1409405635468844.png');?>" alt="" title="" _src="<?php echo $this->img('1409405635468844.jpg');?>" style="width:320px; height:43px;" border="0" height="43" hspace="0" vspace="0" width="320"></td></tr></tbody></table>
<p style="text-align:center; padding-bottom:5px;">
	<a style="color:#FFF;" href="tel:<?php echo isset($lang['custome_phone'][0]) ? $lang['custome_phone'][0] : '';?>">免费热线：<font style="font-size:16px; color:#fff100"><?php echo implode('、',$lang['custome_phone']);?></font></a>
</p>
<p style="text-align:center; color:#fff; padding-bottom:10px;"><?php echo $lang['copyright'];?></p>
</div>
<?php } ?>
<style type="text/css">
body { margin-bottom:46px !important; }
a, button, input { -webkit-tap-highlight-color:rgba(255, 0, 0, 0); }
ul, li { list-style:none; margin:0; padding:0 }
.top_bar { position: fixed; z-index: 900; bottom: 0; left: 0; right: 0; margin: auto; font-family: Helvetica, Tahoma, Arial, Microsoft YaHei, sans-serif; }
.top_menu { display:-webkit-box; border-top: 1px solid #CDCBCD; display: block; width: 100%; background: rgba(255, 255, 255, 0.7); height: 45px; display: -webkit-box; display: box; margin:0; padding:0; -webkit-box-orient: horizontal; background: -webkit-gradient(linear, 0 0, 0 100%, from(#e7e4e7), to(#b9b9b9)); box-shadow: 0 1px 0 0 rgba(255, 255, 255, 0.9) inset; }
.top_bar .top_menu>li { -webkit-box-flex:1; background: -webkit-gradient(linear, 0 0, 0 100%, from(rgba(0, 0, 0, 0.1)), color-stop(50%, rgba(0, 0, 0, 0.2)), to(rgba(0, 0, 0, 0.2))), -webkit-gradient(linear, 0 0, 0 100%, from(rgba(255, 255, 255, 0.1)), color-stop(50%, rgba(255, 255, 255, 0.3)), to(rgba(255, 255, 255, 0.1))); -webkit-background-size: 1px 100%, 1px 100%; background-size: 1px 100%, 1px 100%; background-position: 1px center, 2px center; background-repeat: no-repeat; position:relative; text-align:center; width:33%; }
.top_bar .top_menu>li>a { line-height:45px; display:block; text-align:center; color:#4f4d4f; text-decoration:none; text-shadow: 0 1px rgba(255, 255, 255, 0.3); -webkit-box-flex:1; }
.top_menu>li:first-child { background:none; }
.top_bar .top_menu li a label { padding:0; font-size:14px; overflow:hidden; }
.top_bar .top_menu>li>a img { display: inline-block; height: 14px; width: 14px; margin-top:-2px; color: #fff; line-height: 40px; vertical-align:middle; }
.top_bar li:first-child a { display: block; }
.top_menu li:last-of-type a { background: none; }
.top_menu>li:last-of-type>a label { padding: 0 0 0 3px; }
.top_bar .top_menu>li>a:hover, .top_bar .top_menu>li>a:active { background-color:#CCCCCC; }
</style>
<?php
$nums = 0;
$thiscart = $this->Session->read('cart');
if(!empty($thiscart))foreach($thiscart as $row){
	$nums +=$row['number'];
}
?>
<div class="top_bar" style="-webkit-transform:translate3d(0,0,0)">
   <nav>
    <ul id="top_menu" class="top_menu">
    <li><a href="<?php echo ADMIN_URL;?>"><label>首页</label></a></li>
	<li><a href="javascript:void(0)" onclick="ajaxopquyu()"><label>分类</label></a></li>
	<li><a href="<?php echo ADMIN_URL.'user.php';?>"><label>会员</label></a></li>
	<li><a href="<?php echo ADMIN_URL;?>mycart.php"><label>购物车&nbsp;<span style="border-radius:50%;background:#B70000; text-align:center; font-size:12px; font-weight:bold; color:#FFF; cursor:pointer;z-index:99; padding:2px" class="mycarts"><?php echo $nums;?></span></label></a></li>    
	</ul>
  </nav>
</div>
<style type="text/css">
#collectBox{width:100px;height:40px;z-index:-2;position:fixed;bottom:0px;right:0px;background:none;}
</style>
<div id="collectBox"></div>