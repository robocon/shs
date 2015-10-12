<?php
session_start();
include("connect.inc");
        $query ="UPDATE druglst SET bcode = '$bcode',slcode = '$slcode',drugnote = '$drugnote',drugtype = '$drugtype' ,had = '$had'  WHERE drugcode = '$sDgcode' ";
        $result = mysql_query($query)or die("Query failed,update druglst");
if ($result){
        print "รหัสยา :$sDgcode<br>";
        print "คำเตือนการใช้ยา :$drugnote<br>";
        print "รหัสวิธีใช้ :$slcode<br>";
        print "รหัสสารบัญ :$bcode<br>";
        print "ประเภทยา :$drugtype<br>";
        print "บันทึกข้อมูลเรียบร้อย<br>";
	}	
   else { 
        print "<br><br><br>ไม่สามารถแก้ไขได้ !<br>";
           }
include("unconnect.inc");
?>







