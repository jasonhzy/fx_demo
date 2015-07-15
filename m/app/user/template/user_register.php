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
</style>
<div id="main" style="padding:10px; min-height:300px">
	<form id="REGISTER1" name="REGISTER1" method="post" action="">
			<table cellpadding="3" cellspacing="5" border="0" width="100%">
			<tr>
				<th width="100%" align="left">登录账号：</th>			
			</tr>
			<tr>
				<td width="100%" align="center"><input type="text" name="username" style="width:100%; height:30px; line-height:30px;" class="pw"/></td>
			</tr>
			<tr>
				<th width="100%" align="left">性<span style="padding-left:24px;">别</span>：</th>
			</tr>
			<tr>
			  <td width="100%" align="center">
				    <label>
				    <input type="radio" name="sex" value="1" checked="checked" style="background:url(<?php echo SITE_URL;?>theme/images/select.png); height:16px; width:16px; cursor:pointer" />男
				    </label>&nbsp;&nbsp;&nbsp;				
					 <label>
				    <input type="radio" name="sex" value="2" style="width:16px; height:16px; cursor:pointer" />女
				    </label>
					</td>
			</tr>
			<tr>
				<th align="left">用户密码：</th>
			</tr>
			<tr>
				<td width="100%" align="center"><input type="password" name="password" style="width:100%; height:30px; line-height:30px;" class="pw"/></td>
			</tr>
			<tr>
				<th align="left">确认密码：</th>
			</tr>
			<tr>
				<td width="100%" align="center"><input type="password" name="rp_pass" style="width:100%; height:30px; line-height:30px;" class="pw"/></td>
			</tr>
			<tr>
				<th align="left">手机号码：</th>
			</tr>
			<tr>
				<td width="100%" align="center"><input type="text" name="mobile_phone" style="width:100%; height:30px; line-height:30px;" class="pw"/></td>
			</tr>
			<tr>
				<th width="100%" align="left">生<span style="padding-left:24px;">日</span>：</th>
			</tr>
			<tr>
			  		<td width="100%" align="center">
					 <label>
				      <select name="yyy" style="width:31%; height:30px; line-height:30px;" class="pw">
					  <?php for($i=2010;$i>1960;$i--){?>
					  <option value="<?php echo $i;?>"><?php echo $i;?></option>
					  <?php } ?>
			          </select>
				      </label>
				      <label>
				      <select name="mmm" style="width:31%; height:30px; line-height:30px;" class="pw">
					   <?php for($i=12;$i>0;$i--){?>
					  <option value="<?php echo $i<10 ? '0'.$i : $i;?>"><?php echo $i<10 ? '0'.$i : $i;?></option>
					  <?php } ?>
			          </select>
				      </label>
					 
					  <label>
				      <select name="ddd" style="width:31%; height:30px; line-height:30px;" class="pw">
					   <?php for($i=31;$i>0;$i--){?>
					  <option value="<?php echo $i<10 ? '0'.$i : $i;?>"><?php echo $i<10 ? '0'.$i : $i;?></option>
					  <?php } ?>
			          </select>
				      </label>				
					  </td>
			</tr>
			<tr>
				<td align="center" width="100%">
				<input name="" value="同意协议并注册" type="button" id="submit" tabindex="6" data-disabled="false" style=" padding:5px; background:#FEC627; color:#fff;width:100%; line-height:25px; cursor:pointer; font-weight:bold; border:none" class="pw" onclick="return submit_register_data('REGISTER1');" />
				</td>
			</tr>
			</table>   
			 </form>
		
</div>
