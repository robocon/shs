<?php
session_start();
include("connect.inc");
$datekey=date("Y-m-d H:i:s");
	$sql = "INSERT INTO drugslip(slcode,detail1,
	            detail2,detail3,detail4)VALUES('$slipcode',
	            '$detail1','$detail2','$detail3','$detail4');";
	$result = mysql_query($sql);
   if (mysql_errno() == 0){
			$add="insert into log_drugslip set slcode='$slipcode', action='add', username='".$_SESSION["sOfficer"]."', menucode='".$_SESSION["smenucode"]."', datekey='$datekey'";
			mysql_query($add);
   
	        print "รหัส      :$slipcode<br>";
	        print "วิธีใช้ที่1   :$detail1<br>";
	        print "วิธีใช้ที่2  :$detail2<br>";
	        print "วิธีใช้ที่3     :$detail3<br>";
	        print "วิธีใช้ที่4  :$detail4<br>";
	        echo "<script>alert('เพิ่มข้อมูลวิธีการใช้ยาเรียบร้อยแล้ว');window.location='dt_drug.php';</script>";
	}
    else { 
		   echo "<script>alert('รหัส  : $slipcode  ซ้ำของเดิม โปรดแก้ไข');window.location='dt_slipadd.php';</script>";
              }
include("unconnect.inc");
?>








