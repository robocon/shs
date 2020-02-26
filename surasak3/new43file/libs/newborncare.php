<?php 

list($year, $month, $day) = explode('-', $thimonth);

$dServ = ( $year - 543 ).$month.$day;

$sql = "SELECT * 
FROM `43newborncare` 
WHERE `D_UPDATE` LIKE '$dServ%' ";
$q = mysql_query($sql, $db2);

while ( $item = mysql_fetch_assoc($q) ) {

    $txt .= $item['HOSPCODE']
    .'|'.$item['PID']
    .'|'.$item['SEQ']
    .'|'.$item['BDATE']
    .'|'.$item['BCARE']
    .'|'.$item['BCPLACE']
    .'|'.$item['BCARERESULT']
    .'|'.$item['FOOD']
    .'|'.$item['PROVIDER']
    .'|'.$item['D_UPDATE']
    .'|'.$item['CID']."\r\n";

}

$filePath = $dirPath.'/newborncare.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|BDATE|BCARE|BCPLACE|BCARERESULT|FOOD|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_newborncare.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม newborncare เสร็จเรียบร้อย<br>";