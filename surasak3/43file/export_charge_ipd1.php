<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "18. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่18 ตาราง CHARGE_IPD ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

	$temp18="CREATE  TEMPORARY  TABLE report_admission SELECT *  From ipcard where dcdate like '$yrmonth%' and dcdate is not null";
	$querytmp18 = mysql_query($temp18) or die("Query failed,Create temp18"); 
 
   $sql="SELECT  a.date,b.hn,a.an,a.depart From ipacc as a, report_admission as b where a.an=b.an";
   	$result = mysql_query($sql) or die("Query failed,Select report_admission And ipacc");
    while (list ($date,$hn,$an,$depart) = mysql_fetch_row ($result)) {	
	$chargelist="000000";

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);

	
	$num2=543;
    $d=substr($date,8,2);
    $m=substr($date,5,2); 
    $y=substr($date,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dateserv="$y1$m$d";
	

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	list($hn1,$hn2)=explode("-",$hn);
	$seq=($yy-543).$mm.$dd.$hn1.$hn2;	

     echo  "$hospcode|$hn|$an|$dateadmit|$wardstay|$chargeitem|$chargelist|$quantity|$instype|$cost|$price|$payprice|$d_update<br>";
     }
	
    include("unconnect.inc");
?>
