<?php
    include("connect.inc");
  
    $query = "DELETE FROM inputm WHERE idname = '$idname' ";
    $result = mysql_query($query)
        or die("Query failed");

    If ($result){
          print "ลบข้อมูลเรียบร้อยแล้ว<br>";
          print "ปิดหน้าต่างนี้";
 	}
    include("unconnect.inc");
?>