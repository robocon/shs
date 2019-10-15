<?php
session_start();
include("connect.inc");
$daten = (date("Y")+543).date("-m-d H:i:s");

$sqlrun = "select prefix from runno where title='y_chekup' ";
$rowrun = mysql_query($sqlrun);
list($prefix) = mysql_fetch_array($rowrun);
$prefix="25".$prefix;

$eye1_ext = $_POST['eye1_ext'];
$eye2_ext = $_POST['eye2_ext'];

$hn = $_POST['hn'];

$sql = "SELECT * 
FROM `chk_eye` 
WHERE `yearchk` = '$prefix' 
AND `hn` = '$hn' ";
$q = mysql_query($sql) or die( mysql_error() );
$user_rows = mysql_num_rows($q);
if ( $user_rows > 0 ) {
	echo 'ข้อมูลซ้ำในระบบในรอบปีงบประมาณ'.$prefix.'<br>';
	echo '<a href="dx_ofyear_eye.php">คลิกที่นี่เพื่อกลับไปหน้าเดิม</a>';
	exit;
}

$sql = "INSERT INTO `chk_eye` (`date`,`hn`,`ptname`,`age`,`stat_eye`,`yearchk`,`eye1_ext`,`eye2_ext`) 
value 
('$daten','$hn','$ptname','$age','$eye1','$prefix','$eye1_ext','$eye2_ext')";
$result = mysql_query($sql) or die( mysql_error() );
if($result){
	echo "บันทึกข้อมูลเรียบร้อยแล้วคะ";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=dx_ofyear_eye.php\">";
}
?>