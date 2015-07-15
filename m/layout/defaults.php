<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" /><meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta name="format-detection" content="telephone=no"/>
<title><?php echo $this->title();?></title><?php echo $this->meta();?>
<?php echo $this->css(array('comman.css','style.css?v=14'));?>
<?php echo '<script> var SITE_URL="'.ADMIN_URL.'";</script>'."\n";?>
<?php echo $this->js(array('jquery.min.js'));?>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> 
</head>
<?php $ad = $this->action('banner','banner','首页广告',1);?>
<body style="background:url(<?php echo !empty($ad['ad_img']) ? SITE_URL.$ad['ad_img'] : '';?>) center top no-repeat #FFF; background-size:100% auto; position:relative">
<?php echo $this->content();?>
<script type="text/javascript">
function page_init(){
	var h=$(window).height();
	$('body').height(h);
}
$(document).ready(function(){
	page_init();
});
</script>
</body>
</html>
