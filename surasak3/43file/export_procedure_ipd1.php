<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "16. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่16 ตาราง PROCEDURE_IPD ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

	$temp16="CREATE  TEMPORARY  TABLE report_admission SELECT *  From ipcard where dcdate like '$yrmonth%' and dcdate is not null";
	$querytmp16 = mysql_query($temp16) or die("Query failed,Create temp16");

    $sql16="SELECT a.admdate,a.an,a.icd9cm,b.hn,b.clinic,b.doctor,b.date FROM  ipicd9cm as a,report_admission as b WHERE a.an=b.an";
   	$result16 = mysql_query($sql16) or die("Query failed,Select report_admission And ipicd9cm");
    while (list ($admdate,$an,$icd9cm,$hn,$clinic,$doctor,$date) = mysql_fetch_row ($result16)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	$procedcode=$icd9cm;
	
	$num2=543;
    $d=substr($admdate,8,2);
    $m=substr($admdate,5,2); 
    $y=substr($admdate,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dateserv="$y1$m$d";
  	$time1=substr($admdate,11,2); 
	$time2=substr($admdate,14,2); 
    $time3=substr($admdate,17,2); 
	$timeserv="$time1$time2$time3";	
	$datetime_admit=$dateserv.$timeserv;
	


	$newclinic=substr($clinic,0,2);
	if($newclinic=="12"){
		$newclinic="99";
	}
	if(!empty($clinic)){
		$wardstay="1$newclinic00";
	}	
	
	$doctor=substr($doctor,0,5);	
	$provider=$doctor.$an;	
	
	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	
	$timestart=$datetime_admit;
	$timefinish=$datetime_admit;
	$serviceprice="0.00";
	
       echo  "$hospcode|$hn|$an|$datetime_admit|$wardstay|$procedcode|$timestart|$timefinish|$serviceprice|$provider|$d_update<br>";
      }
	
    include("unconnect.inc");
?>
