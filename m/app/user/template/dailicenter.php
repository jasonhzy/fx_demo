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
.dailicenter{ margin:5px;border-radius:5px; border:1px solid #dcd9d8; overflow:hidden}
.dailicenter li{ height:40px; line-height:40px; background:#f8f8f8; border-bottom:1px solid #dcd9d8; text-align:left}
.dailicenter li a{ padding-right:10%;font-size:14px; display:block; background:url(<?php echo $this->img('404-2.png');?>) 90% center no-repeat;}
.dailicenter li a:hover{ background:url(<?php echo $this->img('404-2.png');?>) 90% center no-repeat #6EAAD3}
.dailicenter li i{ background-size:80%;list-style:decimal; width:20px; height:40px; float:left; margin-left:7%; margin-right:10px;}
.dailicenter li.li0 i{ background:url(<?php echo $this->img('icon/gg.png');?>) 10% center no-repeat #f8f8f8}
.dailicenter li.li1 i{ background:url(<?php echo $this->img('icon/li3.png');?>) 10% center no-repeat #f8f8f8}
.dailicenter li.li2 i{ background:url(<?php echo $this->img('icon/key.png');?>) 10% center no-repeat #f8f8f8}
.dailicenter li.li3 i{ background:url(<?php echo $this->img('icon/li8.png');?>) 10% center no-repeat #f8f8f8}
.dailicenter li.li4 i{ background:url(<?php echo $this->img('icon/hb.png');?>) 10% center no-repeat #f8f8f8}
.dailicenter li.li5 i{ background:url(<?php echo $this->img('icon/77.png');?>) 10% center no-repeat #f8f8f8}
.dailicenter li.li6 i{ background:url(<?php echo $this->img('icon/dd.png');?>) 10% center no-repeat #f8f8f8}
.dailicenter li.li7 i{ background:url(<?php echo $this->img('icon/dp.png');?>) 10% center no-repeat #f8f8f8}

.dailicenter li.li0 a:hover i{ background:url(<?php echo $this->img('icon/gg.png');?>) 10% center no-repeat #6EAAD3}
.dailicenter li.li1 a:hover i{ background:url(<?php echo $this->img('icon/li3.png');?>) 10% center no-repeat #6EAAD3}
.dailicenter li.li2 a:hover i{ background:url(<?php echo $this->img('icon/key.png');?>) 10% center no-repeat #6EAAD3}
.dailicenter li.li3 a:hover i{ background:url(<?php echo $this->img('icon/li8.png');?>) 10% center no-repeat #6EAAD3}
.dailicenter li.li4 a:hover i{ background:url(<?php echo $this->img('icon/hb.png');?>) 10% center no-repeat #6EAAD3}
.dailicenter li.li5 a:hover i{ background:url(<?php echo $this->img('icon/77.png');?>) 10% center no-repeat #6EAAD3}
.dailicenter li.li6 a:hover i{ background:url(<?php echo $this->img('icon/dd.png');?>) 10% center no-repeat #6EAAD3}
.dailicenter li.li7 a:hover i{ background:url(<?php echo $this->img('icon/dp.png');?>) 10% center no-repeat #6EAAD3}
</style>
<div id="main" style="padding:5px; min-height:300px">
	<ul class="dailicenter">
		<li class="li0">
			<a href="<?php echo ADMIN_URL.'daili.php?act=gonggao';?>"><i></i>代理公告</a>
		</li>
		<li class="li1">
			<a href="<?php echo ADMIN_URL.'daili.php?act=moneyrank';?>"><i></i>佣&nbsp;金&nbsp;榜</a>
		</li>
		<li class="li5">
			<a href="<?php echo ADMIN_URL.'daili.php?act=myusertype';?>"><i></i>我的客户</a>
		</li>
		<li class="li6">
			<a href="<?php echo ADMIN_URL.'daili.php?act=mydata';?>"><i></i>我的推广</a>
		</li>
		<li class="li3">
			<a href="<?php echo ADMIN_URL.'daili.php?act=v2_mymoney';?>"><i></i>我的佣金</a>
		</li>
		
<!--		<li class="li6">
			<a href="<?php echo ADMIN_URL.'daili.php?act=kehuorder';?>">客户订单</a>
		</li>
		<li class="li2">
			<a href="<?php echo ADMIN_URL.'daili.php?act=setpass';?>">修改资料</a>
		</li>-->
		
		<li class="li4" style="border-bottom:none">
			<a href="<?php echo ADMIN_URL.'daili.php?act=postmoney';?>"><i></i>申请提款</a>
		</li>
<!--		<li class="li5">
			<a href="<?php echo ADMIN_URL.'daili.php?act=fahuo';?>">申请发货</a>
		</li>-->
		
	</ul>
</div>
