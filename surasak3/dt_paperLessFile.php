<?php 
require_once 'includes/connectPaperLess.php';
$hn = $_GET['hn'];
$id = $_GET['id'];
$file = $_GET['file'];
?>
<iframe src="<?=paperHost.$file;?>" style="width:100%; height:100%;" frameborder="0">กรุณาติดตั้ง Adobe PDF Reader ก่อนใช้งาน</iframe>