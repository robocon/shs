<?php
//-------------------- Create file appointment ไฟล์ที่ 8 --------------------//
$temp8="CREATE  TEMPORARY  TABLE report_appointment SELECT date,hn,appdate,doctor,detail,depcode From  appoint where date like '$thimonth%' ORDER BY date ASC";
//echo $temp8;
$querytmp8 = mysql_query($temp8) or die("Query failed,Create temp8");

$sql8="SELECT date,hn,appdate,doctor,detail,depcode From report_appointment";
$result8= mysql_query($sql8) or die("Query failed, Select report_appointment (appoint)");
$num=mysql_num_rows($result8);
$txt = '';
while (list ($date,$hn,$appdate,$doctor,$detail,$depcode) = mysql_fetch_row ($result8)) {	

	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);
	
    $chkdate=substr($date,0,10);	
    $sqlopd="select vn,clinic,icd10 from opday where thidate like '$chkdate%' and hn='$hn'";
    $resultopd=mysql_query($sqlopd);	
    list($vn,$cliniccode,$apdiag)=mysql_fetch_array($resultopd);

    $sqlipa="select an from ipcard where dcdate like '$chkdate%' and hn='$hn'";
    $resultipa=mysql_query($sqlipa);	
    list($an)=mysql_fetch_array($resultipa);	

    $newclinic=substr($cliniccode,0,2);
    if($newclinic==""){ $newclinic="99";}else{ $newclinic=$newclinic;}
    if(!empty($vn)){ $firstcode="0";}
    $treecode="00";
    $clinic=$firstcode.$newclinic.$treecode;

    $lenappdate=strlen($appdate);
    if($lenappdate < 12){
    list($app1,$app2,$app3)=explode("-",$appdate);
    list($yapp,$mapp,$dapp)=explode("-",$appdate);
    $yapp=$yapp-543;
    $apdate=$yapp.$mapp.$dapp;	
    }else{
    list($app1,$app2,$app3)=explode(" ",$appdate);
    if($app2=="มกราคม"){ $app2="01";}
    if($app2=="กุมภาพันธ์"){ $app2="02";}
    if($app2=="มีนาคม"){ $app2="03";}
    if($app2=="เมษายน"){ $app2="04";}
    if($app2=="พฤษภาคม"){ $app2="05";}
    if($app2=="มิถุนายน"){ $app2="06";}
    if($app2=="กรกฎาคม"){ $app2="07";}
    if($app2=="สิงหาคม"){ $app2="08";}
    if($app2=="กันยายน"){ $app2="09";}
    if($app2=="ตุลาคม"){ $app2="10";}
    if($app2=="พฤศจิกายน"){ $app2="11";}
    if($app2=="ธันวาคม"){ $app2="12";}
    if($app3=="2557"){ $app3="2014";}
    $apdate=$app3.$app2.$app1;
    }

    $regis1=substr($date,0,10);
    $regis2=substr($date,11,19);
    list($yy,$mm,$dd)=explode("-",$regis1);
    $yy=$yy-543;
    list($hh,$ss,$ii)=explode(":",$regis2);
    $d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
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

    $txt .= "$hospcode|$hn|$an|$seq|$date_serv|$clinic|$apdate|$aptype|$apdiag|$provider|$d_update\r\n";	
    // $strFileName8 = "appointment.txt";
    // $objFopen8 = fopen($strFileName8, 'a');
    // fwrite($objFopen8, $strText8);
                
    // if($objFopen8){
    //     /*echo "File writed.";*/
    // }else{
    //     /*echo "File can not write";*/
    // }
    // fclose($objFopen8);
}  //close while
$filePath = $dirPath.'/appointment.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|AN|SEQ|DATE_SERV|CLINIC|APDATE|APTYPE|APDIAG|PROVIDER|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_appointment.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม appointment เสร็จเรียบร้อย<br>";
//-------------------- Close file appointment ไฟล์ที่ 8 --------------------//