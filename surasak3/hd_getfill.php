<?php
include("../connect.inc");
 
 
$strHn = trim($_POST["strhn"]);

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


	$strSQL = "SELECT  ptname,bp1,bp2,cigarette  FROM opd  WHERE hn = '".$strHn."'  ORDER BY `row_id` DESC limit 1 ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);
	if($objResult)
	{

		echo $objResult["ptname"]."|".$objResult["bp1"]."|".$objResult["bp2"]."|".$objResult["cigarette"]."|";
	}
	
	?>
