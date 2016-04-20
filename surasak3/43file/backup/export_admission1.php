<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";

print "14. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่14 ตาราง ADMISSION ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

	$temp14="CREATE  TEMPORARY  TABLE report_admission SELECT *  From ipcard where dcdate like '$yrmonth%' and dcdate is not null";
	$querytmp14 = mysql_query($temp14) or die("Query failed,Create temp14");
		
	$sql14="SELECT date,an,hn,ptright,clinic,my_ward,dcdate,dcstatus,dctype,doctor  From report_admission";
	$result14 = mysql_query($sql14) or die("Query failed,Select report_admission");
    while (list ($date,$an,$hn,$ptright,$clinic,$my_ward,$dcdate,$dcstatus,$dctype,$doctor) = mysql_fetch_row ($result14)){	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);

	$sqlopd=mysql_query("select weight,height from opd where hn='$hn' order by row_id desc");
	list($admitweight,$admitheight)=mysql_fetch_array($sqlopd);
	
	$num2=543;
    $d=substr($date,8,2);
    $m=substr($date,5,2); 
    $y=substr($date,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dateserv="$y1$m$d";
	list($hn1,$hn2)=explode("-",$hn);
	$seq=$dateserv.$hn1.$hn2;		
	


	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	
	$dcdate1=substr($dcdate,0,10);
	$dcdate2=substr($dcdate,11,19);
	list($yy,$mm,$dd)=explode("-",$dcdate1);
	list($hh,$ss,$ii)=explode(":",$dcdate2);
	$datetime_disch=($yy-543).$mm.$dd.$hh.$ss.$ii;	
	
	$newclinic=substr($clinic,0,2);
	if($newclinic=="12"){
		$newclinic="99";
	}
	if(!empty($clinic)){
		$wardadmit="1$newclinic00";
		$warddisch="1$newclinic00";
	}
	
	$newptright=substr($ptright,0,3);
	if($newptright=="R01" || $newptright=="R05"){
		$instype="9100";
	}else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){
		$instype="1100";
	}else if($newptright=="R06"){
		$instype="6100";
	}else if($newptright=="R07"){
		$instype="4200";
	}else if($newptright=="R09"){
		$instype="0100";
	}
	
	$typein="1";
	$dischtype=substr($dctype,0,1);
	$dischstatus=$dcstatus;
	
	$ipmonsql=mysql_query("select price,cash,credit from ipmonrep where an='$an'");
	list($price,$cash,$credit)=mysql_fetch_array($ipmonsql);
	
	if($credit=="เงินสด" || $credit=="อื่นๆ"){
		$price=$cash;
		$payprice=$cash;
		$actualpay=$cash;
	}else{
		$payprice=0;
		$actualpay=0;	
	}
	$doctor=substr($doctor,0,5);
	$provider=$doctor.$an;
	
       echo  "$hospcode|$hn|$seq|$an|$dateserv|$wardadmit|$instype|$typein|$referinhosp|$causein|$admitweight|$admitheight|$datetime_disch|$warddisch|$dischstatus|$dischtype|$referouthosp|$causeout|$cost|$price|$payprice|$actualpay|$provider|$d_update<br>";

          }
		  
  //  print "<table>";
	

    include("unconnect.inc");
?>
