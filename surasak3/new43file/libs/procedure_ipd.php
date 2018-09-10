<?php
//-------------------- Create file procedure_ipd ไฟล์ที่ 16 --------------------//
$temp16="CREATE  TEMPORARY  TABLE report_admission2 
SELECT `clinic`,`doctor`,`date`,`an`,`hn`  
FROM `ipcard` 
WHERE `dcdate` LIKE '$thimonth%' 
AND `dcdate` IS NOT NULL 
AND `dcdate` <> '' ";
$querytmp16 = mysql_query($temp16) or die("Query failed,Create temp16");

$sql16="SELECT a.admdate,a.an,a.icd9cm,b.hn,b.clinic,b.doctor,b.date 
FROM  ipicd9cm as a,
report_admission2 as b 
WHERE a.an = b.an";
$result16 = mysql_query($sql16) or die("Query failed,Select report_admission2 And ipicd9cm");
$txt = '';
while (list ($admdate,$an,$icd9cm,$hn,$my_ward,$doctor,$date) = mysql_fetch_row ($result16)) {	

	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);
	$procedcode=$icd9cm;
	
	$chkdate=substr($date,0,10);	
	$sqlopd1="select vn,ipcard from opday where thidate like '$chkdate%' and hn='$hn'";
	
	$resultopd1=mysql_query($sqlopd1);	
	list($vn, $idcard)=mysql_fetch_array($resultopd1);			
	
	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$datetime_admit="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลาที่รับบริการ	
	
	$vn=sprintf("%03d",$vn);
	$date_serv="$yy$mm$dd";  //วันที่มารับบริการ	
	
	$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc);
	if(empty($doctorcode)){
	$provider=$date_serv.$vn."00000";
	}else{
	$provider=$date_serv.$vn.$doctorcode;
	}	
	
	if($myward=="หอผู้ป่วย ICU"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยสูติ"){
		$wardstay="10300";
	}else if($myward=="หอผู้ป่วยรวม"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยพิเศษ"){
		$wardstay="10200";
	}else{
		$wardstay="19900";
	}	
	
	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	
	$timestart=$datetime_admit;
	$timefinish=$datetime_admit;
	$serviceprice="0.00";
	
    $txt .= "$hospcode|$hn|$an|$datetime_admit|$wardstay|$procedcode|$timestart|$timefinish|$serviceprice|$provider|$d_update|$idcard\r\n";					
    // $strFileName16 = "procedure_ipd.txt";
    // $objFopen16 = fopen($strFileName16, 'a');
    // fwrite($objFopen16, $strText16);
                
    // if($objFopen16){
    //     /*echo "File writed.";*/
    // }else{
    //     /*echo "File can not write";*/
    // }
    // fclose($objFopen16);
}  //close while
$filePath = $dirPath.'/procedure_ipd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|AN|DATETIME_ADMIT|WARDSTAY|PROCEDCODE|TIMESTART|TIMEFINISH|SERVICEPRICE|PROVIDER|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_procedure_ipd.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม procedure_ipd เสร็จเรียบร้อย<br>";
//-------------------- Close file procedure_ipd ไฟล์ที่ 16 --------------------//