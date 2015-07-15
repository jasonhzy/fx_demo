<style type="text/css">
.checkout{ background:#FFF;}
.checkout p.title {
background: #eaeaea;
height: 27px;
line-height: 27px;
text-indent: 10px;
width: 100%;
color: #9a0000;
font-weight: bold;
margin: 10px 0px 0px 0px;
border-bottom:2px solid #CCC
}
.checkout table {
text-align: left;
color: #5f5f5f;
margin:0px;
}
.checkout td {
line-height: 18px;
padding: 3px 0px 3px 0px;
}
.checkout .userreddinfo td {
line-height: 18px;
padding: 2px 0px 2px 0px;
}
.checkout td label{ line-height:22px;}
label{ cursor:pointer}
.pw{ line-height:23px; height:23px;}
.addgallery i{font-style:normal;}
</style>
<div id="main" style="padding:5px; padding-top:0px; min-height:300px">
	<div class="checkout">
	<form action="<?php echo ADMIN_URL;?>mycart.php?type=confirm_daigou" method="post" name="CONSIGNEE_ADDRESS" id="CONSIGNEE_ADDRESS">
			<?php
				  if(!empty($rt['goodslist'])){
				  $total= 0;
				  $uid = $this->Session->read('User.uid');
				  $active = $this->Session->read('User.active');
				  $rank = $this->Session->read('User.rank');
				  foreach($rt['goodslist'] as $k=>$row){
					  if(!($row['goods_id'])>0) continue;
					  if($row['is_alone_sale']=='0'&&(empty($rt['gift_goods_ids']) || !in_array($row['goods_id'],$rt['gift_goods_ids']))){ //条件不满足者  不允许购买赠品
							$gid = $row['goods_id'];
							$this->Session->write("cart.{$gid}","");
							continue;
					  }
					 
					  $onetotal = $row['pifa_price'];
					  $total +=$onetotal*$row['number'];
		   ?>
		<table border="0" cellpadding="0" cellspacing="0" style="width:100%;border-radius:5px; border:1px solid #ededed; margin-top:10px;">
			<tr>
				<td style="width:80px; text-align:center; height:80px; padding-top:10px; overflow:hidden; border-bottom:1px solid #ededed;">
					<img src="<?php echo SITE_URL.$row['goods_thumb'];?>" title="<?php echo $row['goods_name'];?>" border="0" style="width:78px; height:78px; border:1px solid #ededed; padding:1px; margin-left:5px;">
				</td>
				<td style="text-align:left; border-bottom:1px solid #ededed;" valign="top">
				<p style="padding-left:10px; position:relative"><font color="red"><?php if($row['is_alone_sale']=='0'||$row['is_qianggou']=='1' || $row['is_jifen_session']=='1'){
									if($row['is_jifen_session']=='1'){
										echo '[积分商品]';
									}else{
										echo $row['is_qianggou']=='1' ?  '[抢购商品]' : '[赠品]';
									}
							  }else{
								//echo '[折扣]';
							  }
						?></font>
					<?php echo $row['goods_name'];?>
					<?php if(!empty($row['buy_more_best'])){echo '<br />该商品实行<font style="color:#FE0000;font-weight:bold">['.$row['buy_more_best'].']</font>促销活动，欢迎订购！';}?><span style="padding:2px 5px 2px 5px; color:#FF0000; cursor:pointer; position:absolute; right:1px; top:-3px; z-index:22; background:#fafafa; border:1px solid #ededed;border-radius:5px;" class="delcartid" id="<?php echo $k;?>">删除</span></p>
				<?php if(!empty($row['spec'])){
				 echo '<p style="padding-left:10px;">'.implode("、",$row['spec']).'</p>';
				 } ?>
				 <p style=" padding-left:10px;font-size:14px; color:#FF0000; font-weight:bold" class="raturnprice raturnprice<?php echo $k;?>">￥<?php echo $onetotal*$row['number'];?></p>
				 <div class="item" style="height:24px; line-height:24px; position:relative; padding-left:10px;">
					<?php if($row['is_alone_sale']=='0' || $row['is_jifen_session']=='1'){
						if($row['is_jifen_session']=='1'){
							echo '需&nbsp;'.$row['need_jifen']*$row['number'].'&nbsp;积分<br />数量&nbsp;'.$row['number'];
						}else{
							echo ($row['is_qianggou']=='1' ?  '数量&nbsp;' .$row['number']:  '数量&nbsp;'.$row['number']);
						}
					}else{?>
						总数量:<span class="numbers<?php echo $k;?>"><?php echo $row['number'];?></span><b style="margin-left:3px;"><?php  echo $row['goods_unit'];?></b>
					<?php } ?>
				  </div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="padding:10px; padding-top:0px" class="goodss">
						<table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top:5px;">
						<tr>
							<td align="right">
							<span style="display:block; height:20px; float:right;padding-right:15px;"></span>
							<span class="addgallery" style="border-radius:50%; height:20px; line-height:20px; width:20px; float:right; display:block;background:#CE325A; text-align:center; font-size:16px; font-weight:bold; color:#FFF; cursor:pointer" id="<?php echo $k;?>"><i>+</i></span>
							</td>
							<td colspan="3" align="left">
								<div class="item" style="height:24px; line-height:24px; position:relative">
									<a class="jian" style="cursor:pointer; display:block; float:left; width:35px; height:22px;line-height:22px;text-align:center; font-size:18px; font-weight:bold; border:1px solid #ccc; background:#ededed" id="<?php echo $k;?>">-</a><input name="goods_number[<?php echo $k;?>][]" value="<?php echo $row['number'];?>" class="inputBg" style=" float:left;text-align: center; width:20px; height:22px; line-height:22px;border-bottom:1px solid #ccc; border-top:1px solid #ccc" type="text"> <a class="jia" style="cursor:pointer; display:block; float:left; width:35px; height:22px;line-height:22px;text-align:center; font-size:18px; font-weight:bold; border:1px solid #ccc; background:#ededed" id="<?php echo $k;?>">+</a><b style="float:left; margin-left:3px;"></b>
								</div>
							</td>
						</tr>
						<tr>
							<td align="right" width="15%">姓名：</td>
							<td align="left" width="35%">
							<input type="text" value="" name="consignee[<?php echo $k;?>][]"  class="pw" style="width:100%;"/> 
							</td>
							<td align="right" width="15%">电话：</td>
							<td align="left" width="35%">
							<input type="text" value="" name="moblie[<?php echo $k;?>][]"  class="pw" style="width:100%;"/> 
							</td>
						</tr>
						<tr>
							<td align="right" width="15%">区域：</td>
							<td align="left" width="85%" colspan="3">
							<?php $this->element('addressmore',array('resslist'=>$rt['province'],'goods_id'=>$k));?>
							</td>
						</tr>
						<tr>
							<td align="right" width="15%">地址：</td>
							<td align="left" width="85%" colspan="3">
							<input type="text" value="" name="address[<?php echo $k;?>][]"  class="pw" style="width:100%;"/> 
							</td>
						</tr>
						</table>
						
					</div>
				</td>
			</tr>
			 <?php } ?>
		</table>
		<?php } ?>
		
		<table cellpadding="0" cellspacing="0" style="width:100%;border-radius:5px; border:1px solid #ededed; margin-top:10px;">
			<tr>
				  <td align="right" width="15%"><span>支付方式：</span></td>
				  <td align="left" width="85%">
				  <?php 
				if(!empty($rt['paymentlist'])){
					echo '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">';
					foreach($rt['paymentlist'] as $row){
					?>
					<tr>
					  <td><label><span style="padding-left:10px;"><input name="pay_id"  id="pay_id" value="<?php echo $row['pay_id'];?>" type="radio"></span><strong><?php echo $row['pay_name'];?></strong></label></td>
					</tr>
					<?php
					}
					echo '</table>';
				}
				?>
				  </td>
			</tr>
			<tr>
				  <td align="right" width="15%"><span>配送方式：</span></td>
				  <td align="left" width="85%">
					<?php 
					$free = array();
					if(!empty($rt['shippinglist'])){
					echo '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">';
					foreach($rt['shippinglist'] as $k=>$row){
					?>
					<tr>
					  <td><label><span style="padding-left:10px;"><input name="shipping_id" id="shipping_id" value="<?php echo $row['shipping_id'];?>" type="radio" /></span><strong><?php echo $row['shipping_name'];?></strong></label></td>
					</tr>
					<?php
					}
					echo '</table>';
				}
				?>
				  </td>
			</tr>
			<tr>
				<td align="right">订单附言：</td>
				<td>
				<textarea class="pw" name="postscript" id="postscript" style="width:96%; height:80px;"></textarea>
				</td>
			</tr>
		</table>
		<div style="padding-left:5px;">
			<?php $free[0] = empty($free[0]) ? '0.00' : $free[0]; ?>
			<!--<p style="height:24px; line-height:24px;">
				商品总价(不含运费)：<span style="color:red;" class="ajax_change_jfien">￥<span class="nototals"><?php echo $total;?></span>元</span>
				&nbsp;&nbsp;配运费：<span class="free_shopping" style="color:red;">￥<?php echo $free[0];?></span>
			</p>-->
			<p style="height:25px; line-height:25px; color:#222; font-size:16px; font-weight:bold; color:#9A0000; padding-top:5px;">结算总金额：￥<span class="ztotals"><?php echo $total;?></span>元</p>
			<?php if($zjifen > 0){?>
			<p style="text-align:right; padding:25px; font-weight:bold">当前积分：<font color="red"><?php echo $rt['mypoints']>0 ? $rt['mypoints'] : 0;?></font>&nbsp;&nbsp;&nbsp;需要支付积分：<font color="red"><?php echo $zjifen;?></font>&nbsp;&nbsp;&nbsp;
			  <label>
			  <input type="checkbox" name="confirm_jifen" value="<?php echo $zjifen;?>" onclick="ajax_change_jifen(this.checked)"/>&nbsp;<font color="red">确定兑换商品吗？</font>
			  </label>
			</p>
			<?php } ?>
			<p style="height:30px; line-height:30px; margin-top:10px;">
			  <input type="hidden" name="totalprice" value="<?php echo $total;?>" />
			<input value="提交" type="submit" align="absmiddle" onclick="return checkvar()" style="margin-bottom:33px;width:100px; height:30px; line-height:30px; background:url(<?php echo ADMIN_URL;?>images/buybut.jpg) 0px 0px no-repeat; font-size:20px; color:#FFFFFF; font-weight:bold; text-align:center; cursor:pointer"/>
			</p>
	  </div>
	</form>
	</div>
</div>

<div style="height:20px;"></div>
<?php  $thisurl = ADMIN_URL.'mycart.php'; ?> 
<script language="javascript" type="text/javascript">
//2位小数
function toDecimal(x) {  
	var f = parseFloat(x);  
	if (isNaN(f)) {  
		return;  
	}  
	f = Math.round(x*100)/100;  
	return f;  
}  

$('.delcartid').click(function(){
	if(confirm("确定移除吗")){
		gid = $(this).attr('id');
		sprice = $('.raturnprice'+gid).html();
		sprice = sprice.replace('￥','');
		sprice = toDecimal(sprice);
		
		ztotals = $('.ztotals').html();
		ztotals = toDecimal(toDecimal(ztotals)-sprice);
		$('.ztotals').html(ztotals);
	
		$(this).parent().parent().parent().parent().parent().remove();
		
		$.post('<?php echo $thisurl;?>',{action:'ajax_remove_cargoods',gid:gid},function(prices){});
	}
	return false;
});
		
$('.addgallery').live('click',function(){
	gid = $(this).attr('id');
	obj = $(this).parent().parent().parent().parent();
	consignee = $(obj).find('input[name="consignee['+gid+'][]"]').val();
	moblie = $(obj).find('input[name="moblie['+gid+'][]"]').val();
	address = $(obj).find('input[name="address['+gid+'][]"]').val();

	province = $(obj).find('select[name="province['+gid+'][]"]').val();
	city = $(obj).find('select[name="city['+gid+'][]"]').val();
	district = $(obj).find('select[name="district['+gid+'][]"]').val();
	
	number = $(obj).find('input[name="goods_number['+gid+'][]"]').val();
	
	num = $(obj).parent().find('table').length;
	num = parseInt(num)+1;
	$.post('<?php echo $thisurl;?>',{action:'ajax_get_address',province:province,city:city,district:district,gid:gid},function(quyu){
			str = '<table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top:5px;"><tr><td align="right"><span style="display:block; height:20px; float:right;padding-right:15px;"></span><span class="removegallery" style="border-radius:50%; height:20px; line-height:20px; width:20px; float:right; display:block;background:#CE325A; text-align:center; font-size:16px; font-weight:bold; color:#FFF; cursor:pointer" id="'+gid+'"><i>-</i></span></td><td colspan="3" align="left"><div class="item" style="height:24px; line-height:24px; position:relative"><a class="jian" style="cursor:pointer; display:block; float:left; width:35px; height:22px;line-height:22px;text-align:center; font-size:18px; font-weight:bold; border:1px solid #ccc; background:#ededed">-</a><input name="goods_number['+gid+'][]" value="'+number+'" class="inputBg" style=" float:left;text-align: center; width:20px; height:22px; line-height:22px;border-bottom:1px solid #ccc; border-top:1px solid #ccc" type="text"> <a class="jia" style="cursor:pointer; display:block; float:left; width:35px; height:22px;line-height:22px;text-align:center; font-size:18px; font-weight:bold; border:1px solid #ccc; background:#ededed">+</a><b style="float:left; margin-left:3px;"></b></div></td></tr><tr><td align="right" width="15%">姓名：</td><td align="left" width="35%"><input type="text" value="'+consignee+'" name="consignee['+gid+'][]"  class="pw" style="width:100%;"/> </td><td align="right" width="15%">电话：</td><td align="left" width="35%"><input type="text" value="'+moblie+'" name="moblie['+gid+'][]"  class="pw" style="width:100%;"/> </td></tr><tr><td align="right" width="15%">区域：</td><td align="left" width="85%" colspan="3">'+quyu+'</td></tr><tr><td align="right" width="15%">地址：</td><td align="left" width="85%" colspan="3"><input type="text" value="'+address+'" name="address['+gid+'][]"  class="pw" style="width:100%;"/> </td></tr></table>';
			$(obj).after(str);
			//计算数量
			number1 = $('.numbers'+gid).html();
			nums = parseInt(number1)+parseInt(number);
			$('table .numbers'+gid).html(nums);
			//计算价格
			jisuanprice(gid,num,nums);
	});
});

function jisuanprice(gid,num,nums){
	//当前商品的价格
	sprice = $('.raturnprice'+gid).html();
	sprice = sprice.replace('￥','');
	sprice = toDecimal(sprice);
	//当前商品总价
	ztotals = $('.ztotals').html();
	ztotals = toDecimal(ztotals);
	
	$.post('<?php echo $thisurl;?>',{action:'ajax_jisuanprice',gid:gid,num:num},function(prices){
		$('.ztotals').html(toDecimal(ztotals+(prices*nums-sprice)));
		$('.raturnprice'+gid).html('￥'+toDecimal(prices*nums));
		$('input[name="totalprice"]').val(toDecimal(ztotals+(prices*nums-sprice)));
	});
}

$('.removegallery').live('click',function(){
	gid = $(this).attr('id');
	obj = $(this).parent().parent().parent().parent();
	number = $(obj).find('input[name="goods_number['+gid+'][]"]').val();
	num = $(obj).parent().find('table').length;
	num = num-1;
	$(obj).remove();
	
	//计算数量
	number1 = $('.numbers'+gid).html();
	nums = parseInt(number1)-parseInt(number);
	$('table .numbers'+gid).html(nums);
			
	//当前商品的价格
	sprice = $('.raturnprice'+gid).html();
	sprice = sprice.replace('￥','');
	sprice = toDecimal(sprice);
	//当前商品总价
	ztotals = $('.ztotals').html();
	ztotals = toDecimal(ztotals);
	
	$.post('<?php echo $thisurl;?>',{action:'ajax_jisuanprice',gid:gid,num:num},function(prices){
		chaprice = toDecimal( toDecimal(sprice)-toDecimal(prices*nums) );
		$('.ztotals').html(toDecimal(ztotals-chaprice)); 
		$('.raturnprice'+gid).html('￥'+toDecimal(prices*nums));
		$('input[name="totalprice"]').val( toDecimal(ztotals-chaprice) );
	});
	
	return false;
});

$('.jia').live('click',function(){
	gid = $(this).attr('id');
	n = $(this).parent().find('input').val();
	$(this).parent().find('input').val(parseInt(n)+1);
	
	nums = $('.numbers'+gid).html();
	nums = parseInt(nums);
	$('table .numbers'+gid).html(nums+1);
		
	obj = $(this).parent().parent().parent().parent().parent().parent();
	num = $(obj).find('table').length;
		
	//当前商品的价格
	sprice = $('.raturnprice'+gid).html();
	sprice = sprice.replace('￥','');
	sprice = toDecimal(sprice);
	//当前商品总价
	ztotals = $('.ztotals').html();
	ztotals = toDecimal(ztotals);
	
	$.post('<?php echo $thisurl;?>',{action:'ajax_jisuanprice',gid:gid,num:num},function(prices){
		$('.ztotals').html(toDecimal(ztotals+toDecimal(prices)));
		$('.raturnprice'+gid).html('￥'+toDecimal(prices*(nums+1)));
		$('input[name="totalprice"]').val(toDecimal(ztotals+toDecimal(prices)));
	});
});

$('.jian').live('click',function(){
	gid = $(this).attr('id');
	n = $(this).parent().find('input').val();
	if(n<=1){
		return false;
	}
	$(this).parent().find('input').val(parseInt(n)-1);
	
	nums = $('.numbers'+gid).html();
	nums = parseInt(nums);

	$('table .numbers'+gid).html(nums-1);
		
	obj = $(this).parent().parent().parent().parent().parent().parent();
	num = $(obj).find('table').length;
		
	//当前商品的价格
	sprice = $('.raturnprice'+gid).html();
	sprice = sprice.replace('￥','');
	sprice = toDecimal(sprice);
	//当前商品总价
	ztotals = $('.ztotals').html();
	ztotals = toDecimal(ztotals);
	
	$.post('<?php echo $thisurl;?>',{action:'ajax_jisuanprice',gid:gid,num:num},function(prices){
		$('.ztotals').html(toDecimal(ztotals-toDecimal(prices)));
		$('.raturnprice'+gid).html('￥'+toDecimal(prices*(nums-1)));
		$('input[name="totalprice"]').val(toDecimal(ztotals-toDecimal(prices)));
	});
});

$('input[name="userress_id"]').live('click',function(){
	var len = $('input[name="userress_id"]:checked').length;
	if(len > 3){
		this.checked=false;
		alert("最多只能选择3个收货地址！");
	}
});

$('.showaddress').live('click',function(){
	/*var vv= $(this).val();
	if(vv==0){
	$('.userreddinfo').show();
	}else{
	$('.userreddinfo').hide();
	}*/
	$('.userreddinfo').toggle();
});

function checkvar(){

	pp = $('input[name="pay_id"]:checked').val(); 
	if(typeof(pp)=='undefined' || pp ==""){
		alert("请选择支付方式！");
		return false;
	}
	
	ss = $('input[name="shipping_id"]:checked').val(); 
	if(typeof(ss)=='undefined' || ss ==""){
		alert("请选择配送方式！");
		return false;
	}
	
	return true;
	userress_id = $('input[name="userress_id"]:checked').val();
	if(userress_id == '0' || userress_id == '' || typeof(userress_id)=='undefined'){
			consignee = $('input[name="consignee"]').val(); 
			if(typeof(consignee)=='undefined' || consignee ==""){
				alert("收货人不能为空！");
				return false;
			}
			
			provinces = $('select[name="province"]').val();
			if ( provinces == '0' )
			{
				alert("请选择收货地址！");
				return false;
			}
			
			city = $('select[name="city"]').val();
			if ( city == '0' )
			{
				alert("请完整选择收货地址！");
				return false;
			}
			
			district = $('select[name="district"]').val();
			if ( district == '0' )
			{
				alert("请完整选择收货地址！");
				return false;
			}
			
			shipping_id = $(':radio[name="shipping_id"]:checked').val();
			if ( shipping_id == '6')
			{
				shop_id = $('select[name="shop_id"]').val();
				if ( shop_id == '0' || shop_id == '' )
				{
					alert("此处暂无配送店,请选择送货上门。");
					return false;
				}
			}
			
		
			address = $('input[name="address"]').val(); 
			if(typeof(address)=='undefined' || address ==""){
				alert("详细地址不能为空！");
				return false;
			}
			
			zipcode = $('input[name="zipcode"]').val(); 
			if(typeof(zipcode)=='undefined' || zipcode ==""){
				alert("邮政编码有误！");
				return false;
			}
			
			mobile = $('input[name="mobile"]').val(); 
			tel = $('input[name="tel"]').val(); 
			if(mobile =="" && tel ==""){
				alert("请输入手机或者电话号码！");
				return false;
			}
	}	
	
	var arr = [];
	$('input[name="userress_id"]:checked').each(function(){
		arr.push($(this).val());
	});
	$('input[name="userress_ids"]').val(arr.join('+'));
	if(arr.length<1){
		alert("请选择收货地址");
		return false;
	}
	return true;
}

//计算邮费
function jisuan_shopping(id){
		if(id=="" || typeof(id)=='undefined') return false;
		uu = $('input[name="userress_id"]:checked').val();
		if(typeof(uu)=='undefined' || uu ==""){
			alert("请选择一个收货地址！");
			return false;
		}
		createwindow();
/*	

		if(id==6){
			$('.shipping').show();
			//$('.address_sh').hide();
			//$('input[name="address"]').val("");
		}else{
			$('.shipping').hide();
			//$("select[name='shop_id']").html('<option value="0" >选择配送店</option>');
			$("select[name='shop_id']").val('0')
			//$('.address_sh').show();
		}*/
		
		$.post('<?php echo $thisurl;?>',{action:'jisuan_shopping',shopping_id:id,userress_id:uu},function(data){
				if(data !="" && typeof(data) !='undefined'){
					arr = data.split('+');
					if(arr.length==2){
					$('.free_shopping').html('￥'+arr[1]);
					b = $('.nototals').html();
					$('.ztotals').html(parseFloat(b)+parseFloat(arr[1]));
					}else{
						alert(data);
					}
				}else{
					$('.free_shopping').html('￥0.00');
					b = $('.nototals').html();
					$('.ztotals').html(parseFloat(b));
				}
				removewindow();
		});
		
}

function ajax_change_jifen(checked){
	if(checked==true){
		tt = "true";
	}else{
		tt = "false";
	}
	createwindow();
	$.post('<?php echo $thisurl;?>',{action:'change_jifen',checked:tt},function(data){
		if(data>=0){
			$('.ajax_change_jfien').html('￥'+data+'元');
		}	
		removewindow();
	});
}
</script>
