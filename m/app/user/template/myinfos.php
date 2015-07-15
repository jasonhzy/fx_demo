<style type="text/css">
#main li:hover{ background:#ededed}
.dailicenter{ margin:5px;}
.dailicenter li{ position:relative; height:40px; line-height:40px;margin-bottom:7px; border:1px solid #ccc;border-radius:5px; text-align:center;background:#ededed}
.dailicenter li a{ font-size:14px; display:block;padding-right:10%;  /*background:url(<?php echo $this->img('404-2.png');?>) 92% center no-repeat*/}
.dailicenter li a i{background-size:80%;list-style:decimal; width:20px; height:40px; float:left; margin-left:7%;background:url(<?php echo $this->img('pot.png');?>) 10% center no-repeat}
.dailicenter li a:hover{ background:#cfccbd}
.dailicenter li a span{border-radius:10px; height:24px; line-height:24px; padding-left:15px; padding-right:15px;display:block;background:#497bae; text-align:center; font-size:12px; font-weight:bold; color:#B70000; cursor:pointer; position:absolute;right:12%; top:8px; z-index:99;}
</style>
<div id="main" style="min-height:300px;margin-bottom:20px;">
	<ul class="dailicenter">
		<li>
		<a href="<?php echo ADMIN_URL.'user.php?act=myinfos_u';?>"><i></i>我的注册资料</a>
		</li>
		<li>
		<a href="<?php echo ADMIN_URL.'user.php?act=myinfos_s';?>"><i></i>我的收货资料</a>
		</li>
		<li>
		<a href="<?php echo ADMIN_URL.'user.php?act=myinfos_b';?>"><i></i>银行卡号资料</a>
		</li>
	</ul>
</div>