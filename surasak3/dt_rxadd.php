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
   
	        print "����      :$slipcode<br>";
	        print "�Ը�����1   :$detail1<br>";
	        print "�Ը�����2  :$detail2<br>";
	        print "�Ը�����3     :$detail3<br>";
	        print "�Ը�����4  :$detail4<br>";
	        echo "<script>alert('�����������Ըա���������º��������');window.location='dt_drug.php';</script>";
	}
    else { 
		   echo "<script>alert('����  : $slipcode  ��Ӣͧ��� �ô���');window.location='dt_slipadd.php';</script>";
              }
include("unconnect.inc");
?>








