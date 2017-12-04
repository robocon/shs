<?php
session_start();
include("connect.inc");
/*
  comcode  comname  comaddr   ampur  changwat   tel
*/
        $query ="UPDATE company SET comname = '$comname',
              			  comaddr='$comaddr',
			              ampur='$ampur',	
			              changwat='$changwat',
			              tel='$tel',
						  fax='$fax',
						  pobillno='$pobillno',
						  pobilldate='$pobilldate',
						  pobillno2='$pobillno2',
						  pobilldate2='$pobilldate2',
						  pobillno3='$pobillno3',
						  pobilldate3='$pobilldate3'						  						  
                       WHERE comcode = '$cComcode' ";
        $result = mysql_query($query)
                       or die("Query failed,update company");
if ($result){
        print "รหัสบริษัท  :$cComcode<br>";
        print "ชื่อบริษัท    :$comname<br>";
        print "ที่อยู่บริษัท  :$comaddr<br>";
        print "เขต/อำเภอ :$ampur<br>";
        print "จังหวัด      :$changwat<br>";
        print "โทรศัพท์          :$tel<br>";
		 print "โทรสาร          :$fax<br>";
		 print "เลขที่ใบเสนอราคา1          :$pobillno<br>";
		 print "ลงวันที่1          :$pobilldate<br>";
		 print "เลขที่ใบเสนอราคา2          :$pobillno2<br>";
		 print "ลงวันที่2          :$pobilldate2<br>";
		 print "เลขที่ใบเสนอราคา3          :$pobillno3<br>";
		 print "ลงวันที่3          :$pobilldate3<br>";		 		 
        print "บันทึกข้อมูลเรียบร้อย<br>";
	}	
   else { 
        print "<br><br><br>รหัสบริษัท  :$cComcode  อาจซ้ำของเดิม โปรดแก้ไข<br>";
           }
include("unconnect.inc");
?>
<?php
session_start();
include("connect.inc");
/*
  comcode  comname  comaddr   ampur  changwat   tel
*/
        $query ="UPDATE druglst SET comname = '$comname'
              			 WHERE comcode = '$cComcode' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
if ($result){
        print "รหัสบริษัท  :$cComcode<br>";
		 print "ชื่อบริษัท    :$comname<br>";
        print "บันทึกข้อมูลเรียบร้อย<br>";
	}	
   else { 
        print "<br><br><br>รหัสบริษัท  :$cComcode  อาจซ้ำของเดิม โปรดแก้ไข<br>";
           }
include("unconnect.inc");
?>









