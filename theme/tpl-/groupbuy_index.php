<div class="groupmain">
	<div class="groupmainbox">
		 <?php $this->element('ajax_groupbuy',array('rt'=>$rt));?>
	</div>
</div>

<?php $thisurl = SITE_URL.'groupbuy.php';?>
<script language="javascript" type="text/javascript">
function get_groupbuy_page_list(page){ 
		createwindow();

   		$.post('<?php echo $thisurl;?>',{action:'ajaxgroupbuy',page:page,type:'ajax'},function(data){

			removewindow();

			if(data !=""){

				$('.groupmainbox').html(data);

			}

		});

}
</script>
