<?php
    include("connect.inc");
        $query ="UPDATE inputm SET idname = '$idname' ,
menucode = '$menucode',	pword = '$pword',	
name = '$name'				
                       WHERE idname = '$idname' ";
        $result = mysql_query($query)
                       or die("Query failed,update inputm");
   If (!$result){
        echo "insert into labcare fail";
                    }
   else {
        echo "บันทึกแก้ไขข้อมูลเรียบร้อย";
          }
include("unconnect.inc");
?>


