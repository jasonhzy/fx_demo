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
</style>
<div id="main" style="padding:5px; min-height:300px">
	 <table  width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height:28px;">
		<tr>
		<td align="left">商&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家:</td><td align="left"><?php echo $rt['nickname'];?></td>
	    </tr>
	   <tr>
		<td align="left">联&nbsp;系&nbsp;&nbsp;人:</td><td align="left"><?php echo $rt['user_name'];?></td>
	    </tr>
		<tr>
		<td align="left">联系电话:</td><td align="left"><?php echo $rt['mobile'];?></td>
	    </tr>
		<tr>
		<td align="left">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱:</td><td align="left"><?php echo $rt['email'];?></td>
	    </tr>
		<tr>
		<td align="left">桌&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;台:</td><td align="left"><?php echo $rt['tainame'];?></td>
	    </tr>
		<tr>
		<td align="left">联系地址:</td><td align="left"><?php echo $rt['address'];?></td>
	    </tr>
		<tr>
		<td align="left">就餐时间:</td><td align="left"><?php echo $rt['best_time'];?></td>
	    </tr>
		<tr>
		<td align="left">备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注:</td><td align="left"><?php echo $rt['content'];?></td>
	    </tr>
	</table>

</div>
