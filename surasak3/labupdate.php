<?php
    include("connect.inc");
        $query ="UPDATE labcare SET code = '$code' ,
price = '$price', yprice = '$yprice', nprice = '$nprice'				
                       WHERE code = '$code' ";
        $result = mysql_query($query)
                       or die("Query failed,update labcare");
   If (!$result){
        echo "insert into labcare fail";
                    }
   else {
        echo "บันทึกแก้ไขข้อมูลเรียบร้อย";
          }
include("unconnect.inc");
?>


