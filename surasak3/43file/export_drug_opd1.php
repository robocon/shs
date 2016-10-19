<?php
include("../connect.inc");
$newyear = "$thiyr$rptmo$day";
$thimonth = "$thiyr-$rptmo";
$thiyr = $thiyr-543;
$yrmonth = "$thiyr-$rptmo";
$yy = 543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่12 ตาราง DRUG_OPD ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

$file_path = '';

$temp12="CREATE TEMPORARY TABLE report_drugopd 
SELECT a.`date`,
a.`hn`,
a.`an`,
a.`drugcode`,
a.`tradname`,
a.`amount`,
b.`code24`,
b.`unit`,
b.`packing`,
b.`salepri`,
b.`unitpri` 
FROM `drugrx` as a 
INNER JOIN `druglst`as b ON a.`drugcode` = b.`drugcode` 
WHERE a.`date` LIKE '$thimonth%' 
AND b.`drugcode` REGEXP '^[0-9]+' 
AND ( 
    b.`drugcode` NOT LIKE '0INF%' 
    AND b.`drugcode` NOT LIKE '20%' 
    AND b.`drugcode` NOT LIKE '30%' 
    AND b.`drugcode` NOT LIKE '10%' 
    AND b.`drugcode` NOT LIKE '11%' 
    AND b.`drugcode` NOT LIKE '12%' 
    AND b.`drugcode` NOT LIKE '13%' 
    AND b.`drugcode` NOT LIKE '14%' 
    AND b.`drugcode` NOT LIKE '15%' 
    AND b.`drugcode` NOT LIKE '16%' 
    AND b.`drugcode` NOT LIKE '17%' 
    AND b.`drugcode` NOT LIKE '18%' 
    AND b.`drugcode` NOT LIKE '19%' 
    AND b.`drugcode` NOT LIKE '21%' 
    AND b.`drugcode` NOT LIKE '22%' 
    AND b.`drugcode` NOT LIKE '23%' 
    AND b.`drugcode` NOT LIKE '24%' 
    AND b.`drugcode` NOT LIKE '25%' 
) 
AND a.`an` IS NULL 
AND ( b.`code24` IS NOT NULL AND b.`code24` != '' ) 
AND a.`status` = 'Y' 
GROUP BY a.`hn`";
$querytmp12 = mysql_query($temp12) or die( mysql_error() );


// $querytmp12 = mysql_query($temp12) or die("Query failed,Create temp12");

$sql12="SELECT date, hn, an, drugcode, tradname, amount, code24, unit, packing, salepri, unitpri From report_drugopd";
$result12= mysql_query($sql12) or die("Query failed, Select report_drugopd (drug_opd)");
$num=mysql_num_rows($result12);

$txt = '';
while (list ($date,$hn,$an,$drugcode,$dname,$amount,$didstd,$unit,$unit_packing,$drugprice,$drugcost) = mysql_fetch_row ($result12)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);

	$chkdate=substr($date,0,10);
	$sqlop=mysql_query("select thidate,vn from opday where hn ='$hn' and thidate like '$chkdate%'");
	list($thidate,$vn)=mysql_fetch_array($sqlop);


	$newclinic=substr($cliniccode,0,2);
	if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
	if(!empty($vn)){ $firstcode="0";}
	$treecode="00";
	$clinic=$firstcode.$newclinic.$treecode;

	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
	$vn=sprintf("%03d",$vn);	
	$seq=$date_serv.$vn;	  //ลำดับที่

	$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc);
	if(empty($doctorcode)){
		$provider=$date_serv.$vn."00000";
	}else{
		$provider=$date_serv.$vn.$doctorcode;
	}	

	// echo "$hospcode|$hn|$seq|$date_serv|$clinic|$didstd|$dname|$amount|$unit|$unit_packing|$drugprice|$drugcost|$provider|$d_update<br/>";
	
	
	$txt .= "$hospcode|$hn|$seq|$date_serv|$clinic|$didstd|$dname|$amount|$unit|$unit_packing|$drugprice|$drugcost|$provider|$d_update\r\n";
	
}  //close while

file_put_contents('new43file/drug_opd.txt', $txt);