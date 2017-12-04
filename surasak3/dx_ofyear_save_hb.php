<?php
session_start();
include("connect.inc");
$daten = (date("Y")+543).date("-m-d H:i:s");

$sqlrun = "select prefix from runno where title='y_chekup' ";
$rowrun = mysql_query($sqlrun);
list($prefix) = mysql_fetch_array($rowrun);
$prefix="25".$prefix;

$sql ="insert into chk_hb (date,hn,ptname,age,hbsag,hbsab,hbcab,leadlevel,yearchk) value('$daten','$hn','$ptname','$age','$hb1','$hb2','$hb3','$lead','$prefix')";

$result = mysql_query($sql);
if($result){
	echo "บันทึกข้อมูลเรียบร้อยแล้วคะ";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=dx_ofyear_hb.php\">";
}
?>