<!--优先执行的文件，可以作为网站的框架使用-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->title();?></title>
<?php echo $this->meta();?>
<?php echo $this->css(array('style.css'));?>
<?php echo $this->js(array('jquery1.6.js','common.js'));?>
</head>
<body>
<div class="main">
<div class="maincontent">
	<?php echo $this->content();?>
</div>
</div>
</body>
</html>
