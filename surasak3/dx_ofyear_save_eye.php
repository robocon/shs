<?php
session_start();
include("connect.inc");
$daten = (date("Y")+543).date("-m-d H:i:s");

$sqlrun = "select prefix from runno where title='y_chekup' ";
$rowrun = mysql_query($sqlrun);
list($prefix) = mysql_fetch_array($rowrun);
$prefix="25".$prefix;

$eye1_ext = $_POST['eye1_ext'];

$sql ="insert into chk_eye (date,hn,ptname,age,stat_eye,yearchk,eye1_ext) value('$daten','$hn','$ptname','$age','$eye1','$prefix','$eye1_ext')";

$result = mysql_query($sql) or die( mysql_error() );
if($result){
	echo "บันทึกข้อมูลเรียบร้อยแล้วคะ";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=dx_ofyear_eye.php\">";
}
?>