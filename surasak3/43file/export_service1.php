<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่7 ตาราง SERVICE ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

   $sql="SELECT  thidate,thdatehn,hn,vn,an,ptright,toborow From opday where thidate like '$yrmonth%'";

   	$result = mysql_query($sql) or die(mysql_error());
    while (list ($thidate,$thdatehn,$hn,$vn,$an,$ptright,$toborow) = mysql_fetch_row ($result)) {	
	
	$sqlopd="select * from opd where thdatehn='$thdatehn' and vn='$vn'";
	$queryopd=mysql_query($sqlopd);
	$rowsopd=mysql_fetch_array($queryopd);
	$chiefcomp=$rowsopd["organ"];
	$servplace="1";
	$btemp=$rowsopd["temperature"];
	$sbp=$rowsopd["bp1"];
	$dbp=$rowsopd["bp2"];
	$pr=$rowsopd["pause"];
	$rr=$rowsopd["rate"];
	
	
	
	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$location="1";
	$typein="1";
	if(substr($toborow,0,4)=="EX11"){
		$intime="2";
	}else{
		$intime="1";
	}
	
	if($an!=""){
		$typeout="1";
	}else{
		$typeout="2";
	}	
	
	if($ptright=='R09'){$ptright1="0100";} 
	else if($ptright=='R10'){$ptright1="0100";}
	else if($ptright=='R11'){$ptright1="0100";}
	else if($ptright=='R13'){$ptright1="0100";}
	else if($ptright=='R17'){$ptright1="0100";}
	else if($ptright=='R07'){$ptright1="4200";}
	else if($ptright=='R03'){$ptright1="1100";}
	else if($ptright=='R02'){$ptright1="1100";}
	else {$ptright1="9100";};
	
	$num2=543;
    $d=substr($thidate,8,2);
    $m=substr($thidate,5,2); 
    $y=substr($thidate,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$date1="$y1$m$d";
	
  	$time1=substr($thidate,11,2); 
	$time2=substr($thidate,14,2); 
    $time3=substr($thidate,17,2); 
	$timeserv="$time1$time2$time3";	
	

	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;

       echo  "$hospcode|$hn|$hn|$date1$vn|$date1|$timeserv|$location|$intime|$ptright1||$hospcode|$typein|||$chiefcomp|$servplace|$btemp|$sbp|$dbp|$pr|$rr|$typeout||$d_update<br>";
          }
	
    include("unconnect.inc");
?>
