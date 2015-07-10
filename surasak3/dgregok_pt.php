<?php
include("connect.inc");
/*
  date   comcode   comname   drugcode  tradname  genname   unit  part   bcode
*/

      $sql = "INSERT INTO druglst_pt(date,comcode,comname,drugcode,
	tradname,genname,unit,part,bcode)VALUES(now(),'$comcode',
               '$comname','".trim($drugcode)."','$tradname','$genname','$unit','$part','$bcode');";
      $result = mysql_query($sql);
if ($result){
        print "รหัสบริษัท   :$comcode<br>";
        print "ชื่อบริษัท    :$comname<br>";
        print "รหัสยา       :$drugcode<br>";
        print "ชื่อการค้า    :$tradname<br>";
        print "ชื่อสามัญ   :$genname<br>";
        print "หน่วยนับ   :$unit<br>";
        print "part         :$part<br>";
        print "bcode     :$bcode<br>";
        print "บันทึกข้อมูลเรียบร้อย<br>";
		  print "<a target=_BLANK href='dgedit_pt.php?Dgcode=$drugcode'>เพิ่มข้อมูล</a><br>";
	}	
   else { 
        print "<br><br><br>รหัสยา  :$drugcode  อาจซ้ำของเดิม! โปรดแก้ไข<br>";
           }
include("unconnect.inc");
?>








