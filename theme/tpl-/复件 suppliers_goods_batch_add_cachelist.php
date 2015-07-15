<style type="text/css">
#wrap table img{ cursor:pointer}
#wrap table ul li{ float:left; list-style-type:none; border:1px dotted #ccc; width:245px; text-align:center; margin-right:5px;margin-top:5px; padding:3px; position:relative;}
#wrap table ul li .tab{ position:absolute; left:0x; top:0px; display:none; border:3px solid #ededed; background-color:#fafafa; z-index:1}
#wrap table ul li img{ max-width:150px;}
#wrap table ul p.p1{ text-align:center; height:200px; overflow:hidden; position:relative}
#wrap table ul p.p1 .edit{ position:absolute; right:0px; top:0px; border:1px solid #ccc}
#wrap table ul p.p2{ text-align:left;}
#wrap table ul p input{ font-size:10px;}
</style>
<?php  $thisurl = SITE_URL.'suppliers.php'; ?>

<div id="wrap">
	<div class="clear7"></div>
    	<?php $this->element('user_menu');?>
    <div class="m_right" >
		<h2 class="con_title">批量添加商品</h2>
		 <table cellspacing="2" cellpadding="5" width="100%">
		<?php 
		if(!empty($photolist)){ 
		?>
		<tr>
		<td>
		<h3 style="font-size:15px;  margin-bottom:0px; background-color:#EEF2F5; margin-top:0px; height:35px; line-height:35px; padding-left:5px;">每条信息</h3>
		<ul>
		<?php  
			foreach($photolist as $k=>$row){
			$k++;
		?>
		<li>
		<p class="p1"><img src="<?php echo $row['url'];?>" alt="<?php echo $row['filename'];?>" onload="if(this.height>this.width){this.height=180;}else{this.width=180;}"/><span class="edit"><img src="<?php echo $this->img('icon_edit.gif');?>" onclick="showbox('tab<?php echo $k;?>',this)"/></span></p>
		<p class="p2">
		<input  type="hidden" name="sourcepathname" value="<?php echo $row['pathname'];?>"/>
		<input  type="hidden" name="uploadname" value="<?php echo $row['uploadname'];?>"/>
		<input  type="hidden" name="items" value="item<?php echo $k;?>"/>
		名称：<input  type="text" name="filename" value="<?php echo $row['filename'];?>" size="34"/><br />
		供应价：<input  type="text" name="price" value="" size="32"/><br />
		出售价：<input  type="text" name="vipprice" value="" size="32"/>
		</p>
		<table cellspacing="2" cellpadding="4" width="100%" id="tab<?php echo $k;?>" class="tab">
		<tr>
			<td align="left"><strong>商品相册</strong><em>点击+增加，点击-号移除</em></td>
		</tr>
		<tr>
			<td align="left">
			<a href="javascript:;" class="addgallery">[+]</a>图片描述:
			<input type="text" name="photo_gallery_desc" size="34" value="" lang="item<?php echo $k;?>"/><br />
			<input type="hidden" name="photo_gallery_url" id="goodsgallery<?php echo $k;?>" value="" lang="item<?php echo $k;?>"/>
			<iframe id="iframe_t" name="iframe_t" border="0" src="<?php echo SITE_URL;?>upload.php?action=&ty=goodsgallery<?php echo $k;?>&tyy=goods&files=" scrolling="no" width="370" frameborder="0" height="25"></iframe>
			</td>
		</tr>
		<tr>
			<td align="right"><img src="<?php echo $this->img('error_icon.png');?>" onclick="hidebox('tab<?php echo $k;?>')"/></td>
		</tr>
		</table>
		</li>
		
		<?php } ?>
		</ul>
		</td>
		</tr>
		<tr>
		  <td>
		<input type="button" name="button" class="uploadimg" value="确定上传" style="padding:4px; cursor:pointer"/>&nbsp;&nbsp;
		<input type="button" name="button"  onclick="if(confirm('确定删除吗')){location.href='<?php echo $thisurl;?>?act=suppliers_goods_batch_add'; return false;}" value="确定取消" style="padding:4px;cursor:pointer"/>
		</td>
		</tr>
		<?php }else{ ?>
		<tr>
			 <td align="center">
				  <h1 style="color:#FF0000">相册数据为空！请先<a href="<?php echo SITE_URL.'suppliers.php?act=suppliers_goods_batch_add'?>">添加</a>！</h1>
			 </td>
		</tr>
		<?php } ?>
		 </table>
     </div>
    <div class="clear"></div>
</div>
<div class="clear7"></div>

<script type="text/javascript"> 
	function changeprice(obj){
		pric = $(obj).val();
		$('input[name="price"]').each(function(){
			$(this).val(pric);
		});
	}
	
	function changevipprice(obj){
		pric = $(obj).val();
		$('input[name="vipprice"]').each(function(){
			$(this).val(pric);
		});
	}
	
	 $('.uploadimg').click(function (){
	 	//cid = document.uploadForm.cateid.value; //获取选择的分类
		//bid = document.uploadForm.bandid.value;;  // 选择的品牌ID
		cid = $('.cateid').val();
		bid = $('.bandid').val();
		//bid = 0;
		if(typeof(cid)=='undefined' || cid==0){ alert('请先选择分类！'); return false;};
		//if(typeof(bid)=='undefined' || bid==0){ alert('请先选择品牌！'); return false;};
		
		createwindow();
		
	 	var pathname = [];
	    $('input[name="sourcepathname"]').each(function(){
			pathname.push($(this).val());
		});
		var str_pathname=pathname.join('++'); 

		var uploadname = [];
	    $('input[name="uploadname"]').each(function(){
			uploadname.push($(this).val());
		});
		var str_uploadname=uploadname.join('++'); 
		
		var filename = [];
	    $('input[name="filename"]').each(function(){
			filename.push($(this).val());
		});
		var str_filename=filename.join('++'); 
		
		var price = [];
	    $('input[name="price"]').each(function(){
			price.push($(this).val());
		});
		var str_price=price.join('++'); 
		
		var vipprice = [];
	    $('input[name="vipprice"]').each(function(){
			vipprice.push($(this).val());
		});
		var str_vipprice=vipprice.join('++'); 
		
		var items = [];
	    $('input[name="items"]').each(function(){
			items.push($(this).val());
		});
		var str_items=items.join('++'); 
		
		//图片相册
		var myGallery = Object();
		var aa=[];
		var bb=[];
		var cc=[];
		//var dd=[];
	    $('input[name="photo_gallery_desc"]').each(function(){
			 aa.push($(this).val());
			 bb.push($(this).attr('lang'));
		});
		$('input[name="photo_gallery_url"]').each(function(){
			 cc.push($(this).val());
			// dd.push($(this).attr('lang'));
		}); 
		myGallery['photo_gallery_desc'] = aa.join('++');
		myGallery['photo_gallery_item_id'] = bb.join('++');
		myGallery['photo_gallery_url'] = cc.join('++');
		//myGallery['photo_gallery_url_id'] = dd.join('++');
		//图片相册
		var spec = new Array();
		spec = getSelectedAttributes(); //获取表单元素
		var str_spec = spec.join('++');
		obj = $(this);
		obj.attr('disabled',true);

		$.post('<?php echo $thisurl;?>',{action:'ajax_upload',pathname:str_pathname,uploadname:str_uploadname,filename:str_filename,price:str_price,vipprice:str_vipprice,cid:cid,bid:bid,str_spec:str_spec,items:str_items,mygallery:$.toJSON(myGallery)},function(data){ 
			removewindow();
			if(data == ""){
				location.href='<?php echo $thisurl;?>?type=goods_list';
				return false;
			}else{
				alert(data);
				obj.attr('disabled',false);
			}
		});
	 });
	 
	 //自动获取表单属性
	function getSelectedAttributes()
	{
		 var formBuy      = document.forms['GOODSATTR']; //表单
		  var spec_arr = new Array();
		  var j = 0;
		
		  for (i = 0; i < formBuy.elements.length; i ++ )
		  {
			if(((formBuy.elements[i].type == 'radio' || formBuy.elements[i].type == 'checkbox') && formBuy.elements[i].checked) || formBuy.elements[i].tagName == 'SELECT' ||  formBuy.elements[i].type == 'hidden' || formBuy.elements[i].type == 'text')
			{
			  spec_arr[j] = formBuy.elements[i].name+'---'+formBuy.elements[i].value;
			  j++ ;
			}
			  
		  }
		  return spec_arr;
	}
	/*增加控件*/
	$('.addaddi').live('click',function(){
		var upvar = $(this).parent().parent().find('.select').val();
		if(upvar=="" || typeof(upvar)=='undefined'){ alert("请先选择"); return false; }
		str = $(this).parent().parent().html();
		str = str.replace('addaddi','removeaddi');
		str= str.replace('[+]','[-]');
		$(this).parent().parent().after('<tr>'+str+'</tr>');
	});
	/*删除控件*/
	$('.removeaddi').live('click',function(){
		$(this).parent().parent().remove();
		return false;
	});
	
	
	function showbox(objname,thisobj){ 
		//obj =  $(thisobj).parent().parent().parent().find('#'+objname);
		createwindow();
		var obj = document.getElementById(objname);
		$(obj).show(200);
		removewindow();
	}
	
	function hidebox(objname){
		var obj = document.getElementById(objname);
		$(obj).hide(200);
	}
	
	/*增加相册控件*/
	$('.addgallery').live('click',function(){
		rand = generateMixed(4);
		str = $(this).parent().parent().html();
		str = str.replace('addgallery','removegallery');
		str = str.replace('[+]','[-]');
		str = str.replace(/goodsgallery/g,'goodsgallery'+rand); //正则表达式替换多个
		str = str.replace(/value="(.*)" lang=/g,'value="" lang='); 
		$(this).parent().parent().after('<tr>'+str+'</tr>');
	});
	/*删除相册控件*/
	$('.removegallery').live('click',function(){
		$(this).parent().parent().remove();
		return false;
	});
	
	//产生随机数
	function generateMixed(n) {
		var chars = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
		var res = "";
		for(var i = 0; i < n ; i ++) {
			var id = Math.ceil(Math.random()*35);
			res += chars[id];
		}
		return res;
	}
</script>
