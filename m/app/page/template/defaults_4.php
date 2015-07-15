<link type="text/css" rel="stylesheet" href="<?php echo ADMIN_URL;?>css/theme/style<?php echo $mubanid;?>.css?v=7" media="all" />
<?php $this->element('guanzhu',array('shareinfo'=>$lang['shareinfo']));?>
<style type="text/css">
.indexcon{ text-align:center}
.indexcon img{ max-width:100%;}
.footffont{ line-height:24px; position:relative}
.footffontbox{ position:absolute; left:0px; right:0px; top:0px; z-index:9; text-align:center; padding-top:60px; line-height:24px;}
.gototop{height:32px; line-height:32px; position:fixed; bottom:65px; left:0px; right:0px; padding-right:5px; padding-left:5px; display:block}
</style>
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

<div id="main">
	<div class="logoqu">
	<?php if(!empty($lang['site_logo'])&&file_exists(SYS_PATH.$lang['site_logo'])){?>
		<img src="<?php echo  SITE_URL.$lang['site_logo'];?>" class="logos" style="max-height:100px; max-width:100px"/>
	<?php } ?>
		<div class="menunav">
		<a href="<?php echo ADMIN_URL.'user.php?act=orderlist';?>"><i></i>查物流</a>
		<a href="<?php echo ADMIN_URL.'art.php?id=11';?>"><i></i>如何关注</a>
		<a href="<?php echo ADMIN_URL.'art.php?id=10';?>"><i></i>如何购买</a>
		<a class="r" href="<?php echo ADMIN_URL.'art.php?id=14';?>"><i></i>如何支付</a>
		</div>
	</div>
	<div class="indexcon">
			<?php
			echo $rt['tj']['goods_desc'];
			?>
	</div>	
</div>
<div class="footffont">
	<img src="<?php echo $this->img('bot2.jpg');?>" style=" width:100%;max-width:100%"/>
	<div class="footffontbox">
	<?php echo $lang['copyright'];?>
	</div>
</div>
<p class="gototop">
<?php //if(empty($lang['shareinfo'])){ ?>
		<input type="button" class="pushf" value="分享给朋友" style="cursor:pointer;" onclick="show_zhuan();">
<?php //} ?>
        <input type="button" id="cart" class="addcar" value="惊喜价购买" style="cursor:pointer;" onclick="return addToCart('<?php echo $rt['tj']['goods_id'];?>','jumpshopping')">
</p>

<div class="show_zhuan" style=" display:none;width:100%; height:100%; position:absolute; top:0px; right:0px; z-index:9999999;filter:alpha(opacity=90);-moz-opacity:0.9;opacity:0.9; background:url(<?php echo $this->img('gz/121.png');?>) right top no-repeat #000;background-size:100% auto;" onclick="$(this).hide();"></div>
<?php
 $thisurl1 = Import::basic()->thisurl();
 $rr = explode('?',$thisurl1);
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
function show_zhuan(){
	$('.show_zhuan').show();
	$('body,html').animate({scrollTop:0},500);
}


  function _report(a,c){
		$.post('<?php ADMIN_URL;?>product.php',{action:'ajax_share',type:a,msg:c,thisurl:'<?php echo Import::basic()->thisurl();?>',imgurl:'<?php echo !empty($lang['site_logo'])? SITE_URL.$lang['site_logo'] : $this->img('logo4.png');?>',title:'<?php echo $title;?>'},function(data){
		});
  }

<?php
$t = mktime();
$signature = sha1('jsapi_ticket='.$lang['jsapi_ticket'].'&noncestr='.$lang['nonceStr'].'&timestamp='.$t.'&url='.$thisurl1);
?>		
wx.config({
    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '<?php echo $lang['appid'];?>', // 必填，公众号的唯一标识
    timestamp: '<?php echo $t;?>', // 必填，生成签名的时间戳
    nonceStr: '<?php echo $lang['nonceStr'];?>', // 必填，生成签名的随机串
    signature: '<?php echo $signature;?>',// 必填，签名，见附录1
    jsApiList: ['onMenuShareAppMessage','onMenuShareTimeline','onMenuShareQQ'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});

wx.ready(function () {
	wx.onMenuShareAppMessage({
		title: '<?php echo $lang['metatitle'];?>', // 分享标题
		desc: '<?php echo $lang['metadesc'];?>', // 分享描述
		link: '<?php echo $thisurl;?>', // 分享链接
		imgUrl: '<?php echo !empty($lang['site_logo'])? SITE_URL.$lang['site_logo'] : $this->img('logo4.png');?>', // 分享图标
		success: function () { 
			// 用户确认分享后执行的回调函数
			_report('send_msg', 'st:ok');
		},
		cancel: function () { 
			// 用户取消分享后执行的回调函数
		}
	});
});

wx.onMenuShareTimeline({
      title: '<?php echo $lang['metatitle'];?>', // 分享标题
	  link: '<?php echo $thisurl;?>', // 分享链接
	  imgUrl: '<?php echo !empty($lang['site_logo'])? SITE_URL.$lang['site_logo'] : $this->img('logo4.png');?>', // 分享图标
      success: function () { 
			// 用户确认分享后执行的回调函数
			 _report('timeline', 'st:ok');
		},
		cancel: function () { 
			// 用户取消分享后执行的回调函数
		}
});
</script>