<style type="text/css">
.gototype a{ padding:2px; border-bottom:2px solid #ccc; border-right:2px solid #ccc;}
</style>
<div class="contentbox">
<form id="form1" name="form1" method="post" action="">
     <table cellspacing="2" cellpadding="5" width="100%">
		<tr>
			<td class="label" width="15%">消费积分：</td>
			<td>
			消费1元获得<input name="pointnum" value="<?php echo isset($rt['pointnum']) ? $rt['pointnum'] : '0';?>" size="10" type="text" />积分
			</td>
		</tr>
		<tr>
			<td class="label">推荐积分：</td>
			<td>
			 推荐一个用户所得<input name="tuijiannum" value="<?php echo isset($rt['tuijiannum']) ? $rt['tuijiannum'] : '0';?>" size="10" type="text" />积分
			  </td>
		</tr>
		<tr>
			<td class="label">数量享折扣：</td>
			<td>
			   二件享<input name="address2off" value="<?php echo isset($rt['address2off']) ? $rt['address2off'] : '100';?>" size="10" type="text" />%。【相对关注后的价格再折扣】<br/><br/>
			   三件享<input name="address3off" value="<?php echo isset($rt['address3off']) ? $rt['address3off'] : '100';?>" size="10" type="text" />%。【相对关注后的价格再折扣再相对2个数量的价格再折扣】<br/>
			  </td>
		</tr>
		<tr>
			<td class="label">关注享折扣：</td>
			<td>
			 关注后享<input name="guanzhuoff" value="<?php echo isset($rt['guanzhuoff']) ? $rt['guanzhuoff'] : '100';?>" size="6" type="text" />%。【相对当前的销售价格，即PC端购买享受不到该折扣】
			  </td>
		</tr>
		<tr>
			<td colspan="2">
			<hr/>
			</td>
		</tr>
		<tr>
			<td class="label" width="15%">全职底薪：</td>
			<td>
			<input name="dixin360" value="<?php echo isset($rt['dixin360']) ? $rt['dixin360'] : '0';?>" size="10" type="text" />元
			</td>
		</tr>
		<tr>
			<td class="label">全职提成点：</td>
			<td>
			 一层分佣<input name="ticheng360_1" value="<?php echo isset($rt['ticheng360_1']) ? $rt['ticheng360_1'] : '0';?>" size="10" type="text" />%<br/>
			 二层分佣<input name="ticheng360_2" value="<?php echo isset($rt['ticheng360_2']) ? $rt['ticheng360_2'] : '0';?>" size="10" type="text" />%<br/>
			 三层分佣<input name="ticheng360_3" value="<?php echo isset($rt['ticheng360_3']) ? $rt['ticheng360_3'] : '0';?>" size="10" type="text" />%<br/>
			  </td>
		</tr>
		<tr>
			<td class="label">普通分销提成点：</td>
			<td>
			 一层分佣<input name="ticheng180_1" value="<?php echo isset($rt['ticheng180_1']) ? $rt['ticheng180_1'] : '0';?>" size="10" type="text" />%<br/>
			 二层分佣<input name="ticheng180_2" value="<?php echo isset($rt['ticheng180_2']) ? $rt['ticheng180_2'] : '0';?>" size="10" type="text" />%<br/>
			 三层分佣<input name="ticheng180_3" value="<?php echo isset($rt['ticheng180_3']) ? $rt['ticheng180_3'] : '0';?>" size="10" type="text" />%<br/>
			  </td>
		</tr>
		<tr>
			<td class="label">高级分销提成点：</td>
			<td>
			 一层分佣<input name="ticheng180_h1_1" value="<?php echo isset($rt['ticheng180_h1_1']) ? $rt['ticheng180_h1_1'] : '0';?>" size="10" type="text" />%<br/>
			 二层分佣<input name="ticheng180_h1_2" value="<?php echo isset($rt['ticheng180_h1_2']) ? $rt['ticheng180_h1_2'] : '0';?>" size="10" type="text" />%<br/>
			 三层分佣<input name="ticheng180_h1_3" value="<?php echo isset($rt['ticheng180_h1_3']) ? $rt['ticheng180_h1_3'] : '0';?>" size="10" type="text" />%<br/>
			  </td>
		</tr>
		<tr>
			<td class="label">高级特权分销：</td>
			<td>
			 当销售额达<input name="minsalenum" value="<?php echo isset($rt['minsalenum']) ? $rt['minsalenum'] : '0.00';?>" size="6" type="text" />元，享受以下三层提成点外，再享线下所有会员的业绩红包<input name="ticheng180_all" value="<?php echo isset($rt['ticheng180_all']) ? $rt['ticheng180_all'] : '0.00';?>" size="6" type="text" />%【相对销售业绩】<br/>
			 一层分佣<input name="ticheng180_h2_1" value="<?php echo isset($rt['ticheng180_h2_1']) ? $rt['ticheng180_h2_1'] : '0';?>" size="10" type="text" />%<br/>
			 二层分佣<input name="ticheng180_h2_2" value="<?php echo isset($rt['ticheng180_h2_2']) ? $rt['ticheng180_h2_2'] : '0';?>" size="10" type="text" />%<br/>
			 三层分佣<input name="ticheng180_h2_3" value="<?php echo isset($rt['ticheng180_h2_3']) ? $rt['ticheng180_h2_3'] : '0';?>" size="10" type="text" />%<br/>

			  </td>
		</tr>
		<tr>
			<td colspan="2">
			<hr/>
			</td>
		</tr>
		<tr>
			<td class="label">开通分销设置：</td>
			<td>
			  <label><input type="checkbox" name="openfxbuy" value="1"<?php echo isset($rt['openfxbuy'])&&$rt['openfxbuy']=='1' ? ' checked="checked"' : '';?> />&nbsp;购买自动开通&nbsp;&nbsp;</label>
			  <label><input type="checkbox" name="openfxauto" value="1"<?php echo isset($rt['openfxauto'])&&$rt['openfxauto']=='1' ? ' checked="checked"' : '';?> />&nbsp;默认自动开通&nbsp;&nbsp;</label>
			</td>
		</tr>
		<tr>
			<td class="label">分销中心查看设置：</td>
		  <td>
			  <label><input type="radio" name="viewfxset" value="1"<?php echo isset($rt['viewfxset'])&&$rt['viewfxset']=='1' ? ' checked="checked"' : '';?> />&nbsp;普通会员可查看&nbsp;&nbsp;</label>
			  <label><input type="radio" name="viewfxset" value="0"<?php echo isset($rt['viewfxset'])&&$rt['viewfxset']=='0' ? ' checked="checked"' : '';?> />&nbsp;普通会员不可查看&nbsp;&nbsp;</label>
			  </td>
		</tr>
		<tr>
			<td class="label">关注购买：</td>
		  <td>
			  <label><input type="radio" name="guanzhubuy" value="1"<?php echo isset($rt['guanzhubuy'])&&$rt['guanzhubuy']=='1' ? ' checked="checked"' : '';?> />&nbsp;可以购买&nbsp;&nbsp;</label>
			  <label><input type="radio" name="guanzhubuy" value="0"<?php echo isset($rt['guanzhubuy'])&&$rt['guanzhubuy']=='0' ? ' checked="checked"' : '';?> />&nbsp;不可以购买&nbsp;&nbsp;</label>
			  </td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			  <input type="hidden" name="type" value="basic" />
			<label>
			  <input type="submit" value="确认保存" class="submit" style="cursor:pointer; padding:2px 4px 2px 4px"/>
		  </label></td>
		</tr>
		</table>
</form>
</div>
<script language="javascript">
$('.submit').click(function(){
	
	return true;
});



function ger_ress_copy(type,obj,seobj){
	parent_id = $(obj).val();
	if(parent_id=="" || typeof(parent_id)=='undefined'){ return false; }
	$.post('user.php',{action:'get_ress',type:type,parent_id:parent_id},function(data){
		if(data!=""){
			$(obj).parent().find('#'+seobj).html(data);
			
			if(type==5){ //村
				$(obj).parent().find('#'+seobj).show();
				$(obj).parent().find('#select_peisong').hide();
			}else if(type==4){ //城镇
				$(obj).parent().find('#select_village').hide();
				$(obj).parent().find('#select_village').html('<option value="0" >选择村</option>');
				$(obj).parent().find('#select_peisong').hide();
				
				$(obj).parent().find('#select_town').show();
				//$(obj).parent().find('#select_town').html("");
			}else if(type==3){ //区
				$(obj).parent().find('#select_peisong').hide();
				$(obj).parent().find('#select_peisong').html('<option value="0" >选择配送店</option>');
				
				$(obj).parent().find('#select_village').hide();
				$(obj).parent().find('#select_village').html('<option value="0" >选择村</option>');
				
				$(obj).parent().find('#select_town').hide();
				$(obj).parent().find('#select_town').html('<option value="0" >选择城镇</option>');
				
				$(obj).parent().find('#select_district').show();
				//$(obj).parent().find('#select_district').html("");
				
			}else if(type==2){ //市
				$(obj).parent().find('#select_peisong').hide();
				$(obj).parent().find('#select_peisong').html('<option value="0" >选择配送店</option>');
				
				$(obj).parent().find('#select_village').hide();
				$(obj).parent().find('#select_village').html('<option value="0" >选择村</option>');
				
				$(obj).parent().find('#select_town').hide();
				$(obj).parent().find('#select_town').html('<option value="0" >选择城镇</option>');
				
				$(obj).parent().find('#select_district').hide();
				$(obj).parent().find('#select_district').html('<option value="0" >选择区</option>');
				
				//$(obj).parent().find('#select_city').hide();
				//$(obj).parent().find('#select_city').html("");
			}

		}else{
			alert(data);
		}
	});
}




function change_user_points_money(uid,thisobj,type){
	val = $(thisobj).val();
	if(val>0 || val<0){
		if(confirm("你确定执行该操作吗？")){
			createwindow();
			$.post('user.php',{action:'change_user_points_money',uid:uid,type:type,val:val},function(data){
				if(typeof(data)!='undefined' && data!=""){
					removewindow();
					if(parseInt(data)>0){
						if(type=='money'){
							$(thisobj).parent().find('.thismoney').html(data);
						}else if(type =='points'){
							$(thisobj).parent().find('.thispoints').html(data);
						}
					}
					alert("操作成功！");
				}else{
					alert("操作失败！");
				}
			});
		}
	}
	return false;
}

  function get_userpoint_page_list(page,uid){
  		createwindow();
		$.post('user.php',{action:'pointinfo',page:page,uid:uid},function(data){
			removewindow();
			if(data !="" && typeof(data)!='undefined'){
				$('.user_point').html(data);
			}
		});
  }
  
  function get_usermoney_page_list(page,uid){
  		createwindow();
		$.post('user.php',{action:'mymoney',page:page,uid:uid},function(data){
			removewindow();
			if(data !="" && typeof(data)!='undefined'){
				$('.user_money').html(data);
			}
		});
}
</script>
