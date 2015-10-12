<?php
include("connect.inc");
$strHn = trim($_POST["strHn"]);
/*if($strMode == "ADD")
{
	$update=date("Y-m-d H:i:s");
	
	$strSQL = "INSERT INTO  clinic_vip ";
	$strSQL .="(thidate,time,hn,an,ptname,officer,update) ";
	$strSQL .="VALUES ";
	$strSQL .="('".$_POST["thidate"]."','".$_POST["time"]."','".$_POST["thn"]."' ";
	$strSQL .=",'".$_POST["tName"]."','".$_POST["ttan"]."','".$_POST["officer"]."','".$update."') ";
	$objQuery = mysql_query($strSQL);
}*/
$sql = "SELECT CONCAT(yot,name,' ',surname)as ptname,ptright FROM opcard  WHERE hn = '$strHn'";
$q = mysql_query($sql) or die ( mysql_error() );
$item = mysql_fetch_assoc($q);
if($item){
	echo trim($item["ptname"].'|'.$item['ptright']);
}
exit;