<?php 

list($year, $month, $day) = explode('-', $thimonth);

$dServ = ( $year - 543 ).$month.$day;

$sql = "SELECT * FROM `43newborncare` WHERE `SEQ` LIKE '$dServ%' ";
$q = mysql_query($sql, $db2);
$txt = '';
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

$headerQof = "HOSPCODE|PID|SEQ|BDATE|BCARE|BCPLACE|BCARERESULT|FOOD|PROVIDER|D_UPDATE|CID\r\n";
$qofPath = $dirPath.'/qof_newborncare.txt';
file_put_contents($qofPath, $headerQof.$txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม newborncare เสร็จเรียบร้อย<br>";