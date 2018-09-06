<?php

//
//-------------------- Create file service ไฟล์ที่ 14 --------------------//
// 
$temp7 = "CREATE TEMPORARY TABLE report_service 
SELECT a.`thidate`,a.`hn`,a.`vn`,a.`an`,a.`ptname`,a.`ptright`,a.`goup`,a.`toborow`, SUBSTRING(a.`thidate`, 1, 10) AS `date2`,a.`idcard`, 
b.`ptrightdetail`, 
c.`temperature`, c.`pause`, c.`rate`, c.`bp1`, c.`bp2`, c.`organ`
FROM `opday` AS a
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
LEFT JOIN `opd` AS c ON c.`thdatehn` = a.`thdatehn`
WHERE a.`thidate` LIKE '$thimonth%' 
GROUP BY `date2`, a.`hn` 
ORDER BY a.`thidate` ASC";
$querytmp7 = mysql_query($temp7) or die("Query failed,Create temp7");

$temp71 = "CREATE TEMPORARY TABLE report_serviceopacc 
SELECT date,paid,hn,credit,txdate 
FROM opacc 
WHERE txdate LIKE '$thimonth%' ";
$querytmp71 = mysql_query($temp71) or die("Query failed,Create temp71");

$sql7="SELECT * 
FROM report_service";
$result7 = mysql_query($sql7) or die("Query failed, SELECT report_service (service)");
$num = mysql_num_rows($result7);

$txt = '';
while ( list($thidate,$hn,$vn,$an,$ptname,$ptright,$goup,$toborow,$date2,$idcard,$ptrightdetail,$btemp,$pr,$rr,$sbp,$dbp,$organ) = mysql_fetch_row ($result7) ) {	

    $sql = "SELECT SUM(paid),credit FROM report_serviceopacc WHERE hn = '$hn' AND txdate LIKE '$thimonth%'  ";
    list($price,$credit)  = mysql_fetch_row(mysql_query($sql));
        
    $sql1 = "SELECT SUM(paid) FROM report_serviceopacc WHERE hn = '$hn' AND txdate LIKE '$thimonth%' AND credit = 'เงินสด' ";
    list($paycash)  = mysql_fetch_row(mysql_query($sql1));
    $payprice = $paycash;
    if(empty($payprice) || $payprice==0){
        $payprice = "0.00";
    }
    $actualpay=$paycash;
    if(empty($actualpay) || $actualpay==0){
        $actualpay = "0.00";
    }	
    $date = substr($date,0,10);
    list($yy,$mm,$dd) = explode("-",$date);
    $yy = $yy-543;
    $daterecord = "$yy$mm$dd";

    $regis1 = substr($thidate,0,10);
    $regis2 = substr($thidate,11,19);
    list($yy,$mm,$dd) = explode("-",$regis1);
    $yy = $yy-543;
    list($hh,$ss,$ii) = explode(":",$regis2);
    $d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
    $date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
    $time_serv = "$hh$ss$ii";  //เวลาที่มารับบริการ

    $vn = sprintf("%03d",$vn);
    $seq = $date_serv.$vn;	  //ลำดับที่

    $location = "1";  //ที่ตั้งของที่อยู่ผู้มารับบริการ
    if($toborow == "EX04 ผู้ป่วยนัด"){
        $typein = "2";  //ประเภทการมารับบริการ
        $intime = "1";  //เวลามารับบริการ
    }else if($toborow == "EX11 รักษาโรคนอกเวลาราชการ"){
        $typein = "1";  //ประเภทการมารับบริการ
        $intime = "2";  //เวลามารับบริการ
    }else  if($toborow == "EX01 รักษาโรคทั่วไปในเวลาราชการ"){
        $typein = "1";  //ประเภทการมารับบริการ
        $intime = "1";	  //เวลามารับบริการ	
    }else{
        $typein = "1";  //ประเภทการมารับบริการ
        $intime = "1";  //เวลามารับบริการ
    }
    
    // ถ้ามี ptrightdetail
    if( !empty($ptrightdetail) ){
        $sqlptr = "SELECT code FROM  ptrightdetail WHERE detail='$ptrightdetail'";
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
        $typeout = "2";    //รับไว้รักษาต่อ
    }else{
        $typeout = "1";  //กลับบ้าน
    }
    
    $insid = "";  //เลขที่บัตรตามสิทธิ
    $causein = "1";  //สาเหตุการส่งผู้ป่วย
    $servplace = "1";  //สถานที่บริการ
    $referouthos = "";  //สถานพยาบาลที่ส่งต่อ
    
    $rn = array("\r\n", "\n", "\r");
    $organ1 = str_replace($rn," ",$organ);
    $organ2 = (string)$organ1;
    $chiefcomp = preg_replace('/[[:space:]]+/', '', trim($organ2)); 

    if(empty($price) || $price=="0.00"){
        $price="50.00";
    }

    $inline = "$hospcode|$hn|$hn|$seq|$date_serv|$time_serv|$location|$intime|$instype|$insid|$hospcode|$typein|$hospcode|$causein|$chiefcomp|$servplace|$btemp|$sbp|$dbp|$pr|$rr|$typeout|$referouthos|$caseout|$cost|$price|$payprice|$actualpay|$d_update|$idcard\r\n";			
    // print($inline);
    $txt .= $inline;
    
}  //close while
$filePath = $dirPath.'/service.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|HN|SEQ|DATE_SERV|TIME_SERV|LOCATION|INTIME|INSTYPE|INSID|MAIN|TYPEIN|REFERINHOSP|CAUSEIN|CHIEFCOMP|SERVPLACE|BTEMP|SBP|DBP|PR|RR|TYPEOUT|REFEROUTHOSP|CAUSEOUT|COST|PRICE|PAYPRICE|ACTUALPAY|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_service.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม service เสร็จเรียบร้อย<br>";