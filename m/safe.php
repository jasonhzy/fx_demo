<?php
require_once("load.php");
$act = isset($_POST['action']) ? $_POST['action'] : "";
if(!empty($act)){
	$app->action('safe',$act,$_POST);
	exit;
}

$f = isset($_GET['f'])&&!empty($_GET['f']) ? trim($_GET['f']) : 'index';
$app->action('safe',$f,$_GET);
?>