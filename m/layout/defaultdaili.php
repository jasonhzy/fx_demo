<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title><?php echo $this->title();?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Page-Enter" content="blendTrans(Duration=0.5)" /> 
<meta http-equiv="Page-Exit" content="blendTrans(Duration=0.5)" /><?php echo $this->meta();?>
<?php echo $this->css(array('comman.css?v=2','jquery_dialog.css','style.css?v=12'));?>
<?php echo '<script> var SITE_URL="'.ADMIN_URL.'";</script>'."\n";?>
<?php echo $this->js(array('jquery.min.js','jquery_dialog.js','common.js'));?>
</head>
<body>
<?php $this->element('topdaili',array('lang'=>$lang,'keyword'=>$keyword)); ?>
<?php echo $this->content();?>
<?php $this->element('footerdaili',array('lang'=>$lang)); ?>
</body>
</html>
