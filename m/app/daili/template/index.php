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
			<p style=" font-weight:bold">[<?php echo empty($rt['userinfo']['mobile_phone']) ? '匿名' : $rt['userinfo']['mobile_phone'];?>]</p>
			<p style="font-size:10px; line-height:22px; margin-bottom:0px;"> 用户级别：<?php echo $rt['userinfo']['level_name'];?><br>
			  我的资金（元）：<?php echo empty($rt['userinfo']['zmoney']) ? '0.00' : $rt['userinfo']['zmoney'];?></p>
			 <p><?php echo $rt['userress']['provinces'].$rt['userress']['citys'].$rt['userress']['districts'].$rt['userress']['address'];?></p>
		  </li>
		  <li class="meCenterBoxAvatar"><a href="" data-ajax="false"><img src="<?php echo ADMIN_URL;?>images/noavatar_big.jpg"></a></li>
		  <li><img src="<?php echo ADMIN_URL;?>images/meCenterImg.jpg" width="100%"></li>
		</ul>
    </div>
	
	
  
  	<div data-role="content" class="ui-content" role="main"> 
    <!--个人中心菜单-->
    <div class="meMenu"> <a href="<?php echo ADMIN_URL.'daili.php?act=dailiset';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/web.png"><br>
        基本设置
      </center>
      </a> <a href="<?php echo ADMIN_URL.'daili.php?act=fromprice';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meShoppingForm.png"><br>
        代理价格
      </center>
      </a> <a href="<?php echo ADMIN_URL.'daili.php?act=myinfo';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meAccount.png"><br>
        资料修改
      </center>
      </a> <a href="<?php echo ADMIN_URL.'daili.php?act=saleorder';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/shop.png"><br>
        销售统计
      </center>
      </a> <a href="<?php echo ADMIN_URL.'daili.php?act=myorder';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meForm.png"><br>
        客户订单
      </center>
      </a> <a href="<?php echo ADMIN_URL.'daili.php?act=question';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meFeedback.png"><br>
        在线留言
      </center>
      </a> <a href="<?php echo ADMIN_URL.'daili.php?act=fenhong';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/turntable.png"><br>
        我的分红
      </center>
      </a> <a href="<?php echo ADMIN_URL.'daili.php?act=myshare';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/moAddress.png"><br>
        我的客户
      </center>
      </a> <a href="<?php echo ADMIN_URL.'daili.php?act=mymoney';?>" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meCoupon.png"><br>
        我的资金
      </center>
      </a> <a href="<?php echo ADMIN_URL;?>daili.php?act=mytuijian" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/app_wedding.png"><br>
         我的推荐
      </center>
      </a> <a href="<?php echo ADMIN_URL;?>daili.php?act=myvotes" class="meMenuBox" data-role="none" data-ajax="false">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/survey.png"><br>
         调研投票
      </center>
      </a> <a href="<?php echo ADMIN_URL;?>daili.php?act=logout" class="meMenuBox" data-role="none" data-ajax="false" onclick="return confirm('确定退出吗？');">
      <center>
        <img src="<?php echo ADMIN_URL;?>images/meAbout.png"><br>
         安全退出
      </center>
      </a> </div>
    <!--/个人中心菜单--> 
  </div>
  
</div>


