<?php
//-------------------- Create file drug_ipd ไฟล์ที่ 17 --------------------//
$temp17="CREATE  TEMPORARY  TABLE report_admission3 SELECT *  From ipcard where dcdate like '$thimonth%' and dcdate is not null";
$querytmp17 = mysql_query($temp17) or die("Query failed,Create temp17");

$sql="SELECT a.date,b.hn,a.an,a.code,a.detail,a.amount,b.date,b.dcdate,b.my_ward,b.doctor FROM ipacc as a, report_admission3 as b WHERE a.an=b.an and (part='DDL' or part='DDN' or part='DDY') group by a.code";
$result = mysql_query($sql) or die(mysql_error());
$txt = '';
while (list ($date,$hn,$an,$code,$dname,$amount,$admdate,$dcdate,$myward,$doctor) = mysql_fetch_row ($result)) {	

	$drugsql="select code24,unit,unitpri,salepri from druglst where drugcode = '$code'";
	//echo $drugsql."--->";
	$drugquery=mysql_query($drugsql);
	list($didstd,$unitpack,$drugcost,$drugprice)=mysql_fetch_array($drugquery);
	
	$drugsql1="select min(date) from ipacc where an='$an' and code = '$code'";
	$drugquery1=mysql_query($drugsql1);
	list($datestart)=mysql_fetch_array($drugquery1);	
	$start1=substr($datestart,0,10);
	$start2=substr($datestart,11,19);
	list($yy,$mm,$dd)=explode("-",$start1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$start2);
	$datestart="$yy$mm$dd$hh$ss$ii";  //วันที่เริ่มให้ยา
		
	
	$drugsql2="select max(date) from ipacc where an='$an' and code = '$code'";
	$drugquery2=mysql_query($drugsql2);
	list($datefinish)=mysql_fetch_array($drugquery2);		
	$finish1=substr($datefinish,0,10);
	$finish2=substr($datefinish,11,19);
	list($yy,$mm,$dd)=explode("-",$finish1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$finish2);
	$datefinish="$yy$mm$dd$hh$ss$ii";  //วันที่เลิกให้ยา
	
	$typedrug="1";
		
	
	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);
	
	$chkdate=substr($admdate,0,10);	
	$sqlopd1="select vn from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd1;
	$resultopd1=mysql_query($sqlopd1);	
	list($vn)=mysql_fetch_array($resultopd1);			
	
	$regis1=substr($admdate,0,10);
	$regis2=substr($admdate,11,19);
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
	
	$datestart=$datetime_admit;  //วันที่เริ่มให้ยา
	$datefinish=$datetime_admit;  //วันสุดท้ายที่ให้ยา

    $txt .= "$hospcode|$hn|$an|$datetime_admit|$wardstay|$typedrug|$didstd|$dname|$datestart|$datefinish|$amount|$unit|$unitpack|$drugprice|$drugcost|$provider|$d_update\r\n";

    // $strFileName17 = "drug_ipd.txt";
    // $objFopen17 = fopen($strFileName17, 'a');
    // fwrite($objFopen17, $strText17);
                
    // if($objFopen17){
    //     /*echo "File writed.";*/
    // }else{
    //     /*echo "File can not write";*/
    // }
    // fclose($objFopen17);
}  //close while
$filePath = $dirPath.'/drug_ipd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|AN|DATETIME_ADMIT|WARDSTAY|TYPEDRUG|DIDSTD|DNAME|DATESTART|DATEFINISH|AMOUNT|UNIT|UNIT_PACKING|DRUGPRICE|DRUGCOST|PROVIDER|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_drug_ipd.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม drug_ipd เสร็จเรียบร้อย<br>";
//-------------------- Close file drug_ipd ไฟล์ที่ 17 --------------------//