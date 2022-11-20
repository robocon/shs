<?php
session_start();
include("connect.inc");

$sql = "SELECT * FROM dphardep WHERE row_id = '$idno' and date ='0000-00-00 00:00:00'"; 
//echo $sql;
$query = mysql_query($sql) or die("Query failed");
$num=mysql_num_rows($query);
$rows=mysql_fetch_array($query);
$rowid=$rows["row_id"];
$essd=$rows["essd"];
$nessdn=$rows["nessdn"];

if($num > 0){
	$edit="UPDATE dphardep SET essd='$nessdn', nessdn='0.00' where row_id='$rowid'";
	$edit1="UPDATE ddrugrx SET part='DDL' where row_id='$row_id'";
	if(mysql_query($edit) && mysql_query($edit1)){
		echo "<script>alert('ปรับปรุงสถานะข้อมูลเรียบร้อยแล้ว');window.location='drxlist_not.php';</script>";
	}else{
		echo "<script>alert('!!!ผิดพลาด...ไม่สามารถปรับปรุงสถานะข้อมูลได้');window.location='drxlist_not.php';</script>";
	}
}else{
	echo "<script>alert('ไม่พบข้อมูล');window.location='drxlist_not.php';</script>";
}


?>
