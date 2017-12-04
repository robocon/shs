<?php
    include("connect.inc");
        $query ="UPDATE runno SET prefix = '$prefix' ,
 runno = '$runno'				
                       WHERE title = '$title' ";
        $result = mysql_query($query)
                       or die("Query failed,update labcare");
   If (!$result){
        echo "ผิดพลาด แก้ไขข้อมูลไม่สำเร็จ";
                    }
   else {
        echo "แก้ไขข้อมูลเรียบร้อย";
		echo "<script>opener.location=opener.location.toString();self.close();</script>";
          }
include("unconnect.inc");
?>


