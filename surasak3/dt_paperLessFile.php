<?php 
require_once 'bootstrap.php';
define(paperHost,'http://192.168.129.143/shsPaperLess/');
$hn = sprintf("%s", $_GET['hn']);
$id = sprintf("%s", $_GET['id']);
$file = sprintf("%s", $_GET['file']);
?>
<iframe src="<?=paperHost.$file;?>" style="width:100%; height:100%;" frameborder="0">กรุณาติดตั้ง Adobe PDF Reader ก่อนใช้งาน</iframe>