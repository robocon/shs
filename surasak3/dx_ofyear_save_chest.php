<?php
session_start();
include("connect.inc");
$daten = (date("Y")+543).date("-m-d H:i:s");

$sqlrun = "select prefix from runno where title='y_chekup' ";
$rowrun = mysql_query($sqlrun);
list($prefix) = mysql_fetch_array($rowrun);
$prefix="25".$prefix;

$sql ="insert into chk_chest (date,hn,ptname,age,FVC,FEV,FFV,reason,yearchk) value('$daten','$hn','$ptname','$age','$FVC','$FEV','$FFV','$reason','$prefix')";

$result = mysql_query($sql);
if($result){
	echo "�ѹ�֡���������º�������Ǥ�";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=dx_ofyear_chest.php\">";
}
?>