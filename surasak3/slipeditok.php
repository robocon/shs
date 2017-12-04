<?php
session_start();
include("connect.inc");
        $query ="UPDATE drugslip SET detail1 = '$rxdetail1',
              			            detail2 = '$rxdetail2',
			            detail3 = '$rxdetail3',
			            detail4 = '$rxdetail4'
                       WHERE slcode = '$sSlcode' ";
        $result = mysql_query($query)
                       or die("Query failed,update drugslip");
if ($result){
        print "รหัส     :$sSlcode<br>";
        print "แถวที่ 1:$rxdetail1<br>";
        print "แถวที่ 2:$rxdetail2<br>";
        print "แถวที่ 3:$rxdetail3<br>";
        print "แถวที่ 4:$rxdetail4<br>";
        print "บันทึกข้อมูลเรียบร้อย<br>";
	}	
   else { 
        print "<br><br><br>ไม่สามารถแก้ไขได้ !<br>";
           }
include("unconnect.inc");
?>







