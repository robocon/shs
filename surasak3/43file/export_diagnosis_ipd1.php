<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "15. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่15 ตาราง DIAGNOSIS_IPD ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

	$temp15="CREATE  TEMPORARY  TABLE report_admission SELECT *  From ipcard where dcdate like '$yrmonth%' and dcdate is not null";
	$querytmp15 = mysql_query($temp15) or die("Query failed,Create temp15");
	
    $sql15="SELECT  a.regisdate,a.hn,a.an,b.date,b.clinic,b.doctor,a.icd10,a.type,a.svdate From diag as a,report_admission as b where a.an = b.an";
   	$result15 = mysql_query($sql15) or die("Query failed,Select report_admission And diag");
    while (list ($regisdate,$hn,$an,$date,$clinic,$doctor,$diagcode,$type,$svdate) = mysql_fetch_row ($result15)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	if($type=="PRINCIPLE"){ $diagtype="1";}
	if($type=="CO-MORBIDITY"){ $diagtype="2";}
	if($type=="COMPLICATION"){ $diagtype="3";}
	if($type=="OTHER"){ $diagtype="4";}
	if($type=="EXTERNAL CAUSE"){ $diagtype="5";}

	
	$num2=543;
    $d=substr($date,8,2);
    $m=substr($date,5,2); 
    $y=substr($date,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dateserv="$y1$m$d";
  	$time1=substr($date,11,2); 
	$time2=substr($date,14,2); 
    $time3=substr($date,17,2); 
	$timeserv="$time1$time2$time3";	
	$datetime_admit=$dateserv.$timeserv;
	
	$newclinic=substr($clinic,0,2);
	if($newclinic=="12"){
		$newclinic="99";
	}
	if(!empty($clinic)){
		$warddiag="1$newclinic00";
	}	

	$regis1=substr($regisdate,0,10);
	$regis2=substr($regisdate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;

	$doctor=substr($doctor,0,5);	
	$provider=$doctor.$an;

     	echo  "$hospcode|$hn|$an|$datetime_admit|$warddiag|$diagtype|$diagcode|$provider|$d_update<br>";
     }
	
    include("unconnect.inc");
?>
