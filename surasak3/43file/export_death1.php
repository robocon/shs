<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่3 ตาราง DEATH ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

   $sql="SELECT date,an,hn,dcdate,icd10 From ipcard where date like '$yrmonth%' and dctype like '%dead%'";



   $result = mysql_query($sql) or die(mysql_error());
    while (list ($date,$an,$hn,$dcdate,$icd10) = mysql_fetch_row ($result)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$num2=543;
    $d=substr($date,8,2);
    $m=substr($date,5,2); 
    $y=substr($date,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$date1="$y1$m$d";
	
    $d=substr($dcdate,8,2);
    $m=substr($dcdate,5,2); 
    $y=substr($dcdate,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dcdate1="$y1$m$d";	
	

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;

       echo  "$hospcode|$hn|$hospcode|$an|$date1$an|$dcdate1|$icd10|||||||||$d_update<br>";

          }
	
    include("unconnect.inc");
?>
