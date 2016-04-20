<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่5 ตาราง DRUGGALLERGY ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

   $sql="SELECT a.hn,a.tradname,a.advreact,a.asses,a.date,b.code24 From drugreact as a inner join druglst as b on a.drugcode=b.drugcode where a.date like '$yrmonth%'";



   $result = mysql_query($sql) or die(mysql_error());
    while (list ($hn,$tradname,$advreact,$asses,$date,$code24) = mysql_fetch_row ($result)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$informant="1";

	$num2=543;
    $d=substr($date,8,2);
    $m=substr($date,5,2); 
    $y=substr($date,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$date1="$y1$m$d";
	

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;

       echo  "$hospcode|$hn|$date1|$code24|$tradname||$asses|$advreact|$informant|$hospcode|$d_update<br>";
          }
	
    include("unconnect.inc");
?>
