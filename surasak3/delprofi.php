<?php
  session_start();
  include("connect.inc");
	$query = "delete from dgprofile where row_id ='$cRow_id'";
	$result = mysql_query($query) or die("ไม่สามารถลบรายการได้");
	print " ลบรายการออกจาก  drug profile เรียบร้อย: <br>";
	print " ปิดหน้าต่างนี้, refresh drug profile, ตรวจสอบผลการลบข้อมูลได้";
  include("unconnect.inc");
  session_unregister("cRow_id");
?>



