<?php
$thisurl = ADMIN_URL.'con_default.php'; 
if(isset($_GET['asc'])){
$cate = $thisurl.'?type=newlist&desc=tb2.cat_name';
$article_title = $thisurl.'?type=newlist&desc=tb1.article_title';
$viewcount = $thisurl.'?type=newlist&desc=tb1.viewcount';
$is_show = $thisurl.'?type=newlist&desc=tb1.is_show';
$is_nav = $thisurl.'?type=newlist&desc=tb1.show_in_nav';
$addtime = $thisurl.'?type=newlist&desc=tb1.addtime';
$vieworder = $thisurl.'?type=newlist&desc=tb1.vieworder';
}else{
$cate = $thisurl.'?type=newlist&asc=tb2.cat_name';
$article_title = $thisurl.'?type=newlist&asc=tb1.article_title';
$viewcount = $thisurl.'?type=newlist&asc=tb1.viewcount';
$is_show = $thisurl.'?type=newlist&asc=tb1.is_show';
$is_nav = $thisurl.'?type=newlist&asc=tb1.show_in_nav';
$addtime = $thisurl.'?type=newlist&asc=tb1.addtime';
$vieworder = $thisurl.'?type=newlist&asc=tb1.vieworder';
}
?>

<div class="contentbox">
     <table cellspacing="2" cellpadding="5" width="100%">
	 <tr>
		<th colspan="8" align="left">用户晒单</th>
	</tr>
    <tr>
	   <th width="60"><label><input type="checkbox" class="quxuanall" value="checkbox" />选择</label></th>
	   <th><a href="<?php echo $cate;?>">所在分类</a></th>
	   <th><a href="<?php echo $article_title;?>">标题</a></th>
	   <th><a href="<?php echo $viewcount;?>">浏览</a></th>
	   <th><a href="<?php echo $is_show;?>">状态</a></th>
<!--	   <th><a href="<?php echo $is_nav;?>">是否显示在导航栏</a></th>-->
	   <th><a href="<?php echo $addtime;?>">录入时间</a></th>
	   <th width="35"><a href="<?php echo $vieworder;?>">排序</a></th>
		<th>操作</th>
	</tr>
	<?php 
	if(!empty($newlist)){ 
	foreach($newlist as $row){
	?>
	<tr>
	<td><input type="checkbox" name="quanxuan" value="<?php echo $row['article_id'];?>" class="gids"/></td>
	<td><?php echo $row['cat_name'];?></td>
	<td><?php echo $row['article_title'];?></td>
	<td><?php echo $row['viewcount'];?></td>
	<td><img src="<?php echo $this->img($row['is_show']==1 ? 'yes.gif' : 'no.gif');?>" alt="<?php echo $row['is_show']==1 ? '0' : '1';?>" class="activeop" lang="is_show" id="<?php echo $row['article_id'];?>"/></td>
<!--	<td><img src="<?php echo $this->img($row['show_in_nav']==1 ? 'yes.gif' : 'no.gif');?>" alt="<?php echo $row['show_in_nav']==1 ? '0' : '1';?>" class="activeop" lang="show_in_nav" id="<?php echo $row['article_id'];?>"/></td>
-->  	<td><?php echo !empty($row['addtime']) ? date('Y-m-d',$row['addtime']) : "无知";?></td>
  	<td><span class="vieworder" id="<?php echo $row['article_id'];?>"><?php echo $row['vieworder'];?></span></td>
	<td>
	<a href="con_default.php?type=newedit&id=<?php echo $row['article_id'];?>" title="编辑"><img src="<?php echo $this->img('icon_edit.gif');?>" title="编辑"/></a>&nbsp;
	<img src="<?php echo $this->img('icon_drop.gif');?>" title="删除" alt="删除" id="<?php echo $row['article_id'];?>" class="delarticleid"/>
	</td>
	</tr>
	<?php
	 } ?>
	<tr>
		 <td colspan="8"> <input type="checkbox" class="quxuanall" value="checkbox" />
			  <input type="button" name="button" value="批量删除" disabled="disabled" class="bathdel" id="bathdel"/>
		 </td>
	</tr>
		<?php } ?>
	 </table>
	 <?php $this->element('page',array('pagelink'=>$pagelink));?>
</div>
<?php  $thisurl = ADMIN_URL.'con_default.php'; ?>
<script type="text/javascript">
//全选
 $('.quxuanall').click(function (){
      if(this.checked==true){
         $("input[name='quanxuan']").each(function(){this.checked=true;});
		 document.getElementById("bathdel").disabled = false;
	  }else{
	     $("input[name='quanxuan']").each(function(){this.checked=false;});
		 document.getElementById("bathdel").disabled = true;
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
  });
  
  //批量删除
   $('.bathdel').click(function (){
   		if(confirm("确定删除吗？")){
			createwindow();
			var arr = [];
			$('input[name="quanxuan"]:checked').each(function(){
				arr.push($(this).val());
			});
			var str=arr.join('+'); ;
			$.post('<?php echo $thisurl;?>',{action:'delarticle',ids:str},function(data){
				removewindow();
				if(data == ""){
					location.reload();
				}else{
					alert(data);
				}
			});
		}else{
			return false;
		}
   });
   
   $('.delarticleid').click(function(){
   		ids = $(this).attr('id');
		thisobj = $(this).parent().parent();
		if(confirm("确定删除吗？")){
			createwindow();
			$.post('<?php echo $thisurl;?>',{action:'delarticle',ids:ids},function(data){
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
		cid = $(this).attr('id'); 
		type = $(this).attr('lang');
		obj = $(this);
		$.post('<?php echo $thisurl;?>',{action:'alt_activeop',active:star,cid:cid,type:type},function(data){
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
	
	$('.vieworder').click(function (){ edit(this); });
	
	function edit(object){
		thisvar = $(object).html();
		ids = $(object).attr('id');
		if(!(thisvar>0)){
			thisvar = 50;
		}
		//$(object).css('background-color','#FFFFFF');
		 if(typeof($(object).find('input').val()) == 'undefined'){
             var input = document.createElement('input');
			 $(input).attr('value', thisvar);
			 $(input).css('width', '25px');
             $(input).change(function(){
                 update(ids, this)
             })
             $(input).blur(function(){
                 $(this).parent().html($(this).val());
             });
             $(object).html(input);
             $(object).find('input').focus();
         }
	}
	
	function update(id, object){
       var editval = $(object).val();
       var obj = $(object).parent();
	   $.post('<?php echo $thisurl;?>',{action:'vieworder',id:id,val:editval},function(data){ 
			 obj.html(editval);
           	 $(object).unbind('click');
           	 $(object).click(function(){
               edit(object);
             })
		});
    }
</script>