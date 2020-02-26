<?php 

list($year, $month, $day) = explode('-', $thimonth);

$dServ = ( $year - 543 ).$month.$day;

$sql = "SELECT * 
FROM `43newborn` 
WHERE `D_UPDATE` LIKE '$dServ%' ";
$q = mysql_query($sql, $db2);

while ( $item = mysql_fetch_assoc($q) ) {

    $txt .= $item['HOSPCODE']
        .'|'.$item['PID']
        .'|'.$item['MPID']
        .'|'.$item['GRAVIDA']
        .'|'.$item['GA']
        .'|'.$item['BDATE']
        .'|'.$item['BTIME']
        .'|'.$item['BPLACE']
        .'|'.$item['BHOSP']
        .'|'.$item['BIRTHNO']
        .'|'.$item['BTYPE']
        .'|'.$item['BDOCTOR']
        .'|'.$item['BWEIGHT']
        .'|'.$item['ASPHYXIA']
        .'|'.$item['VITK']
        .'|'.$item['TSH']
        .'|'.$item['TSHRESULT']
        .'|'.$item['D_UPDATE']
        .'|'.$item['CID']."\r\n";

}

$filePath = $dirPath.'/newborn.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|MPID|GRAVIDA|GA|BDATE|BTIME|BPLACE|BHOSP|BIRTHNO|BTYPE|BDOCTOR|BWEIGHT|ASPHYXIA|VITK|TSH|TSHRESULT|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_newborn.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม newborn เสร็จเรียบร้อย<br>";