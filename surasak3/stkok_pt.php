<?php
  session_start();
  include("connect.inc");
   //insert data into duecompany table 
   $query = "INSERT INTO duecompany_pt(billdate,docno,comname,price,billno,getdate,items,officer)
	VALUES('$cBilldate','$cDocno','$cComname','$nNetprice','$cBillno','$cGetdate','$nItem','$sOfficer');";
   $result = mysql_query($query) or die("Query failed,insert into duecompany ");
   print "$cComcode, $cComname<br>";
   print "�ӹǹ�Թ������ $nNetprice<br>";
   print "<br><br>�ѹ�֡���������º����<br>";
   print "<br><a href='procure_pt.php'>�ѹ�֡��觢ͧ�����</a><br>";
   print "<br><a href='../nindex.htm'><< �����</a><br>";

  include("unconnect.inc");
?>

