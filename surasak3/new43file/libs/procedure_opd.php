<?php
//-------------------- Create file procedure_opd ไฟล์ที่ 11 --------------------//
$temp11="CREATE  TEMPORARY  TABLE report_procedureopd SELECT thidate, hn, vn, doctor, clinic, icd9cm FROM opday WHERE thidate like '$thimonth%' and icd9cm != 'NA' and icd9cm != '' ORDER BY thidate ASC";
//echo $temp11;
$querytmp11 = mysql_query($temp11) or die("Query failed,Create temp11");

$sql11="SELECT thidate, hn, vn, doctor, clinic, icd9cm From report_procedureopd";
$result11= mysql_query($sql11) or die("Query failed, Select report_procedureopd (procedure_opd)");
$num=mysql_num_rows($result11);
$txt = '';
while (list ($thidate,$hn,$vn,$doctor,$cliniccode,$procedcode) = mysql_fetch_row ($result11)) {	
	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);


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

    $serviceprice="0.00";
    $txt .= "$hospcode|$hn|$seq|$date_serv|$clinic|$procedcode|$serviceprice|$provider|$d_update\r\n";
    // $strFileName11 = "procedure_opd.txt";
    // $objFopen11 = fopen($strFileName11, 'a');
    // fwrite($objFopen11, $strText11);
                
    // if($objFopen11){
    //     /*echo "File writed.";*/
    // }else{
    //     /*echo "File can not write";*/
    // }
    // fclose($objFopen11);
}  //close while
$filePath = $dirPath.'/procedure_opd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|SEQ|DATE_SERV|CLINIC|PROCEDCODE|SERVICEPRICE|PROVIDER|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_procedure_opd.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม procedure_opd เสร็จเรียบร้อย<br>";
//-------------------- Close file procedure_opd ไฟล์ที่ 11 --------------------//