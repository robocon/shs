<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่17 ตาราง DRUG_IPD ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

	$temp17="CREATE  TEMPORARY  TABLE report_admission SELECT *  From ipcard where dcdate like '$yrmonth%' and dcdate is not null";
	$querytmp17 = mysql_query($temp17) or die("Query failed,Create temp17");

   $sql="SELECT a.date,b.hn,a.an,a.detail,a.amount,b.date,b.clinic FROM ipacc as a, report_admission as b WHERE a.an=b.an and (part='DDL' or part='DDN' or part='DDY') group by a.code";
   	$result = mysql_query($sql) or die(mysql_error());
    while (list ($date,$hn,$an,$dname,$amount,$admdate,$clinic) = mysql_fetch_row ($result)) {	

	$drugsql=mysql_query("select code24,unit,unitpri,salepri from druglst where drugcode='$drugcode'");
	list($didstd,$unitpack,$drugcost,$drugprice)=mysql_fetch_array($drugsql);
	
	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
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


	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;

       echo  "$hospcode|$hn|$an|$datetime_admit|$wardstay|$typedrug|$didstd|$dname|$datestart|$datefinish|$amount|$unit|$unitpack|$drugprice|$drugcost|$provider|$d_update<br>";
     }
	
    include("unconnect.inc");
?>
