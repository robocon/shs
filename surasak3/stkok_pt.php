<?php
  session_start();
  include("connect.inc");
   //insert data into duecompany table 
   $query = "INSERT INTO duecompany_pt(billdate,docno,comname,price,billno,getdate,items,officer)
	VALUES('$cBilldate','$cDocno','$cComname','$nNetprice','$cBillno','$cGetdate','$nItem','$sOfficer');";
   $result = mysql_query($query) or die("Query failed,insert into duecompany ");
   print "$cComcode, $cComname<br>";
   print "จำนวนเงินทั้งสิ้น $nNetprice<br>";
   print "<br><br>บันทึกข้อมูลเรียบร้อย<br>";
   print "<br><a href='procure_pt.php'>บันทึกใบส่งของใบใหม่</a><br>";
   print "<br><a href='../nindex.htm'><< ไปเมนู</a><br>";

  include("unconnect.inc");
?>

