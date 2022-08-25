<?php
session_start();
include 'includes/config.php';

$dbi = new mysqli(HOST,USER,PASS,DB);

if(isset($_GET['cPtname'])){
	$cPtname=$_GET['cPtname'];
	$cHn=$_GET['cHn'];
	$cIdcard=$_GET['cIdcard'];
	$cPtright1=$_GET['cPtright1'];
}

if(!empty($_GET['cHn'])){
$hn = $_GET['cHn'];
}

if(!empty($_GET['hn'])){
$hn = $_GET['hn'];
}

$sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`, `hn`,`idcard`,`ptright1`,`hphone`,`phone` FROM `opcard` WHERE `hn` = '$hn' ";
//echo $sql;
$dbi->query("SET CHARACTER SET utf8 ");
$q = $dbi->query($sql);
$item = $q->fetch_assoc();

$cPtname = $item['ptname'];
$cHn = $item['hn'];
$cIdcard = $item['idcard'];
$cPtright1 = $item['ptright1'];
$hphone = $item['hphone'];
$phone = $item['phone'];

?>
<style type="text/css">
.font1 {
	font-family: AngsanaUPC;
	font-size:26px;
}
</style>

<span class="font1">ใบตรวจสอบสิทธิ<br />
ชื่อ :<?=$cPtname;?> <br />
<?=$cHn?>&nbsp;&nbsp;<strong>
<?=$cIdcard?>
</strong><br />
สิทธิ : <?=$cPtright1?><br />
........................... ผู้ตรวจสอบ<br />
เบอร์บ้าน : <?=$hphone;?><br />
มือถือ : <?=$phone;?>
</span>
<script>
window.print() ;
</script>