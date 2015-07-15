<style type="text/css">
#main li:hover{ background:#ededed}
</style>
<div id="main" style=" min-height:200px;margin-bottom:20px;">
<ul>
<?php if(!empty($rt['ulist']))foreach($rt['ulist'] as $k=>$row){?>
	<li style="padding:5px; border-bottom:1px solid #d8d8d8; position:relative">
		<a href="javascript:void(0)" style="display:block">
		<div style="position:relative; width:20%;float:left;"><img src="<?php echo !empty($row['headimgurl']) ? $row['headimgurl'] : $this->img('noavatar_big.jpg');?>" width="100%" style="margin-right:5px; padding:1px; border:1px solid #fafafa" />
		<?php if($row['is_subscribe']=='1'){?><img src="<?php echo $this->img('dui2.png');?>" style="position:absolute; bottom:5px; right:-2px; z-index:7" /><?php } ?>
		</div>
		<div style="float:right; width:78%;">
		<p style="line-height:23px"><?php echo $row['nickname'];?>&nbsp;&nbsp;<?php echo !empty($row['subscribe_time']) ? date('Y-m-d H:i:s',$row['subscribe_time']) : date('Y-m-d H:i:s',$row['reg_time']);?></p>
		<p style="line-height:23px">资金&nbsp;<font color="#FF0000">￥<?php echo $row['money_ucount'];?></font>&nbsp;|&nbsp;邀请&nbsp;<font color="#FF0000"><?php echo $row['share_ucount'];?></font></p>
		</div>
		<div class="clear"></div>
		</a>
		<?php if($k<3){
		$s = $k==0 ? 'mmexport1417022423647.png' : ($k==1?'mmexport1417022426972.png':'mmexport1417022429974.png')
		?>
		<img src="<?php echo $this->img('icon/'.$s);?>" height="40" style=" position:absolute; right:5px; top:8px; z-index:99" />
		<?php } else{?>
		<span style="border-radius:50%; padding:3px;float:right; display:block;background:#B70000; text-align:center; font-size:12px; font-weight:bold; color:#FFF; cursor:pointer; position:absolute;right:5px; top:17px; z-index:99" id="62"><i style="font-style:normal"><?php echo ++$k;?></i></span>
		<?php } ?>
	</li>
<?php } ?>
</ul>
	<style type="text/css">
	.pagesmoney a{ display:block; line-height:20px;margin-right:5px; color:#222; background-color:#ededed; border-bottom:2px solid #ccc; border-right:2px solid #ccc; text-decoration:none; float:left; padding-left:5px; padding-right:5px; text-align:center}
	.pagesmoney a:hover{ text-decoration:underline}
	</style>

	<div class="clear10"></div>
	<div class="pagesmoney">
	<?php
	if(!empty($rt['pages'])){
	echo $rt['pages']['previ'];?>
	<?php
	 if(isset($rt['pages']['list'])&&!empty($rt['pages']['list'])){
	 foreach($rt['pages']['list'] as $aa){
	 echo $aa."\n";
	 }
	 }
	?>
	<?php echo $rt['pages']['next'];
	}
	?>
	</div>
</div>