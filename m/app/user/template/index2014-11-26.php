<style type="text/css">
.pw{
border: 1px solid #ddd;
border-radius: 5px;
background-color: #fff; padding-left:5px; padding-right:5px;
-moz-border-radius:5px;/*仅Firefox支持，实现圆角效果*/
-webkit-border-radius:5px;/*仅Safari,Chrome支持，实现圆角效果*/
-khtml-border-radius:5px;/*仅Safari,Chrome支持，实现圆角效果*/
border-radius:5px;/*仅Opera，Safari,Chrome支持，实现圆角效果*/
}
.meCenterTitle {
background: #fff;
line-height: 24px;
height: 24px;
overflow: hidden;
padding: 2px;
color: #999;
padding-left: 10px;
}
.meCenterBox {
position: relative;
}
.meCenterBoxWriting {
position: absolute;
left: 36%;
top: 20%;
}
.meCenterBoxAvatar {
display: block;
position: absolute;
width: 18%;
left: 10%;
top: 20%;
}
.meCenterBoxEditor {
 position: absolute; 
right: 10px;
top: 10px;
}
.meCenterBoxWriting p {
margin-bottom: 8px;
line-height: 14px;
color: #fff;
}
.meCenterBoxWriting p {
margin-bottom: 8px;
line-height: 14px;
color: #fff;
}

.meCenterBoxAvatar a img {
display: block;
border: 6px solid #fff;
border-radius: 10px;
overflow: hidden;
width:100%;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL; ?>css/styles.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL; ?>css/jquery.mobile-1.3.2.min.css"/>
<div style="min-height:300px; padding-bottom:30px;">
	<div class="meCenter">
		<ul class="meCenterBox">
		  <li class="meCenterBoxWriting">
			<p>[<?php echo empty($rt['userinfo']['mobile_phone']) ? '匿名' : $rt['userinfo']['mobile_phone'];?>]</p>
			<p style="font-size:10px; line-height:22px;"> 会员级别：<?php echo $rt['userinfo']['level_name'];?><br>
			  已消费金额（元）：<?php echo empty($rt['userinfo']['spzmoney']) ? '0.00' : -$rt['userinfo']['spzmoney'];?></p>
		  </li>
		  <li class="meCenterBoxAvatar"><a href="" data-ajax="false"><img src="<?php echo ADMIN_URL;?>images/noavatar_big.jpg"></a></li>
		  <li><img src="<?php echo ADMIN_URL;?>images/meCenterImg.jpg" width="100%"></li>
		</ul>
    </div>
	
	<div data-role="navbar" class="ui-navbar ui-mini" role="navigation">
		<ul class="meTopNav ui-grid-b">
		  <li class="ui-block-a"><a href="#" data-theme="d" data-ajax="false" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-inline="true" class="ui-btn ui-btn-inline ui-btn-up-d"><span class="ui-btn-inner"><span class="ui-btn-text"><span class="meTopNavNumber"><?php echo empty($rt['userinfo']['points']) ? '0.00' : $rt['userinfo']['points'];?></span><br>
			我的积分</span></span></a></li>
		  <li class="ui-block-b"><a href="#" data-theme="d" data-ajax="false" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-inline="true" class="ui-btn ui-btn-up-d ui-btn-inline"><span class="ui-btn-inner"><span class="ui-btn-text"><span class="meTopNavNumber"><?php echo $rt['userinfo']['visit_count'];?></span><br>
			关注度</span></span></a></li>
		  <li class="ui-block-c"><a href="#" data-theme="d" data-ajax="false" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-inline="true" class="ui-btn ui-btn-up-d ui-btn-inline"><span class="ui-btn-inner"><span class="ui-btn-text"><span class="meTopNavNumber"><?php echo empty($rt['userinfo']['zmoney']) ? '0.00' : $rt['userinfo']['zmoney'];?></span><br>
			可用资金</span></span></a></li>
		</ul>
	 </div>
  
  	<div data-role="content" class="ui-content" role="main"> 
    <!--个人中心菜单-->
    <div class="meMenu"> <a href="<?php echo ADMIN_URL.'user.php?act=tuijian';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meLove.png"><br>
        优品推荐
      </center>
      </a> <a href="<?php echo ADMIN_URL.'mycart.php';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meShoppingForm.png"><br>
        购物单
      </center>
      </a> <a href="<?php echo ADMIN_URL.'user.php?act=myinfo';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meAccount.png"><br>
        资料修改
      </center>
      </a> <a href="<?php echo ADMIN_URL.'user.php?act=address_list';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/businesscard.png"><br>
        收货地址
      </center>
      </a> <a href="<?php echo ADMIN_URL.'user.php?act=myorder';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meForm.png"><br>
        订单管理
      </center>
      </a> <a href="<?php echo ADMIN_URL.'user.php?act=question';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meFeedback.png"><br>
        在线留言
      </center>
      </a> <a href="<?php echo ADMIN_URL.'user.php?act=mycoll';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/app_estate.png"><br>
        收藏管理
      </center>
      </a> <a href="<?php echo ADMIN_URL.'user.php?act=myshare';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/moAddress.png"><br>
        我的分享
      </center>
      </a> <a href="<?php echo ADMIN_URL;?>user.php?act=mypoints" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meAbout.png"><br>
         我的积分
      </center>
      </a> <a href="<?php echo ADMIN_URL.'user.php?act=mymoney';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meCoupon.png"><br>
        我的资金
      </center>
      </a> <a href="<?php echo ADMIN_URL;?>user.php?act=mysaidan" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/app_wedding.png"><br>
         我的晒单
      </center>
      </a> <a href="<?php echo ADMIN_URL;?>user.php?act=myvotes" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/survey.png"><br>
         调研投票
      </center>
      </a> </div>
    <!--/个人中心菜单--> 
  </div>
  
</div>


