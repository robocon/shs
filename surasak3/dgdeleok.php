<?php
  session_start();
  include("connect.inc");
  $query = "delete from druglst where row_id ='$cDgrow'";
  $result = mysql_query($query) or die("ไม่สามารถลบรายการออกจากรายการได้");
  print " ลบ $cDgcode,$cDgtrad ออกจากบัญชียาเวชภัณฑ์เรียบร้อย: <br>";
  print "  ปิดหน้าต่างนี้   แล้วตรวจสอบผลการลบข้อมูลได้";
   session_unregister("cDgrow");
   session_unregister("cDgcode");
   session_unregister("cDgtrad");
   include("unconnect.inc");
?>



