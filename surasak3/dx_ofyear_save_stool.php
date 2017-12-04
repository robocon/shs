<?php
session_start();
include("connect.inc");
$daten = (date("Y")+543).date("-m-d H:i:s");

$sqlrun = "select prefix from runno where title='y_chekup' ";
$rowrun = mysql_query($sqlrun);
list($prefix) = mysql_fetch_array($rowrun);
$prefix="25".$prefix;

$sql ="insert into chk_stool (date,hn,ptname,age,colour,consis,rbc,wbc,ova,concentrated,blood,yearchk) value('$daten','$hn','$ptname','$age','$colour','$consis','$rbc','$wbc','$ova','$concen','$blood','$prefix')";

$result = mysql_query($sql);
if($result){
	echo "บันทึกข้อมูลเรียบร้อยแล้วคะ";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=dx_ofyear_stool.php\">";
}
?>