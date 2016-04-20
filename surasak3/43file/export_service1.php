<?php
include("../connect.inc");
$newyear = "$thiyr$rptmo$day";
$thimonth = "$thiyr-$rptmo";
$thiyr = $thiyr-543;
$yrmonth = "$thiyr-$rptmo";
$yy = 543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่7 ตาราง SERVICE ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

$temp7="CREATE  TEMPORARY  TABLE report_service 
SELECT thidate, hn, vn, an, ptname, ptright, goup, toborow 
FROM opday WHERE thidate like '$thimonth%' ORDER BY thidate ASC";
//echo $temp7;
$querytmp7 = mysql_query($temp7) or die("Query failed,Create temp7");

$temp71="CREATE TEMPORARY TABLE report_serviceopacc 
SELECT date,paid,hn,credit,txdate 
FROM opacc WHERE txdate LIKE '$thimonth%' ";
$querytmp71 = mysql_query($temp71) or die("Query failed,Create temp71");

$sql7="SELECT thidate, hn, vn, an, ptname, ptright, goup, toborow 
From report_service";
$result7= mysql_query($sql7) or die("Query failed, Select report_service (service)");
$num=mysql_num_rows($result7);
//echo "$num <br>";
while (list ($thidate,$hn,$vn,$an,$ptname,$ptright,$goup,$toborow) = mysql_fetch_row ($result7)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$sqlpt=mysql_query("select ptrightdetail from opcard where hn='$hn'");
	list($ptrightdetail)=mysql_fetch_array($sqlpt);
	
	
$chkdate=substr($thidate,0,10);	
$sqlopd="select temperature, pause, rate, bp1, bp2, organ 
from opd 
where thidate like '$chkdate%' 
and hn='$hn' 
and vn='$vn' 
order by thidate asc";
$resultopd=mysql_query($sqlopd);
$num=mysql_num_rows($resultopd);
//echo "==>$num <br>";
list($btemp,$pr,$rr,$sbp,$dbp,$organ)=mysql_fetch_array($resultopd);	

$sql = "Select sum(paid),credit From report_serviceopacc where hn = '$hn' and txdate like '$thimonth%'  ";
list($price,$credit)  = mysql_fetch_row(mysql_query($sql));
	
$sql1 = "Select sum(paid) From report_serviceopacc where hn = '$hn' and txdate like '$thimonth%' and credit = 'เงินสด' ";
list($paycash)  = mysql_fetch_row(mysql_query($sql1));
$payprice=$paycash;
if(empty($payprice) || $payprice==0){
$payprice="0.00";
}
$actualpay=$paycash;
if(empty($actualpay) || $actualpay==0){
$actualpay="0.00";
}	
$date=substr($date,0,10);
list($yy,$mm,$dd)=explode("-",$date);
$yy=$yy-543;
$daterecord="$yy$mm$dd";

$regis1=substr($thidate,0,10);
$regis2=substr($thidate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
$time_serv="$hh$ss$ii";  //เวลาที่มารับบริการ

$vn=sprintf("%03d",$vn);
$seq=$date_serv.$vn;	  //ลำดับที่

$location="1";  //ที่ตั้งของที่อยู่ผู้มารับบริการ
if($toborow=="EX04 ผู้ป่วยนัด"){
		$typein="2";  //ประเภทการมารับบริการ
		$intime="1";  //เวลามารับบริการ
}else if($toborow=="EX11 รักษาโรคนอกเวลาราชการ"){
		$typein="1";  //ประเภทการมารับบริการ
		$intime="2";  //เวลามารับบริการ
}else  if($toborow=="EX01 รักษาโรคทั่วไปในเวลาราชการ"){
		$typein="1";  //ประเภทการมารับบริการ
		$intime="1";	  //เวลามารับบริการ	
}else{
		$typein="1";  //ประเภทการมารับบริการ
		$intime="1";  //เวลามารับบริการ
	}
	


// ถ้ามี ptrightdetail
if( !empty($ptrightdetail) ){
	$sqlptr = "Select code From  ptrightdetail where detail='$ptrightdetail'";
	$resultptr = mysql_query($sqlptr) or die(mysql_error());
	list($instype) = mysql_fetch_row($resultptr);
}else{
	$newptright = substr($ptright,0,3);
	if($newptright == "R01" || $newptright == "R05"){  //เงินสด
		$instype = "9100";  //ประเภทสิทธิการรักษา
	}else if($newptright == "R02" || $newptright == "R03"  || $newptright == "R04"){  //โครงการเบิกจ่ายตรง
		$instype = "1100";  //ประเภทสิทธิการรักษา
	}else if($newptright == "R06"){  //พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ
		$instype = "6100";  //ประเภทสิทธิการรักษา
	}else if($newptright == "R07"){  //ประกันสังคม
		$instype = "4200";  //ประเภทสิทธิการรักษา
	}else if($newptright == "R09"){  //ประกันสุขภาพถ้วนหน้า
		$instype = "0100";  //ประเภทสิทธิการรักษา
	}
}

	

if(!empty($an)){  //สถานะผู้มารับบริการ
	$typeout="2";    //รับไว้รักษาต่อ
}else{
	$typeout="1";  //กลับบ้าน
}
		
$insid="";  //เลขที่บัตรตามสิทธิ
$causein="1";  //สาเหตุการส่งผู้ป่วย
$servplace="1";  //สถานที่บริการ
$referouthos="";  //สถานพยาบาลที่ส่งต่อ

$organ1 = str_replace("/\r\n|\r|\n/","<br/>|<br>",$organ);
$organ2=(string)$organ1;
$chiefcomp=ereg_replace('[[:space:]]+', '', trim($organ2)); 

if(empty($price) || $price=="0.00"){
	$price="50.00";
}

echo "$hospcode|$hn|$hn|$seq|$date_serv|$time_serv|$location|$intime|$instype|$insid|$hospcode|$typein|$hospcode|$causein|$chiefcomp|$servplace|$btemp|$sbp|$dbp|$pr|$rr|$typeout|$referouthos|$caseout|$cost|$price|$payprice|$actualpay|$d_update<br>";			

}  //close while