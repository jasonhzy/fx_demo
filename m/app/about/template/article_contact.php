<div id="home">
	<div id="header">
		<div class="logo" style="height:28px; padding-top:12px; background:url(<?php echo $this->img('buts.png');?>) 10px 12px no-repeat"><span onclick=" history.go(-1);">返回</span></div>
		<div class="shoptitle"><span><?php echo $rt['info']['nickname'];?></span></div>
		<div class="logoright">
			<div>
			<?php
			$uid = $this->Session->read('User.uid');
			if(empty($uid )){
			?>
			<a href="<?php echo ADMIN_URL.'user.php?act=login';?>">登录</a><a href="<?php echo ADMIN_URL.'user.php?act=register';?>">注册</a>
			<?php } else {?>
			<a href="<?php echo ADMIN_URL.'user.php';?>">会员中心</a>
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="nav">
		<ul class="mall-cate">
<li class="quyuicn"><a href="<?php echo ADMIN_URL;?>">首页</a></li><li class="msicn"><a href="javascript:;" onclick="ajaxopquyu()">分类<em></em></a></li><li class="zxicn"><a href="<?php echo ADMIN_URL.'new.php';?>">资讯</a></li><li class="myuser"><a href="<?php echo ADMIN_URL.'user.php';?>">我</a></li>
		</ul>
	</div>
</div>		
<div id="main" style="padding:10px; min-height:300px">
	<?php echo $rt['article_con']['content'];?>
</div>
<!--FOOTER-->
<div style="height:40px; clear:both">&nbsp;</div>
<div id="footer" >
		<ul>
			<li><a class="abc" href="javascript:;" onclick="shfotnav(this)">美食推荐<em></em></a>
			<div class="fotnavbox">
			<div class="fotnav">
				<p><a href="<?php echo ADMIN_URL.'food.php';?>">美食</a></p>
				<p><a href="<?php echo ADMIN_URL.'shop.php';?>">靓店</a></p>
				<p><a href="<?php echo ADMIN_URL.'food.php?keyword=is_new';?>">活动</a></p>
				<p style="border:none"><a href="<?php echo ADMIN_URL.'food.php?keyword=is_promote';?>">推荐</a></p>
			</div>
			<i></i>
			</div>
			</li>
			<li><a class="abc" href="javascript:;" onclick="shfotnav(this)">优品商城<em></em></a>
			<div class="fotnavbox">
			<div class="fotnav">
				<p><a href="<?php echo ADMIN_URL.'catalog.php?keyword=is_best';?>">特色优品</a></p>
				<p><a href="<?php echo ADMIN_URL.'catalog.php?keyword=is_promote';?>">特惠优品</a></p>
				<p><a href="<?php echo ADMIN_URL.'catalog.php?keyword=is_new';?>">推荐优品</a></p>
				<p><a href="<?php echo ADMIN_URL.'catalog.php';?>">优品中心</a></p>
				<p style="border:none"><a href="<?php echo ADMIN_URL.'catalog.php?keyword=is_hot';?>">活动</a></p>
			</div>
			<i></i>
			</div>
			</li>
			<li><a class="abc" href="javascript:;" onclick="shfotnav(this)">我们服务<em></em></a>
			<div class="fotnavbox" style="left:auto; right:8px">
			<div class="fotnav">
				<p><a href="<?php echo ADMIN_URL.'contact.php';?>">服务热线</a></p>
				<p><a href="<?php echo ADMIN_URL.'about.php?id=196';?>">招商加盟</a></p>
				<p style="border:none"><a href="<?php echo ADMIN_URL.'contact.php';?>">关于我们</a></p>
			</div>
			<i></i>
			</div>
			</li>

		</ul>
</div>
<!--FOOTER-->
<script type="text/javascript">
		function shfotnav(obj){
			$(obj).parent().find('.fotnavbox').toggle();
		}
</script>
<!--QUYU-->
<div id="opquyu">
	
</div>
<div id="opquyubox">
	<p><img src="<?php echo $this->img('homeMenuTop.png');?>" width="100%" /></p>
	<div style="padding-left:10px; padding-right:5px; line-height:26px;">
	<p class="pp">地区</p>
	<a href="<?php echo ADMIN_URL.'shop.php';?>"><b>全部</b></a><?php if(!empty($rt['diqucate'])) foreach($rt['diqucate'] as $row){?><a href="<?php echo ADMIN_URL.'shop.php?cityid='.$row['region_id'];?>"><?php echo $row['region_name'];?></a><?php } ?>
	</div>
	<div style="padding-left:10px; padding-right:5px; line-height:26px;">
	<p class="pp">分类</p>
	<a href="<?php echo ADMIN_URL.'shop.php';?>"><b>全部</b></a><?php if(!empty($rt['shopcate'])) foreach($rt['shopcate'] as $row){?><a href="<?php echo ADMIN_URL.'shop.php?cid='.$row['cat_id'];?>"><?php echo $row['cat_name'];?></a><?php } ?>
	</div>
	<div style=" height:45px;"></div>
</div>

