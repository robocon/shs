<?php 

// $db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
// mysql_select_db('smdb', $db2) or die( mysql_error() );

//-------------------- Create file procedure_opd ไฟล์ที่ 11 --------------------//
$temp11="CREATE  TEMPORARY  TABLE report_procedureopd 
SELECT thidate, hn, vn, doctor, clinic, icd9cm, icd10, TRIM(idcard) 
FROM opday 
WHERE thidate LIKE '$thimonth%' 
AND icd9cm IS NOT NULL 
AND icd9cm <> '' 
ORDER BY thidate ASC";

$querytmp11 = mysql_query($temp11, $db2) or die("Query failed,Create temp11");

$sql11="SELECT * FROM report_procedureopd";
$result11= mysql_query($sql11, $db2) or die("Query failed, Select report_procedureopd (procedure_opd)");
$num=mysql_num_rows($result11);
$txt = '';
while (list ($thidate,$hn,$vn,$doctor,$cliniccode,$procedcode,$icd10, $idcard) = mysql_fetch_row ($result11)) {	
	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);


    // $newclinic=substr($cliniccode,0,2);
    // if($newclinic=="" || $newclinic=="ศั"){ 
    //     $newclinic="99";
    // }else{ 
    //     $newclinic=$newclinic;
    // }


    $test_match = preg_match('^\d{2}.+', $cliniccode, $matchs);
    if($test_match > 0){
        list($old_clinic_code, $name) = explode(' ', $cliniccode);

        $cliniccode = $name;
    }

    $q = mysql_query("SELECT `code` FROM `clinic` WHERE detail LIKE '$cliniccode%'", $db2) or die( mysql_error() );
    $newclinic = '99';
    if( mysql_num_rows($q) > 0 ){
        $item = mysql_fetch_assoc($q);
        $newclinic = trim($item['code']);
    }

    

    $firstcode="0";
    // if(!empty($vn)){ $firstcode="0";}
    $treecode="00";

    if($newclinic == '88'){
        $clinic = '08800';
    }else{
        $clinic=trim($firstcode.$newclinic.$treecode);
    }


    

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
        
    $sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'", $db2);
    list($doctorcode)=mysql_fetch_array($sqldoc);
    if(empty($doctorcode)){
        $provider=$date_serv.$vn."00000";
    }else{
        $provider=$date_serv.$vn.$doctorcode;
    }	

    $serviceprice="0.00";


    // $procedcode = $icd10;
    // if( empty($procedcode) ){
        // $sql = "SELECT `icd9cm` FROM `opicd9cm` WHERE `svdate` LIKE '' AND `hn` = '' AND `vn` = '' ";
        // $icd9query = mysql_query($sql);

        // $icd9 = mysql_fetch_assoc($icd9query);

        // $procedcode = $icd9['icd9cm'];
    // }


    $txt .= "$hospcode|$hn|$seq|$date_serv|$clinic|$procedcode|$serviceprice|$provider|$d_update|$idcard\r\n";
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

// dump($txt);

// exit;

$filePath = $dirPath.'/procedure_opd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|SEQ|DATE_SERV|CLINIC|PROCEDCODE|SERVICEPRICE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_procedure_opd.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม procedure_opd เสร็จเรียบร้อย<br>";
//-------------------- Close file procedure_opd ไฟล์ที่ 11 --------------------//