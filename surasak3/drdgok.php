<?php
session_start();
include("connect.inc");
        $query ="UPDATE drdglst SET slcode = '$slcode',
              			          amount = '$amount'
                       WHERE drugcode = '$sDgcode' ";
        $result = mysql_query($query)
                       or die("Query failed,update drdglst");
if ($result){
        print "รหัสยา :$sDgcode<br>";
//        print "ชื่อการค้า :$cTrad<br>";
        print "รหัสวิธีใช้ :$slcode<br>";
        print "จำนวนจะสั่ง :$amount<br>";
        print "บันทึกข้อมูลเรียบร้อย<br>";
	}	
   else { 
        print "<br><br><br>ไม่สามารถแก้ไขได้ !<br>";
           }
include("unconnect.inc");
?>







