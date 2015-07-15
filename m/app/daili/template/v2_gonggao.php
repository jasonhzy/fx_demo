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
.dailicenter li{ height:50px; line-height:50px; background:#f8f8f8; border-bottom:1px solid #dcd9d8;text-align:left}
.dailicenter li a{ font-size:14px;padding-left:5%; display:block; background:url(<?php echo $this->img('404-2.png');?>) 90% center no-repeat}
.dailicenter li a:hover{ background:#cfccbd}
</style>
<div id="main" style="min-height:300px">
	<ul class="dailicenter">
	<?php if(!empty($rt))foreach($rt as $row){?>
		<li>
			<a href="<?php echo ADMIN_URL.'daili.php?act=gonggaoinfo&id='.$row['article_id'];?>">
			<p style="height:22px; line-height:22px; padding-top:3px; overflow:hidden"><?php echo $row['article_title'];?></p>
			<p style="height:22px; line-height:22px; padding-bottom:3px; overflow:hidden; color:#CCCCCC"><?php echo date('Y-m-d',$row['addtime']);?></p>
			</a>
		</li>
	<?php } ?>
	</ul>
</div>
<script type="text/javascript">
function update_user_pass(){

}
</script>
