<?php 

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );
mysql_query("SET NAMES UTF8", $db2);

$sql = "SELECT '11512' AS `HOSPCODE`,
`hn` AS `PID`, 
`vn` AS `SEQ`, 
thDateToEn(`thidate`) AS `DATE_SERV`, 
'' AS `GRAVIDA`, 
'' AS `ANCNO`, 
'' AS `GA`, 
'' AS `ANCRESULT`, 
'' AS `ANCPLACE`, 
CONCAT(thDateToEn(`thidate`), LPAD(`vn`, 3, 0),'0000') AS `PROVIDER`, 
thDateTimeToEn(`thidate`) AS `D_UPDATE`, 
`idcard` AS `CID`
FROM `opday` 
WHERE `thidate` LIKE '$thimonth%' 
AND `toborow` LIKE 'ex08%' ";

$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = '';

while ( $item = mysql_fetch_assoc($q) ) {

    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$item['SEQ'].'|'
    .$item['DATE_SERV'].'|'
    .$item['GRAVIDA'].'|'
    .$item['ANCNO'].'|'
    .$item['GA'].'|'
    .$item['ANCRESULT'].'|'
    .$item['ANCPLACE'].'|'
    .$item['PROVIDER'].'|'
    .$item['D_UPDATE'].'|'
    .$item['CID']."\r\n";

}
mysql_close($db2);


$filePath = $dirPath.'/anc.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|GRAVIDA|ANCNO|GA|ANCRESULT|ANCPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_anc.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;