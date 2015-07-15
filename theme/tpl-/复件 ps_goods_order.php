<div id="wrap">
	<div class="clear7"></div>
	<?php $this->element('user_menu');?>
    <div class="contentbox m_right">
    	 <h2 class="con_title" style="text-align:left">我的用户订单配送商品</h2>
		 <div class="right_top">
		 <table cellspacing="2" cellpadding="5" width="100%">
	<tr>
		<th colspan="8" align="left">
			选择时间：<input type="text" id="EntTime1" name="EntTime1" onclick="return showCalendar('EntTime1', 'y-mm-dd');"  />
			至
					<input type="text" id="EntTime2" name="EntTime2" onclick="return showCalendar('EntTime2', 'y-mm-dd');"  />
		</th>
	</tr>
	<tr><th colspan="8" align="left">
    	<img src="<?php echo $this->img('icon_search.gif');?>" alt="SEARCH" width="26" border="0" height="22" align="absmiddle">
	   供应商<select name="uid">
		<option value="">--选择供应商--</option>
		 <?php 
		if(!empty($uidlist)){
		 foreach($uidlist as $row){ 
		?>
        <option value="<?php echo $row['user_id'];?>" <?php if(isset($row['user_id'])&&$_GET['uid']==$row['user_id']){ echo 'selected="selected""'; } ?>><?php echo $row['user_name'].(!empty($row['nickname']) ? '&nbsp;&nbsp;['.$row['nickname'].']' : "");?></option>
		<?php
		 }//end foreach
		} ?>
     </select>
		
		
		订单号<input name="order_sn"  size="15" type="text" value="<?php echo isset($_GET['order_sn']) ? $_GET['order_sn'] : "";?>">
		收货人<input name="consignee"  size="15" type="text" value="<?php echo isset($_GET['consignee']) ? $_GET['consignee'] : "";?>">
		订单状态 
		<?php 
		$status_option[-1] = '请选择';
		$status_option[11] = '待确认';
		$status_option[200] = '待付款';
		$status_option[210] = '待发货';
		$status_option[222] = '已发货';
		$status_option[214] = '已完成';
		$status_option[1] = '取消';
		$status_option[4] = '无效';
		$status_option[3] = '退货';
		$status_option[2] = '退款';
		?>  
		 <select name="status" >
		 <!--2:确认订单 0:没支付 0:没发货-->
	        <?php 
			$se = 'selected="selected"';
			foreach($status_option as $k=>$var){
				echo '<option value="'.$k.'" '.($k==$_GET['status']&&isset($_GET['status']) ? $se : "").'>'.$var.'</option>';
			}
			?>
		  </select>
		<input value=" 搜索 " class="order_search" type="button">
	</th></tr>
    <tr>
	   <th width="80"><label><input type="checkbox" class="quxuanall" value="checkbox" />选择</label></th>
	   <th>商品编号</th>
	   <th>商品名称</th>
	   <th>商品数量</th>
	   <th>供应商</th>
	   <th>供应总价</th>
	   <th>批发总价</th>
	   <th>商品详情</th>
	</tr>
	
<!---- 开始  ------------------------------->
	<?php 
	if(!empty($orderlist)){ 
	foreach($orderlist as $row){
	?>
	<tr>
	<td><input type="checkbox" name="quanxuan" value="<?php echo $row['order_id'];?>" class="gids"/></td>
	<td><?php echo $row['goods_bianhao'];?></td>
	<td><?php echo $row['goods_name'];?></td>
	<td><?php echo $row['numb'];?></td>
	
	<td><?php echo $row['user_name'];?></td>
	<td >￥<b style="color:#FF0000"><?php echo $row['numb']*$row['market_price'];?></b></td>
	<td >￥<b style="color:#FF0000"><?php echo $row['numb']*$row['pifa_price'];?></b></td>
	<td>
	<a href="<?php echo SITE_URL;?>suppliers.php?act=suppliers_goods_info&id=<?php echo $row['goods_id'];?>&t=<?php echo $t;?>" title="商品详情"><img src="<?php echo $this->img('icon_view.gif');?>" title="商品详情"/></a>&nbsp;

	</td>
	</tr>
	<?php
	 } ?>
	<tr>
		<td style="border:hidden"></td>
		<td style="border:hidden"></td>
		<td style="border:hidden "></td>	
		 <td style="border:hidden">   </td>
		 <td style="border:hidden" align="right"><b></b></td>
		 <td style="border:hidden">    </td>
		 <td style="border:hidden"></td>
	</tr>
		<?php } ?>
	 </table>
	  <?php $this->element('page',array('pagelink'=>$pagelink));?>
		 </div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear7"></div>
<?php
	$thisurl = SITE_URL.'store.php';
?>

<script type="text/javascript">
//全选
 $('.quxuanall').click(function (){
      if(this.checked==true){
         $("input[name='quanxuan']").each(function(){this.checked=true;});
		 document.getElementById("bathdel").disabled = false;
		 document.getElementById("bathinvalid").disabled = false;
		 document.getElementById("bathcancel").disabled = false;
		 document.getElementById("bathconfirm").disabled = false;
	  }else{
	     $("input[name='quanxuan']").each(function(){this.checked=false;});
		 document.getElementById("bathdel").disabled = true;
		 document.getElementById("bathinvalid").disabled = true;
		 document.getElementById("bathcancel").disabled = true;
		 document.getElementById("bathconfirm").disabled = true;
	  }
  });
  
  //是删除按钮失效或者有效
  $('.gids').click(function(){ 
  		var checked = false;
  		$("input[name='quanxuan']").each(function(){
			if(this.checked == true){
				checked = true;
			}
		}); 
		document.getElementById("bathdel").disabled = !checked;
		document.getElementById("bathconfirm").disabled = !checked;
		document.getElementById("bathcancel").disabled = !checked;
		document.getElementById("bathinvalid").disabled = !checked;
  });
  
  //批量删除
   $('.bathop').click(function (){
   		if(confirm("确定操作吗？")){
			optype = $(this).attr('id');
			if(typeof(optype)=='undefined' || optype==""){ return false;}
			createwindow();
			var arr = [];
			$('input[name="quanxuan"]:checked').each(function(){
				arr.push($(this).val());
			});
			var str=arr.join('+'); ;
			$.post('<?php echo $thisurl;?>',{action:'bathop',type:optype,ids:str},function(data){
				removewindow();
				if(data == ""){
					location.reload();
				}else{
					alert(data);
					//location.reload();
				}
			});
		}else{
			return false;
		}
   });
 
   $('.delorder').click(function(){
   		ids = $(this).attr('id');
		thisobj = $(this).parent().parent();
		if(confirm("确定删除吗？")){
			createwindow();
			$.post('<?php echo $thisurl;?>',{action:'bathop',type:'bathdel',ids:ids},function(data){
				removewindow();
				if(data == ""){
					thisobj.hide(300);
				}else{
					alert(data);	
				}
			});
		}else{
			return false;	
		}
   });
   
   	$('.activeop').live('click',function(){
		star = $(this).attr('alt');
		gid = $(this).attr('id'); 
		type = $(this).attr('lang');
		obj = $(this);
		$.post('<?php echo $thisurl;?>',{action:'activeop',active:star,gid:gid,type:type},function(data){
			if(data == ""){
				if(star == 1){
					id = 0;
					src = '<?php echo $this->img('yes.gif');?>';
				}else{
					id = 1;
					src = '<?php echo $this->img('no.gif');?>';
				}
				obj.attr('src',src);
				obj.attr('alt',id);
			}else{
				alert(data);
			}
		});
	});
	
	//sous
	$('.order_search').click(function(){
		time1 = $('input[name="EntTime1"]').val();  //look 添加
		
		time2 = $('input[name="EntTime2"]').val();	//look 添加
		
		gys_id = $('select[name="uid"]').val();  // look添加
		
		o_sn = $('input[name="order_sn"]').val();
		
		own = $('input[name="consignee"]').val();
		
		sts = $('select[name="status"]').val();
		
		
		
		location.href='<?php echo $thisurl;?>?act=product_goods_order&add_time1='+time1+'&add_time2='+time2+'&psid='+<?php echo $rank = $this->Session->read('User.uid');  ?>+'&uid='+gys_id+'&order_sn='+o_sn+'&consignee='+own+'&status='+sts;
	});
</script>