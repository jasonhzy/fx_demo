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
	<div class="usertitle">提交问题/建议</div>
    <form action="" method="post" name="MESSAGES" id="MESSAGES">
	   <div class="huifu">
			<div class="hf_r">
				<div  class="hf_r_m">
					<p>&nbsp;</p>
					<h3 >
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td align="left">
							<textarea name="comment_title" cols="45" rows="10" style="width:98%;height:70px; font-size:12px;border-radius: 5px;box-shadow: 1px 1px 3px #E5E5E5; border:1px solid #ccc"></textarea>
							<input type="hidden" name="goods_id" value="0"/>
							</td>
						  </tr>
						  </tr>
						</table>

					</h3>
				</div>
				<div  class="hf_r_b"></div>
			</div>
			<div class="clear"></div>
		</div>
		<p style="padding-top:20px;"> <input type="button" name="submitmes" id="button" value="" style="background:url(<?php echo ADMIN_URL;?>images/submit.gif);width:75px; height:24px; border:none; cursor:pointer" onclick="submit_message()"/></p>
		</form>
		<div class="clear10"></div>
		<?php if(!empty($rt['meslist'])){ ?>
		<div class="usertitle">问题列表</div>
		<table width="100%" border="0" cellpadding="3" cellspacing="5" style="line-height:26px">
		<?php 
			foreach($rt['meslist'] as $row){
		?>
		<tr>
		   <td align="center" valign="middle" style="border-bottom:1px dotted #ededed">
	    	&nbsp;<img src="<?php echo !empty($row['avatar']) ? SITE_URL.$row['avatar'] : SITE_URL.'theme/images/head.gif';?>" height="60" width="60"/>
		   </td>
			<td align="left" style="border-bottom:1px dotted #ededed">
				<p><b>发布时间：</b><font color="#FF0000"><?php echo !empty($row['addtime']) ? date('Y-m-d H:i:s',$row['addtime']):"";?></font></p>
				<div><b>发布内容：</b><?php echo $row['comment_title'];?></div>
				
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align="left">
			<div style="padding-left:50px;"><p><b>管理员回答:</b></p>
			<div><?php echo !empty($row['rp_content ']) ? $row['rp_content '] : "暂无回复！";?></div>
			</div>
			</td>
		</tr>
		<?php } ?>
		   <tr>
		   <td align="center" colspan="2">
		     <?php echo $rt['pages']['first'].'&nbsp;'.$rt['pages']['prev'].'&nbsp;'.$rt['pages']['next'].'&nbsp;'.$rt['pages']['last'];?>
		   </td>
		   </tr>
		   </table>
		  <?php } ?>

</div>
<script type="text/javascript">
function submit_message(){ 
	createwindow();
	var formObj      = document.forms['MESSAGES']; //表单
	var mesobj        = new Object();
	if(formObj){
		mesobj = getFromAttributes(formObj);
	}else{
		alert('不存在留言表单对象！');	
		return false;
	}
	
	$.ajax({
	   type: "POST",
	   url: SITE_URL+"user.php",
	   data: "action=feedback&message=" + $.toJSON(mesobj),
	   dataType: "json",
	   success: function(data){
	   		removewindow();
			if(data.error==0){
				/*if(typeof(data.message)!='undefined' && data.message !=""){
					$('.m_right #tab2').html(data.message);	
				}*/
				window.location.reload();
			}else{
				//JqueryDialog.Open('系统提醒你','<br />'+data.message,260,50);
				alert(data.message);
			}
	   } //end sucdess

	}); //end ajax
} // end function
		
</script>
