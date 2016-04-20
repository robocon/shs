<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่9 ตาราง ACCIDENT ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

   $sql="SELECT  date,hn,date_in,time_in,type_accident,sender From  trauma where date like '$yrmonth%'";

   	$result = mysql_query($sql) or die(mysql_error());
    while (list ($date,$hn,$datein,$timein,$type_accident,$sender) = mysql_fetch_row ($result)) {	
	$datetimeae=$datein.$timein;

	list($datein1,$datein2,$datein3)=explode("-",$datein);
	$datein1=$datein1-543;
	list($timein1,$timein2,$timein3)=explode(":",$timein);
	$datetimeae=$datein1.$datein2.$datein3.$timein1.$timein2.$timein3;
	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	
	$num2=543;
    $d=substr($date,8,2);
    $m=substr($date,5,2); 
    $y=substr($date,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dateserv="$y1$m$d";
	list($hn1,$hn2)=explode("-",$hn);
	$seq=$dateserv.$hn1.$hn2;

	
  	$time1=substr($date,11,2); 
	$time2=substr($date,14,2); 
    $time3=substr($date,17,2); 
	$timeserv="$time1$time2$time3";
	
	$datetimeserv=$dateserv.$timeserv;
	

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
    	echo  "$hospcode|$hn|$seq|$datetimeserv|$datetimeae|$type_accident||$sender|$traffic|$vehicle|$alcohol|$nacrotic_drug|$belt|$helmet|$airway|$stopbleed|$splint|$fluid|$urgency|$coma_eye|$coma_speak|$coma_movement|$d_update<br>";
     }
	
    include("unconnect.inc");
?>
