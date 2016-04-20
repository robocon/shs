<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<body>
<?
include("../../../connect.inc");
//$newyear="25580101";
//$yrmonth="2015";
$thimonth="2558-01";

//-------------------- Create file person ไฟล์ที่ 1 --------------------//
$temp10="CREATE  TEMPORARY  TABLE report_diagnosisopd SELECT thidate, hn, vn, doctor, clinic FROM opday WHERE hn !='' and thidate like '$thimonth%' ORDER BY thidate ASC";
//echo $temp10;
$querytmp10 = mysql_query($temp10) or die("Query failed,Create temp10");

$sql10="SELECT thidate, hn, vn, doctor, clinic From report_diagnosisopd";
$result10= mysql_query($sql10) or die("Query failed, Select report_diagnosisopd (diagnosis_opd)");
$num=mysql_num_rows($result10);
//echo "$num <br>";
while (list ($thidate,$hn,$vn,$doctor,$cliniccode) = mysql_fetch_row ($result10)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
$chkdate=substr($thidate,0,10);	
$sqlopd="SELECT  regisdate,icd10,type From diag where hn='$hn' and svdate like '$chkdate%'";
$resultopd=mysql_query($sqlopd);	
$numopd=mysql_num_rows($resultopd);
if($numopd > 1){  //ถ้ามีหลาย record
	while(list($regisdate,$icd10,$type)=mysql_fetch_array($resultopd)){
	
	if(empty($icd10)){
	$diagcode="Z538";
	}else{
	$diagcode=$icd10;
	}
	
	if($type=="PRINCIPLE"){ $diagtype="1";}
	if($type=="CO-MORBIDITY"){ $diagtype="2";}
	if($type=="COMPLICATION"){ $diagtype="3";}
	if($type=="OTHER"){ $diagtype="4";}
	if($type=="EXTERNAL CAUSE"){ $diagtype="5";}
	
	
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
	
	$strText10="$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update\r\n";
	echo $strText10."<br>";
	}  //close while
}else{  //ถ้ามี 1 record
	list($regisdate,$icd10,$type)=mysql_fetch_array($resultopd);
	
	if(empty($icd10)){
	$diagcode="Z538";
	}else{
	$diagcode=$icd10;
	}
	
	if($type=="PRINCIPLE"){ $diagtype="1";}
	if($type=="CO-MORBIDITY"){ $diagtype="2";}
	if($type=="COMPLICATION"){ $diagtype="3";}
	if($type=="OTHER"){ $diagtype="4";}
	if($type=="EXTERNAL CAUSE"){ $diagtype="5";}
	
	
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
	
	$strText10="$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update\r\n";
	echo $strText10."<br>";
}

}
?>
</body>
</html>
