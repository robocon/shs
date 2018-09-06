<?php 

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

$sql = "SELECT '11512' AS `HOSPCODE`,
`hn` AS `PID`, 
'' AS `GRAVIDA`, 
'' AS `LMP`, 
'' AS `EDC`, 
'' AS `VDRL_RESULT`, 
'' AS `HB_RESULT`, 
'' AS `HIV_RESULT`, 
'' AS `DATE_HCT`, 
'' AS `HCT_RESULT`, 
'' AS `THALASSEMIA`, 
thDateTimeToEn(`thidate`) AS `D_UPDATE`, 
CONCAT(thDateToEn(`thidate`), LPAD(`vn`, 3, 0),'0000') AS `PROVIDER`, 
`idcard` AS `CID` 
FROM `opday` 
WHERE `thidate` LIKE '$thimonth%' 
AND `toborow` LIKE 'ex08%' ";

$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = '';

while ( $item = mysql_fetch_assoc($q) ) {

    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$item['GRAVIDA'].'|'
    .$item['LMP'].'|'
    .$item['EDC'].'|'
    .$item['VDRL_RESULT'].'|'
    .$item['HB_RESULT'].'|'
    .$item['HIV_RESULT'].'|'
    .$item['DATE_HCT'].'|'
    .$item['HCT_RESULT'].'|'
    .$item['THALASSEMIA'].'|'
    .$item['D_UPDATE'].'|'
    .$item['PROVIDER'].'|'
    .$item['CID']."\r\n";

}

$filePath = $dirPath.'/prenatal.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|GRAVIDA|LMP|EDC|VDRL_RESULT|HB_RESULT|HIV_RESULT|DATE_HCT|HCT_RESULT|THALASSEMIA|D_UPDATE|PROVIDER|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_prenatal.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม prenatal เสร็จเรียบร้อย<br>";

mysql_close($db2);