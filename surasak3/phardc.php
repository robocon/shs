<?php
    session_start();
    if (!isset($sIdname)){die;}
	include("connect.inc");
	$date2 = (date("Y")+543).date("-m-d");
	
	$str="select lock_dc from ipcard WHERE an = '".$_GET['an']."' ";
	$strresult=mysql_query($str);
	$arr=mysql_fetch_array($strresult);
	
	if($arr['lock_dc']=='' || $arr['lock_dc']==NULL){
		
		$sql = "update ipcard set lock_dc = '$date2' where an = '".$_GET['an']."' ";
		
	}else{
		
		$sql = "update ipcard set lock_dc =null where an = '".$_GET['an']."' ";
	}
	
	
	//echo $sql;
	$result=mysql_query($sql);
	if($result){
		echo "ทำการปลดล็อคเรียบร้อยแล้ว กรุณารอสักครู่....";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=enddrugprofile.php\">";
	}
?>