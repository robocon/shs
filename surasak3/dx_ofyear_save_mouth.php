<?php
session_start();
include("connect.inc");
$daten = (date("Y")+543).date("-m-d H:i:s");

$sqlrun = "select prefix from runno where title='y_chekup' ";
$rowrun = mysql_query($sqlrun);
list($prefix) = mysql_fetch_array($rowrun);
$prefix="25".$prefix;

$sql ="insert into chk_mouth (date,hn,ptname,age,stat,advice1,advice2,stat2,advice3,advice4,stat3,advice5,advice6,stat4,advice7,advice8,advice9,advice10,yearchk) value('$daten','$hn','$ptname','$age','$mouth1','$advice1','$advice2','$mouth2','$advice3','$advice4','$mouth3','$advice5','$advice6','$mouth4','$advice7','$advice8','$advice9','$advice10','$prefix')";

$result = mysql_query($sql);
if($result){
	echo "บันทึกข้อมูลเรียบร้อยแล้วคะ";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=dx_ofyear_mouth.php\">";
}
?>