<?php
include("../connect.inc");
 
 
$strHn = trim($_POST["stridcard"]);




	$strSQL = "SELECT  CONCAT(yot,name,' ',surname)as ptname,phone2  FROM opcard  WHERE idcard = '".$strHn."' ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);
	$NumRows=mysql_num_rows($objQuery);
	
	if($NumRows>0)
	{

		echo $objResult["ptname"]."|".$objResult["phone2"]."|";
		
	}else{
		
	$strSQL1 = "SELECT  ptname ,phone  FROM  internet  WHERE idcard = '".$strHn."' Order by row_id DESC";
	$objQuery1 = mysql_query($strSQL1) or die ("Error Query [".$strSQL1."]");	
	$objResult1 = mysql_fetch_array($objQuery1);
	
	echo $objResult1["ptname"]."|".$objResult1["phone"]."|";
	}
	
	?>
