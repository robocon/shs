<?php
//
//-------------------- Create file diagnosis_opd ไฟล์ที่ 15 --------------------//
//
$temp10 = "CREATE  TEMPORARY  TABLE report_diagnosisopd 
SELECT `thidate`, `hn`, `vn`, `doctor`, `clinic`, SUBSTRING(`thidate`, 1, 10) AS `date2`
FROM `opday` 
WHERE `hn` !='' 
AND ( `doctor` IS NOT NULL AND `doctor` != '' )
AND `thidate` LIKE '$thimonth%' 
GROUP BY `date2`, `hn`
ORDER BY `thidate`
";
$querytmp10 = mysql_query($temp10) or die("Query failed,Create temp10");

$sql10 = "SELECT * 
FROM report_diagnosisopd";
$result10 = mysql_query($sql10) or die("Query failed, Select report_diagnosisopd (diagnosis_opd)");
$num = mysql_num_rows($result10);

$ii = 0;
$txt = '';

while (list ($thidate,$hn,$vn,$doctor,$cliniccode) = mysql_fetch_row ($result10)) {
    
    // $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
    // list($hospcode)=mysql_fetch_array($sqlhos);

    $chkdate = substr($thidate,0,10);	
    $sqlopd = "SELECT  regisdate,icd10,type 
    From diag 
    where hn='$hn' 
    and svdate like '$chkdate%'
    GROUP BY `icd10`";
    
    $resultopd = mysql_query($sqlopd);	
    $numopd = mysql_num_rows($resultopd);
    
    if($numopd > 1){  //ถ้ามีหลาย record
        while(list($regisdate,$icd10,$type) = mysql_fetch_array($resultopd)){

            if(empty($icd10)){
                $diagcode = "Z538";
                $diagtype = "1";
            }else{
                $diagcode = $icd10;
                if($type == "PRINCIPLE"){ $diagtype = "1";}
                if($type == "CO-MORBIDITY"){ $diagtype = "2";}
                if($type == "COMPLICATION"){ $diagtype = "3";}
                if($type == "OTHER"){ $diagtype = "4";}
                if($type == "EXTERNAL CAUSE"){ $diagtype = "5";}	
            }
            
            $newclinic = substr($cliniccode,0,2);
            if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
            if(!empty($vn)){ $firstcode="0";}
            $treecode="00";
            $clinic = $firstcode.$newclinic.$treecode;	

            $regis1 = substr($thidate,0,10);
            $regis2 = substr($thidate,11,19);
            list($yy,$mm,$dd) = explode("-",$regis1);
            $yy = $yy-543;
            list($hh,$ss,$ii) = explode(":",$regis2);
            $d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

            $regis1 = substr($thidate,0,10);
            $regis2 = substr($thidate,11,19);
            list($yy,$mm,$dd) = explode("-",$regis1);
            $yy = $yy-543;
            $date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
            $vn = sprintf("%03d",$vn);	
            $seq = $date_serv.$vn;	  //ลำดับที่

            $sqldoc = mysql_query("select doctorcode from doctor where name like'%$doctor%'");
            list($doctorcode) = mysql_fetch_array($sqldoc);
            if(empty($doctorcode)){
                $provider = $date_serv.$vn."00000";
            }else{
                $provider = $date_serv.$vn.$doctorcode;
            }	

            $inline = "$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update\r\n";
            // print($inline);
            $txt .= $inline;
            
        }  //close while
    }else{  //ถ้ามี 1 record
    
        list($regisdate,$icd10,$type) = mysql_fetch_array($resultopd);

        if(empty($icd10)){
            $diagcode = "Z538";
            $diagtype = "1";
        }else{
            $diagcode = $icd10;
            if($type == "PRINCIPLE"){ $diagtype = "1";}
            if($type == "CO-MORBIDITY"){ $diagtype = "2";}
            if($type == "COMPLICATION"){ $diagtype = "3";}
            if($type == "OTHER"){ $diagtype = "4";}
            if($type == "EXTERNAL CAUSE"){ $diagtype = "5";}	
        }
        
        $newclinic = substr($cliniccode,0,2);
        if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
        if(!empty($vn)){ $firstcode="0";}
        $treecode = "00";
        $clinic = $firstcode.$newclinic.$treecode;

        $regis1 = substr($thidate,0,10);
        $regis2 = substr($thidate,11,19);
        list($yy,$mm,$dd) = explode("-",$regis1);
        $yy = $yy-543;
        list($hh,$ss,$ii) = explode(":",$regis2);
        $d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

        $regis1 = substr($thidate,0,10);
        $regis2 = substr($thidate,11,19);
        list($yy,$mm,$dd) = explode("-",$regis1);
        $yy = $yy-543;
        $date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
        $vn = sprintf("%03d",$vn);	
        $seq = $date_serv.$vn;	  //ลำดับที่

        $sqldoc = mysql_query("select doctorcode from doctor where name like'%$doctor%'");
        list($doctorcode) = mysql_fetch_array($sqldoc);
        if(empty($doctorcode)){
            $provider = $date_serv.$vn."00000";
        }else{
            $provider = $date_serv.$vn.$doctorcode;
        }	

        $inline = "$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update\r\n";
        // print($inline);
        $txt .= $inline;
        
    }  // close while
}  //close if
$filePath = $dirPath.'/diagnosis_opd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|DIAGTYPE|DIAGCODE|CLINIC|PROVIDER|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_diagnosis_opd.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม diagnosis_opd เสร็จเรียบร้อย<br>";