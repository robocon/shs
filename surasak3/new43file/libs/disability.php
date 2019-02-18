<?php

list($y, $m, $d) = explode('-', $thimonth);

$date_serv_selected = ( $y - 543 ).$m.$d;

// สำรวจปีละ 1 ครั้ง ตามรอบปีงบประมาณ
$sql = "SELECT 
`hospcode` AS `HOSPCODE`, 
`disabid` AS `DISABID`, 
`pid` AS `PID`, 
`disabtype` AS `DISABTYPE`, 
`disabcause` AS `DISABCAUSE`, 
`diagcode` AS `DIAGCODE`, 
`date_detect` AS `DATE_DETECT`, 
`date_disab` AS `DATE_DISAB`, 
`d_update` AS `D_UPDATE`, 
`cid` AS `CID` 
FROM `disability43` 
WHERE `d_update` LIKE '$date_serv_selected%' ";

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
    .$item['D_UPDATE'].'|'
    .$item['CID']."\r\n";
}

$filePath = $dirPath.'/disability.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|DISABID|PID|DISABTYPE|DISABCAUSE|DIAGCODE|DATE_DETECT|DATE_DISAB|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_disability.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม disability เสร็จเรียบร้อย<br>";