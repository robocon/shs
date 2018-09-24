<?php
//-------------------- Create file card ไฟล์ที่ 4 --------------------//
$sql = "SELECT a.`regisdate`,a.`hn`,a.`ptright`,a.`ptrightdetail`,SUBSTRING(a.`hospcode`, 1, 5) AS `hospcode`,b.`idcard`,b.`date_start`,b.`date_expire`,c.`code`,
a.`idcard` 
FROM `opcard` AS a, `sso30` AS b, `ptrightdetail` AS c 
WHERE b.`idcard` = a.`idcard` 
AND c.`detail` = a.`ptrightdetail` ";
$querytmp4 = mysql_query($sql) or die( mysql_error() );

$txt = '';
while( $item = mysql_fetch_assoc($querytmp4) ){
    
    $hospcode = $item['hospcode'];
    if( preg_match('/\d{5}/', $item['hospcode']) === 0 ){
        $hospcode = '11512';
    }

    $cid = $item['idcard'];
    $regisdate = $item['regisdate'];
    $hn = $item['hn'];
    $ptright = $item['ptright'];
    $ptrightdetail = $item['ptrightdetail'];
    $main = $hospcode;
    $startdate = str_replace('-', '', $item['date_start']);
    $expiredate = str_replace('-', '', $item['date_expire']);
    $instype_new = $item['code'];

    $regis1 = substr($regisdate,0,10);
    $regis2 = substr($regisdate,11,19);
    list($yy,$mm,$dd) = explode("-",$regis1);
    list($hh,$ss,$ii) = explode(":",$regis2);
    $d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
    
    $instype_old = "";
    $inside = "";  //เลขที่บัตรตามสิทธิ
    // $startdate = "";  //วันเดือนปีที่ออกบัตร
    // $expiredate = "";  //วันเดือนปีที่หมดอายุ
    $main = substr($main,0,5);  //สถานบริการหลัก
    $sub = substr($main,0,5);  //สถานบริการรอง
    $txt .= "$hospcode|$hn|$instype_old|$instype_new|$inside|$startdate|$expiredate|$main|$sub|$d_update|$cid\r\n";	
    
}  //close while

$filePath = $dirPath.'/card.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|INSTYPE_OLD|INSTYPE_NEW|INSID|STARTDATE|EXPIREDATE|MAIN|SUB|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_card.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม card เสร็จเรียบร้อย<br>";

//-------------------- Close file card ไฟล์ที่ 4 --------------------//