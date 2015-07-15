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
.pages{ margin-top:20px;}
.pages a{ background:#ededed; padding:2px 4px 2px 4px; border-bottom:2px solid #ccc; border-right:2px solid #ccc; margin-right:5px;}
#main table td:hover{ background:#fafafa}
#main table td p a{ line-height:18px;display:block; padding:1px 5px 1px 5px; float:left; background:#FFF; border-bottom:2px solid #d5d5d5;border-right:2px solid #d5d5d5;border-radius:10px; margin-right:5px;}
</style>
<div id="main" style="min-height:300px">
	<table  width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:25px; padding-left:5px; padding-right:5px;">
	  <?php
	   if(!empty($rt['lists'])){
	   foreach($rt['lists'] as $k=>$row){
	   ++$k;
	  ?>
		<tr>
		<td>
		<p style="font-weight:bold; color:#666"><?php echo $row['order_sn'].'&nbsp;&nbsp;'.date('Y-m-d H:i:s',$row['add_time']);?></p>
		<p>
		<?php foreach($row['gimg'] as $img){?>
		<img src="<?php echo SITE_URL.$img;?>" height="70" style="padding:1px; border:1px solid #d5d5d5; margin-right:5px;" />
		<?php } ?>
		</p>
		<p style="height:32px; line-height:32px;"><span style="float:left"><?php echo $row['status'];?></span><a style="float:right" href="<?php echo ADMIN_URL;?>daili.php?act=kehuorderinfo&order_id=<?php echo $row['order_id'];?>">详情</a></p>
		<p style="border-top:1px dotted #ccc; margin-top:5px; padding-bottom:10px;"></p>
		</td>
	  </tr>
	  <?php } 
	  } ?>
	  <tr>
	  <td style="text-align:left;" class="pagesmoney">
	  <?php if(!empty($rt['pages'])){?>
	  <div class="pages"><?php echo $rt['pages']['first'].$rt['pages']['previ'].$rt['pages']['next'].$rt['pages']['Last'];?></div>
	  <?php } ?>
	  </td>
	  </tr>
	</table>
</div>
