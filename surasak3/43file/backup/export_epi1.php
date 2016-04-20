<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่22 ตาราง EPI ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

   $sql="SELECT thidate,hn,drugcode  FROM trauma_inject WHERE thidate LIKE '$yrmonth%'";
   	$result = mysql_query($sql) or die(mysql_error());
    while (list ($thidate,$hn,$drugcode) = mysql_fetch_row ($result)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$num2=543;
    $d=substr($thidate,8,2);
    $m=substr($thidate,5,2); 
    $y=substr($thidate,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dateserv="$y1$m$d";
	
	if($drugcode=='0TT'){$vaccinetype='101';}else{$vaccinetype='111';};

	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	list($hn1,$hn2)=explode("-",$hn);
	$seq=($yy-543).$mm.$dd.$hn1.$hn2;	

       echo  "$hospcode|$hn|$seq|$dateserv|$vaccinetype|$hospcode|$provider|$d_update<br>";
     }
	
    include("unconnect.inc");
?>
