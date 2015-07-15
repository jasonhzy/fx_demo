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
.item-box-buy-btn {
font-size: 12px;
color: #456f9a;
border: 1px solid #456f9a;
border-radius: 5px;
cursor: pointer;
float: right;
width: 80px;
height: 25px;
line-height: 25px;
text-align: center;
overflow: hidden;
white-space: nowrap;
background:#C7ECF3;
}
.addgallery{ padding-left:14px;background:url(<?php echo $this->img('+.png');?>) 3px center no-repeat}
.removegallery{ padding-left:14px;background:url(<?php echo $this->img('-.png');?>) 3px center no-repeat}
</style>
<div id="main" style="padding:5px; padding-top:0px; min-height:300px">
	<div class="checkout">
	<form action="<?php echo ADMIN_URL;?>mycart.php?type=confirm_daigou2" method="post" name="CONSIGNEE_ADDRESS" id="CONSIGNEE_ADDRESS">
			<?php
			$goodslist = $this->Session->read('cart'); //print_r($goodslist);
			$useradd = $this->Session->read('useradd');//print_r($useradd);
				  if(!empty($goodslist)){
				  $total= 0;
				  $uid = $this->Session->read('User.uid');
				  $active = $this->Session->read('User.active');
				  $rank = $this->Session->read('User.rank');
				  foreach($goodslist as $k=>$row){
					  if(!($row['goods_id'])>0) continue;
					  //赠品去掉
					  if($row['is_alone_sale']=='0'&&(empty($rt['gift_goods_ids']) || !in_array($row['goods_id'],$rt['gift_goods_ids']))){ //条件不满足者  不允许购买赠品
							$gid = $row['goods_id'];
							$this->Session->write("cart.{$gid}",null);
							continue;
					  }
					 
					  $total +=$row['price']*$row['number'];
		   ?>
		<table border="0" cellpadding="0" cellspacing="0" style="width:100%;border-radius:5px; border:1px solid #ededed; margin-top:10px;">
			<tr>
				<td style="width:80px; text-align:center; height:80px; padding-top:10px; overflow:hidden; border-bottom:1px solid #ededed;">
					<img src="<?php echo SITE_URL.$row['goods_thumb'];?>" title="<?php echo $row['goods_name'];?>" border="0" style="width:78px; height:78px; border:1px solid #ededed; padding:1px; margin-left:5px;">
				</td>
				<td style="text-align:left; border-bottom:1px solid #ededed;" valign="top">
				<p style="padding-left:10px; position:relative; line-height:24px;"><font color="red"><?php if($row['is_alone_sale']=='0'||$row['is_qianggou']=='1' || $row['is_jifen_session']=='1'){
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
				 <p style=" padding-left:10px;font-size:12px;line-height:24px;" class="raturnprice raturnprice<?php echo $k;?>">会员价:<font color="#5f5f5f">￥<?php echo $row['pifa_price'];?></font>&nbsp;&nbsp;惊喜价:<font color="#FF0000" class="gprice<?php echo $row['goods_id'];?>">￥<?php echo $row['price'];?></font></p>
				 <div class="item" style="height:24px; line-height:24px; position:relative; padding-left:10px;">
					<?php if($row['is_alone_sale']=='0' || $row['is_jifen_session']=='1'){
						if($row['is_jifen_session']=='1'){
							echo '需&nbsp;'.$row['need_jifen']*$row['number'].'&nbsp;积分<br />数量&nbsp;'.$row['number'];
						}else{
							echo ($row['is_qianggou']=='1' ?  '数量&nbsp;' .$row['number']:  '数量&nbsp;'.$row['number']);
						}
					}else{?>
						总数量:<span style="color:#FF0000" class="numbers<?php echo $k;?>"><?php echo $row['number'];?></span><b style="margin-left:3px;"><?php  echo $row['goods_unit'];?></b>
						&nbsp;&nbsp;小计:<font color="#FF0000" class="gzprice<?php echo $row['goods_id'];?>">￥<?php echo $row['price']*$row['number'];?></font>
					<?php } ?>
				  </div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="padding:10px; padding-top:0px;padding-bottom:0px" class="goodss">
					<?php
					$ks = 0;
					if(!empty($useradd[$k]))foreach($useradd[$k] as $kk=>$ress){
					 ?>
						<table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top:5px;">
						<tr>
							<td align="right" width="15%">数量：</td>
							<td colspan="2" align="left">
								<div class="item" style="height:24px; line-height:24px; position:relative">
									<a class="jian" style="cursor:pointer; display:block; float:left; width:35px; height:22px;line-height:22px;text-align:center; font-size:18px; font-weight:bold; border:1px solid #ccc; background:#ededed">-</a><input readonly="" alt="<?php echo $k;?>" id="<?php echo $kk;?>" name="goods_number" value="<?php echo $ress['number'];?>" class="inputBg <?php echo 'gn'.$k.$kk;?>" style="float:left;text-align: center; width:20px; height:22px; line-height:22px;border-bottom:1px solid #ccc; border-top:1px solid #ccc" type="text"> <a class="jia" style="cursor:pointer; display:block; float:left; width:35px; height:22px;line-height:22px;text-align:center; font-size:18px; font-weight:bold; border:1px solid #ccc; background:#ededed">+</a><b style="float:left; margin-left:3px;"></b>
								</div>
							</td>
							<td align="right">
							<?php if($ks=='0'){?>
							<span class="item-box-buy-btn addgallery" item-id="<?php echo $k;?>" item-name="<?php echo $kk;?>" style="width:80px;">增加收货地址</span>
							<?php }else{?>
							<span class="item-box-buy-btn removegallery" item-id="<?php echo $k;?>" item-name="<?php echo $kk;?>" style="width:80px;">移除收货地址</span>
							<?php } ++$ks;?>
							</td>
						</tr>
						<tr>
							<td align="right" width="15%">姓名：</td>
							<td align="left" width="35%">
							<input alt="<?php echo $k;?>" id="<?php echo $kk;?>" type="text" value="<?php echo $ress['consignee'];?>" name="consignee"  class="pw postdata" style="width:100%;" /> 
							</td>
							<td align="right" width="15%">电话：</td>
							<td align="left" width="35%">
							<input alt="<?php echo $k;?>" id="<?php echo $kk;?>" type="text" value="<?php echo $ress['moblie'];?>" name="moblie"  class="pw postdata" style="width:100%;" /> 
							</td>
						</tr>
						<tr>
							<td align="right" width="15%">地址：</td>
							<td align="left" width="85%" colspan="3">
							<input alt="<?php echo $k;?>" id="<?php echo $kk;?>" type="text" value="<?php echo $ress['address'];?>" name="address[<?php echo $k;?>][]"  class="pw postdata" style="width:100%;" /> 
							</td>
						</tr>
						</table>
						<?php } ?>
					</div>
				</td>
			</tr>
			 <?php } ?>
		</table>
		<?php } ?>
		
		<table cellpadding="0" cellspacing="0" style="width:100%;border-radius:5px; border:1px solid #ededed; margin-top:10px;">
			<tr>
				  <td align="right" width="22%"><span>支付方式：</span></td>
				  <td align="left" width="78%">
				  <?php 
				if(!empty($rt['paymentlist'])){
					echo '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">';
					foreach($rt['paymentlist'] as $k=>$row){
					?>
					<tr>
					  <td><label><span><input name="pay_id"  id="pay_id"<?php if($k=='0'){ echo ' checked="checked"';}?> value="<?php echo $row['pay_id'];?>" type="radio"></span><strong><?php echo $row['pay_name'];?></strong></label></td>
					</tr>
					<?php
					}
					echo '</table>';
				}
				?>
				  </td>
			</tr>
			<tr>
				  <td align="right" width="22%"><span>配送方式：</span></td>
				  <td align="left" width="78%">
					<?php 
					$free = array();
					if(!empty($rt['shippinglist'])){
					echo '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;display:none">';
					foreach($rt['shippinglist'] as $k=>$row){
					?>
					<tr>
					  <td><label><span style="padding-left:10px;"><input<?php echo $k=='0' ? ' checked="checked"':'';?> name="shipping_id" id="shipping_id" value="<?php echo $row['shipping_id'];?>" type="radio" /></span><strong><?php echo $row['shipping_name'];?></strong></label></td>
					</tr>
					<?php
					}
					echo '</table>';
				}
				?>快递免邮
				  </td>
			</tr>
			<tr>
				<td align="right" width="22%">订单附言：</td>
				<td>
				<textarea class="pw" name="postscript" id="postscript" style="width:96%; height:60px;"></textarea>
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
<!--			<?php if($zjifen > 0){?>
			<p style="text-align:right; padding:25px; font-weight:bold">当前积分：<font color="red"><?php echo $rt['mypoints']>0 ? $rt['mypoints'] : 0;?></font>&nbsp;&nbsp;&nbsp;需要支付积分：<font color="red"><?php echo $zjifen;?></font>&nbsp;&nbsp;&nbsp;
			  <label>
			  <input type="checkbox" name="confirm_jifen" value="<?php echo $zjifen;?>" onclick="ajax_change_jifen(this.checked)"/>&nbsp;<font color="red">确定兑换商品吗？</font>
			  </label>
			</p>
			<?php } ?>-->
			<p style="height:30px; line-height:30px; margin-top:10px;">
			<input type="hidden" name="totalprice" value="<?php echo $total;?>" />
			<input value="提交" type="submit" align="absmiddle" onclick="return checkvar()" style="width:100px; height:30px; line-height:30px; background:url(<?php echo ADMIN_URL;?>images/buybut.jpg) 0px 0px no-repeat; font-size:20px; color:#FFFFFF; font-weight:bold; text-align:center; cursor:pointer"/>
			&nbsp;&nbsp;<img src="<?php echo $this->img('clearcart.jpg');?>" align="absmiddle" style="cursor:pointer" onclick="return ajax_clear();" />
			</p>
	  </div>
	</form>
	</div>
</div>

<div style="height:20px;"></div>
<?php  $thisurl = ADMIN_URL.'mycart.php'; ?> 
<script language="javascript" type="text/javascript">
function ajax_clear(){
	if(confirm('确定吗')){
		window.location.href='<?php echo ADMIN_URL;?>mycart.php?type=clear';
		return true;
	}
	return false;
}
//产生随机数
function generateMixed(n) {
	var chars = ['0','1','2','3','4','5','6','7','8','9'];
    var res = "";
    for(var i = 0; i < n ; i ++) {
        var id = Math.ceil(Math.random()*9);
        res += chars[id];
    }
    return res;
}

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
		/*sprice = $('.raturnprice'+gid).html();
		sprice = sprice.replace('￥','');
		sprice = toDecimal(sprice);
		
		ztotals = $('.ztotals').html();
		ztotals = toDecimal(toDecimal(ztotals)-sprice);
		$('.ztotals').html(ztotals);*/
	
		$(this).parent().parent().parent().parent().parent().remove();
		
		$.post('<?php echo $thisurl;?>',{action:'ajax_remove_cargoods',gid:gid},function(prices){
			jisuanprice(gid,0);
		});
	}
	return false;
});
		
$('.addgallery').live('click',function(){
	gid = $(this).attr('item-id');
	obj = $(this).parent().parent().parent().parent();
	consignee = $(obj).find('input[name="consignee"]').val();
	moblie = $(obj).find('input[name="moblie"]').val();
	address = $(obj).find('input[name="address['+gid+'][]"]').val();
	number = $(obj).find('input[name="goods_number"]').val();
	kk = generateMixed(7);
	nn = $('.mycarts').html();
	$('.mycarts').html(parseInt(nn)+parseInt(number));
	//添加地址到session
	$.post('<?php echo $thisurl;?>',{action:'ajax_address_writesess',kk:kk,gid:gid,consignee:consignee,moblie:moblie,address:address,number:number},function(){
			str = '<table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top:5px;"><tr><td align="right" width="15%">数量：</td><td colspan="2" align="left"><div class="item" style="height:24px; line-height:24px; position:relative"><a class="jian" style="cursor:pointer; display:block; float:left; width:35px; height:22px;line-height:22px;text-align:center; font-size:18px; font-weight:bold; border:1px solid #ccc; background:#ededed">-</a><input readonly="" alt="'+gid+'" id="'+kk+'" name="goods_number" value="'+number+'" class="inputBg gn'+gid+kk+'" style="float:left;text-align: center; width:20px; height:22px; line-height:22px;border-bottom:1px solid #ccc; border-top:1px solid #ccc" type="text"> <a class="jia" style="cursor:pointer; display:block; float:left; width:35px; height:22px;line-height:22px;text-align:center; font-size:18px; font-weight:bold; border:1px solid #ccc; background:#ededed">+</a><b style="float:left; margin-left:3px;"></b></div></td><td align="right"><span class="item-box-buy-btn removegallery" item-id="'+gid+'" item-name="'+kk+'" style="width:80px;">移除收货地址</font></td></tr><tr><td align="right" width="15%">姓名：</td><td align="left" width="35%"><input alt="'+gid+'" id="'+kk+'" type="text" value="'+consignee+'" name="consignee"  class="pw" style="width:100%;"/> </td><td align="right" width="15%">电话：</td><td align="left" width="35%"><input alt="'+gid+'" id="'+kk+'" type="text" value="'+moblie+'" name="moblie"  class="pw" style="width:100%;"/> </td></tr><tr><td align="right" width="15%">地址：</td><td align="left" width="85%" colspan="3"><input alt="'+gid+'" id="'+kk+'" type="text" value="'+address+'" name="address['+gid+'][]" class="pw" style="width:100%;"/></td></tr></table>';
			$(obj).after(str);
			//计算数量
			number1 = $('.numbers'+gid).html();
			nums = parseInt(number1)+parseInt(number);
			
			//计算价格
			jisuanprice(gid,nums);
	});
});

function jisuanprice(goods_id,nums){
	createwindow();
	$.post(SITE_URL+'ajax.php',{action:'ajax_jisuan_price'},function(data){
		gg = data.goods;
		if(data.error!=0){
			//alert(data.message);
			//window.location.reload();
		}
		if(goods_id > 0){
			$('table .numbers'+goods_id).html(nums);
		}
		ar = gg.split('|');
		for (var i=0;i<ar.length;i++)
		{
			str = ar[i];
			rts = str.split(',');
			price = rts[0];
			zprice = rts[1];
			gid = rts[2];
			$('table .gprice'+gid).html('￥'+price); //惊喜价
			$('table .gzprice'+gid).html('￥'+zprice); //小计
		}
		
		$('input[name="totalprice"]').val(data.totalprice);
		$('.ztotals').html(data.totalprice);
		removewindow();
	},'json');
	/*$.ajax({
	   type: "POST",
	   url: SITE_URL+"ajax.php?action=ajax_jisuan_price",
	   data: "cart=" + $.toJSON(goods),
	   dataType: "json",
	   success: function(data){
	   		//$('input[name="totalprice"]').val(); 总价格
			
	   		window.location.href = '<?php echo ADMIN_URL.'mycart.php'?>';
	   }//end sucdess
	});*/
  	return false;
}
	


$('.removegallery').live('click',function(){
	gid = $(this).attr('item-id');
	kk = $(this).attr('item-name');
	obj = $(this).parent().parent().parent().parent();
	number = $('.gn'+gid+kk).val();

	//计算数量
	number1 = $('.numbers'+gid).html();
	nums = parseInt(number1)-parseInt(number);
	//$('table .numbers'+gid).html(nums);
	nn = $('.mycarts').html();
	$('.mycarts').html(parseInt(nn)-parseInt(number));
	//当前商品的价格
	/*sprice = $('.raturnprice'+gid).html();
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
	});*/
	$(this).parent().parent().parent().parent().remove();
	$.post('<?php echo $thisurl;?>',{action:'ajax_remove_goods_address',gid:gid,kk:kk,number:number},function(prices){
		jisuanprice(gid,nums);
	 });
	//计算价格
	
	return false;
});

$('.jia').live('click',function(){
	gid = $(this).parent().find('input').attr('alt');
	kk = $(this).parent().find('input').attr('id');
	n = $(this).parent().find('input').val();
	n = parseInt(n);
	$(this).parent().find('input').val(n+1);
	
	nums = $('.numbers'+gid).html();
	nums = parseInt(nums);
	$('table .numbers'+gid).html(nums+1);
	nn = $('.mycarts').html();
	$('.mycarts').html(parseInt(nn)+1);
	//计算价格
	$.post('<?php echo $thisurl;?>',{action:'ajax_change_goods_number',gid:gid,kk:kk,n:n+1,ty:'jia'},function(prices){
		jisuanprice(0,0);
	});
	/*obj = $(this).parent().parent().parent().parent().parent().parent();
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
	});*/
});

$('.jian').live('click',function(){
	gid = $(this).parent().find('input').attr('alt');
	kk = $(this).parent().find('input').attr('id');
	n = $(this).parent().find('input').val();
	if(n<=1){
		return false;
	}
	n = parseInt(n);
	
	$(this).parent().find('input').val(parseInt(n)-1);
	
	nums = $('.numbers'+gid).html();
	nums = parseInt(nums);

	$('table .numbers'+gid).html(nums-1);
	nn = $('.mycarts').html();
	$('.mycarts').html(parseInt(nn)-1);
	$.post('<?php echo $thisurl;?>',{action:'ajax_change_goods_number',gid:gid,kk:kk,n:n-1,ty:'jian'},function(prices){//alert(prices);
		jisuanprice(0,0);
	});
	/*obj = $(this).parent().parent().parent().parent().parent().parent();
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
	});*/
});
$('.postdata').live('change',function(){
	alt = $(this).attr('name');
	val = $(this).val();
	id = $(this).attr('alt');
	kk = $(this).attr('id');
	$.post('<?php echo $thisurl;?>',{action:'ajax_change_carval',type:alt,val:val,gid:id,kk:kk},function(){});
});
$('.postdata').live('keyup',function(){
	alt = $(this).attr('name');
	val = $(this).val();
	id = $(this).attr('alt');
	kk = $(this).attr('id');
	$.post('<?php echo $thisurl;?>',{action:'ajax_change_carval',type:alt,val:val,gid:id,kk:kk},function(){});
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
	t = false;
	//姓名
	$("input[name='consignee']").each(function(){
		v = $(this).val();
		if(v==""){
			alert("收货名称是必填的");
			t = true;
			return false;
		}
	});
	//电话
	$("input[name='moblie']").each(function(){
		v = $(this).val();
		if(v==""){
			alert("电话是必填的");
			t = true;
			return false;
		}
	});
	//收货地址
	$("input[name='address']").each(function(){
		v = $(this).val();
		if(v==""){
			alert("收货地址是必填的");
			t = true;
			return false;
		}
	});
	if(t==true) return false;
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
