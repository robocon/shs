<?php
//
//-------------------- Create file admission ไฟล์ที่ 23 --------------------//
// 
$temp14 = "CREATE TEMPORARY  TABLE report_admission 
SELECT `date`,`an`,`hn`,`ptright`,`clinic`,`my_ward`,`dcdate`,`dcstatus`,`dctype`,`doctor` 
FROM `ipcard` 
WHERE `dcdate` LIKE '$thimonth%' 
AND ( 
    `dcdate` IS NOT NULL 
    AND `dcdate` != '0000-00-00 00:00:00' 
)";
$querytmp14 = mysql_query($temp14) or die("Query failed,Create temp14");

$sql14="SELECT * 
FROM report_admission";
$result14 = mysql_query($sql14) or die("Query failed,Select report_admission");

$txt = '';
while (list ($date,$an,$hn,$ptright,$clinic,$my_ward,$dcdate,$dcstatus,$dctype,$doctor) = mysql_fetch_row ($result14)){
    
    $sqlopd = mysql_query("SELECt `weight`,`height` FROM `opd` WHERE `hn`='$hn' ORDER BY `row_id` DESC");
    list($admitweight,$admitheight)=mysql_fetch_array($sqlopd);
    
    list($predate, $pretime) = explode(' ', $date);
    list($year, $month, $day) = explode('-', $predate);
    list($hour, $min, $sec) = explode(':', $pretime);
    $datetime_admit = ($year-543)."$month$day$hour$min$sec";

    $num2 = 543;
    $d = substr($date,8,2);
    $m = substr($date,5,2); 
    $y = substr($date,0,4); 
    $y1 = $y-$num2;
    $y2 = substr($y1,2,2);
    $dateserv = "$y1$m$d";

    // เปลี่ยนจาก seq จาก hn เป็น vn
    // list($hn1,$hn2) = explode("-",$hn);
    // $seq = $dateserv.$hn1.$hn2;

    $thdatehn = "$d-$m-$y$hn";
    $q = mysql_query("SELECT `vn`,`idcard` FROM `opday` WHERE `thdatehn` = '$thdatehn' LIMIT 1 ");
    $item = mysql_fetch_assoc($q);
    $vn = $item['vn'];
    $cid = $item['idcard'];
    $seq = $dateserv.sprintf("%03d", $item['vn']);

    $regis1 = substr($date,0,10);
    $regis2 = substr($date,11,19);
    list($yy,$mm,$dd) = explode("-",$regis1);
    list($hh,$ss,$ii) = explode(":",$regis2);
    $d_update = ($yy-543).$mm.$dd.$hh.$ss.$ii;
    
    $dcdate1 = substr($dcdate,0,10);
    $dcdate2 = substr($dcdate,11,19);
    list($yy,$mm,$dd) = explode("-",$dcdate1);
    list($hh,$ss,$ii) = explode(":",$dcdate2);
    $datetime_disch = ($yy-543).$mm.$dd.$hh.$ss.$ii;	
    
    if( !empty($clinic) ){
        $newclinic = substr($clinic,0,2);
        if($newclinic == "12"){
            $newclinic = "99";
        }
    }else{
        $clinic = '99';
    }
    
    $newptright = substr($ptright,0,3);
    if($newptright == "R01" || $newptright == "R05"){
        $instype = "9100";
    }else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){
        $instype = "1100";
    }else if($newptright=="R06"){
        $instype = "6100";
    }else if($newptright=="R07"){
        $instype = "4200";
    }else if($newptright=="R09"){
        $instype = "0100";
    }
    
    $typein = "1";

    // วิธีการการจำหน่ายผู้ป่วย ถ้าเป็น null ตีเป็น 1
    $dctype = trim($dctype);
    $dischtype = ( !empty($dctype) ) ? substr($dctype, 0, 1) : 1 ;

    // สถานะภาพการจำหน่ายผู้ป่วย ถ้าเป็น null ตีเป็น 1
    $dischstatus = ( !empty($dcstatus) ) ? $dcstatus : 1 ;
    
    $ipmonsql = mysql_query("SELECT `price`,`cash`,`credit` FROM `ipmonrep` WHERE `an` = '$an'");
    list($price, $cash, $credit)=mysql_fetch_array($ipmonsql);
    
    if($credit == "เงินสด" || $credit == "อื่นๆ"){
        $price = $cash;
        $payprice = $cash;
        $actualpay = $cash;
    }else{
        $payprice = 0;
        $actualpay = 0;	
    }
    
    // รหัส5ตัวหน้าของหมอ
    $doctor = substr($doctor,0,5);
    
    // date_serv สำหรับ provider
    list($yy,$mm,$dd) = explode("-", $regis1);
    $yy = $yy - 543;
    $date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
    
    // provider
    $sqldoc = mysql_query("select doctorcode FROM doctor WHERE name LIKE'%$doctor%'");
    list($doctorcode) = mysql_fetch_array($sqldoc);
    if(empty($doctorcode)){
        $provider = $date_serv.$vn."00000";
    }else{
        $provider = $date_serv.$vn.$doctorcode;
    }   

    // 87,88,91,96,128,133,141,145,147,151.รหัสแผนกที่รับบริการ 26Sep16.xls
    $wardadmit = $warddisch = '1'.$newclinic.'00';
    
    $causein = "1";  //สาเหตุการส่งผู้ป่วย
    $cost = "0.00";  //ราคาทุน 

    $drg = '';
    $rw = '';
    $adjrw = '';
    $error = '';
    $warning = '';
    $actlos = '';
    $grouper_version = '';

    $admitweight = number_format($admitweight, 1);
    $admitheight = number_format($admitheight, 2);
    $price = number_format($price, 2);

    $inline = "$hospcode|$hn|$seq|$an|$datetime_admit|$wardadmit|$instype|$typein|$referinhosp|$causein|$admitweight|$admitheight|$datetime_disch|$warddisch|$dischstatus|$dischtype|$referouthosp|$causeout|$cost|$price|$payprice|$actualpay|$provider|$d_update|$drg|$rw|$adjrw|$error|$warning|$actlos|$grouper_version|$cid\r\n";
    
    $txt .= $inline;
} // End while
$filePath = $dirPath.'/admission.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|AN|DATETIME_ADMIT|WARDADMIT|INSTYPE|TYPEIN|REFERINHOSP|CAUSEIN|ADMITWEIGHT|ADMITHEIGHT|DATETIME_DISCH|WARDDISCH|DISCHSTATUS|DISCHTYPE|REFEROUTHOSP|CAUSEOUT|COST|PRICE|PAYPRICE|ACTUALPAY|PROVIDER|D_UPDATE|DRG|RW|ADJRW|ERROR|WARNING|ACTLOS|GROUPER_VERSION|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_admission.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม admission เสร็จเรียบร้อย<br>";