<?php
    include("connect.inc");
  
    $query = " UPDATE appoint SET apptime = 'ยกเลิกการนัด' WHERE  row_id = '$cRow' ";
    $result = mysql_query($query)
        or die("Query failed");

    If ($result){
          print "ยกเลิกการนัดเรียบร้อย<br>";
          print "ปิดหน้าต่างนี้";
 	}
    include("unconnect.inc");
?>
