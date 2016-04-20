<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่10 ตาราง DIAGNOSIS_OPD ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

   $sql="SELECT  regisdate,hn,icd10,type,svdate From diag where regisdate like '$yrmonth%'";
   	$result = mysql_query($sql) or die(mysql_error());
    while (list ($regisdate,$hn,$diagcode,$type,$svdate) = mysql_fetch_row ($result)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	if($type=="PRINCIPLE"){ $diagtype="1";}
	if($type=="CO-MORBIDITY"){ $diagtype="2";}
	if($type=="COMPLICATION"){ $diagtype="3";}
	if($type=="OTHER"){ $diagtype="4";}
	if($type=="EXTERNAL CAUSE"){ $diagtype="5";}

	
	$num2=543;
    $d=substr($svdate,8,2);
    $m=substr($svdate,5,2); 
    $y=substr($svdate,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dateserv="$y1$m$d";
	
  	$time1=substr($thidate,11,2); 
	$time2=substr($thidate,14,2); 
    $time3=substr($thidate,17,2); 
	$timeserv="$time1$time2$time3";	
	

	$regis1=substr($regisdate,0,10);
	$regis2=substr($regisdate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	list($hn1,$hn2)=explode("-",$hn);
	$seq=($yy-543).$mm.$dd.$hn1.$hn2;	

       echo  "$hospcode|$hn|$seq|$dateserv|$diagtype|$diagcode|$clinic|$provider|$d_update<br>";
          }
	
    include("unconnect.inc");
?>
