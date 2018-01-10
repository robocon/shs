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
`hn` AS `PID`, 
'' AS `DISABTYPE`, 
'' AS `DISABCAUSE`, 
'' AS `DIAGCODE`, 
'' AS `DATE_DETECT`, 
'' AS `DATE_DISAB`, 
thDateTimeToEn(`thidate`) AS `D_UPDATE` 
FROM `opcard` 
WHERE `lastupdate` >= '$thiyr-10-01' AND `thidate` <= '$thiyr_end-09-30'
AND ( `ptright` LIKE 'R12%' OR `ptright` LIKE 'R40%' );";
$q = mysql_query($sql) or die( mysql_error() );

$txt = "";
while ( $item = mysql_fetch_assoc($q) ) {
    $txt .= $item['HOSPCODE'].'|'
    .$item['DISABID'].'|'
    .$item['PID'].'|'
    .$item['DISABTYPE'].'|'
    .$item['DISABCAUSE'].'|'
    .$item['DIAGCODE'].'|'
    .$item['DATE_DETECT'].'|'
    .$item['DATE_DISAB'].'|'
    .$item['D_UPDATE']
    ."\r\n";
}

$filePath = $dirPath.'/disability.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|DISABID|PID|DISABTYPE|DISABCAUSE|DIAGCODE|DATE_DETECT|DATE_DISAB|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_disability.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม disability เสร็จเรียบร้อย";