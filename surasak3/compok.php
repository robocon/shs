<?php
include("connect.inc");
/*
  comcode  comname  comaddr   ampur  changwat   tel
*/

      $sql = "INSERT INTO company(comcode,comname,comaddr,
	            ampur,changwat,tel,fax,comtype)VALUES('$comcode','$comname',
    	           '$comaddr','$ampur','$changwat','$tel','$fax','$type');";
     $result = mysql_query($sql);
if ($result){
        print "รหัสบริษัท  :$comcode<br>";
        print "ชื่อบริษัท    :$comname<br>";
        print "ที่อยู่บริษัท  :$comaddr<br>";
        print "เขต/อำเภอ :$ampur<br>";
        print "จังหวัด     :$changwat<br>";
        print "โทรศัพท์       :$tel<br>";
		print "โทรสาร        :$fax<br>";
        print "บันทึกข้อมูลเรียบร้อย<br>";
	}	
   else { 
        print "<br><br><br>รหัสบริษัท  :$comcode  ซ้ำของเดิม โปรดแก้ไข<br>";
           }
include("unconnect.inc");
?>








