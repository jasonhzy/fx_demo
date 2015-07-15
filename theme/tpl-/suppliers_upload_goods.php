<div id="wrap">
	<div class="clear7"></div>
    <?php $this->element('user_menu');?>
    <div class="m_right">
		<h2 class="con_title">上传商品</h2>
		<div style="padding:10px; margin:10px 0px 10px 0px; background-color:#EFEFEF; border:1px solid #ccc">
			<p style="color:#FF0000"><br />
			说明：请先把图片上传到空间，然后通过以下方式上传商品。<br /><br />
			注意：<br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;保证路径的正确性才能上传！如果文件路径不存在，请手动创建文件夹后上传图片文件。<br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;同一供应商，相同商品编号不允许再次上传！<br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;同一供应商，如果商品编号为空，相同商品名称相同不能再次上传！<br />
			</p>
		</div>
		
		<div style="padding:10px; margin:10px 0px 10px 0px; background-color:#EFEFEF; border:1px solid #ccc">
			<h4>第一步：下载商品Excel文件</h4>
			<div style="height:30px; margin-top:10px;line-height:30px;width:100px; background-color:#e2e8eb; border-bottom:3px solid #bec6ce; border-right:3px solid #bec6ce; text-align:center; cursor:pointer" onclick="location.href='<?php echo SITE_URL;?>suppliers.php?act=download_tpl';return false;">马上下载</div>
		</div>
		
		<div style="padding:10px; margin:10px 0px 10px 0px;background-color:#EFEFEF; border:1px solid #ccc">
			<h4>第二步：填写CSV文件</h4>
			<div style="height:30px;margin-top:10px; line-height:30px;width:400px; background-color:#e2e8eb; border-bottom:3px solid #bec6ce; border-right:3px solid #bec6ce; text-align:left; padding-left:10px">打开Excel文件，在里面对应写入上传商品的内容。</div>
		</div>
		
		<div style="padding:10px; margin:10px 0px 10px 0px;background-color:#EFEFEF; border:1px solid #ccc">
			<h4>第三步：上传填写好的Excel文件</h4>
			<div style="height:60px; margin-top:10px;line-height:20px;width:500px; background-color:#e2e8eb; border-bottom:3px solid #bec6ce; border-right:3px solid #bec6ce; text-align:left; padding-left:10px"><br />
			<input name="upload_file" id="upload_file" type="hidden" value="" size="43"/>
			<iframe id="iframe_t" name="iframe_t" border="0" src="<?php echo SITE_URL;?>uploadfile.php?action=&ty=upload_file&tyy=excle&files=" scrolling="no" width="445" frameborder="0" height="25"></iframe>
			</div>
		</div>
     </div>
    <div class="clear"></div>
  </div>
  <div class="clear7"></div>