<?php
include("connect.inc");
$strHn = trim($_POST["strHn"]);
$strSQL = "SELECT  CONCAT(yot,name,' ',surname)as ptname,ptrightdetail FROM opcard  WHERE hn = '".$strHn."' ";
$query = mysql_query($strSQL) or die ( mysql_error() );
$item = mysql_fetch_assoc($query);
if($item){
	if(empty($item['ptrightdetail'])){
		$item['ptrightdetail'] = '-';
	}
	echo $item['ptname'].'|'.$item['ptrightdetail'];
	exit;
}