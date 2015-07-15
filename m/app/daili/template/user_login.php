<style type="text/css">
.pw{
border: 1px solid #ddd;
border-radius: 5px;
background-color: #fff; padding-left:1%; padding-right:1%;
-moz-border-radius:5px;/*仅Firefox支持，实现圆角效果*/
-webkit-border-radius:5px;/*仅Safari,Chrome支持，实现圆角效果*/
-khtml-border-radius:5px;/*仅Safari,Chrome支持，实现圆角效果*/
border-radius:5px;/*仅Opera，Safari,Chrome支持，实现圆角效果*/
}
</style>
<div id="main" style="padding:10px; min-height:300px">
	<form id="LOGIN" name="LOGIN" method="post" action="">
			<table cellpadding="3" cellspacing="5" border="0" width="100%">
			<tr>
				<th width="100%" align="left">登录账号：</th>			
			</tr>
			<tr>
				<td width="100%" align="center"><input placeholder="手机号码" type="text" name="username" style="width:98%; height:30px; line-height:30px;" class="pw"/></td>
			</tr>
			<tr>
				<th align="left">用户密码：</th>
			</tr>
			<tr>
				<td width="100%" align="center"><input placeholder="用户密码" type="password" name="password" style="width:98%; height:30px; line-height:30px;" class="pw"/></td>
			</tr>
			
			<tr>
				<td align="center" width="100%">
				<input name="" value="登录" type="button" id="submit" tabindex="6" data-disabled="false" style=" padding:5px; background:#999; color:#fff;width:98%; line-height:25px; cursor:pointer; font-weight:bold; border:none;font-size:16px" class="pw" onclick="return submit_login_data()">
				</td>
			</tr>
			</table>   
			 </form>
		
</div>
