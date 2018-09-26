<?php

// รอบ 1ตค ถึง 30กย ของปีถัดไป
if( $rptmo >= 10 && $rptmo <= 12 ){
    $thiyr_end = $thiyr + 1;
}else{
    $thiyr_end = $thiyr;
}

// สำรวจปีละ 1 ครั้ง ตามรอบปีงบประมาณ
$sql = "SELECT 
'11512' AS `HOSPCODE`, 
'' AS `DISABID`, 
a.`hn` AS `PID`, 
a.`vn` AS `SEQ`, 
thDateToEn(SUBSTRING(a.`thidate`, 1, 10)) AS `DATE_SERRV`, 
b.`ICF`,
'' AS `QUALIFIER`,
'' AS `PROVIDER`,
thDateTimeToEn(a.`thidate`) AS `D_UPDATE`,
a.`idcard` AS `CID` 
FROM `opday` AS a 
LEFT JOIN `ICF` AS b ON b.`hn` = a.`hn`  
WHERE a.`thidate` LIKE '$thimonth%'
AND ( 
    a.`ptright` LIKE 'R12%' 
    OR a.`ptright` LIKE 'R40%' 
    OR a.`ptright` LIKE 'R27%' 
 );";
$q = mysql_query($sql) or die( mysql_error() );

$txt = "";
while ( $item = mysql_fetch_assoc($q) ) {
    $txt .= $item['HOSPCODE'].'|'
    .$item['DISABID'].'|'
    .$item['PID'].'|'
    .$item['SEQ'].'|'
    .$item['DATE_SERRV'].'|'
    .$item['ICF'].'|'
    .$item['QUALIFIER'].'|'
    .$item['PROVIDER'].'|'
    .$item['D_UPDATE'].'|'
    .$item['CID']
    ."\r\n";
}

$filePath = $dirPath.'/icf.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|DISABID|PID|SEQ|DATE_SERRV|ICF|QUALIFIER|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_icf.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม icf เสร็จเรียบร้อย<br>";