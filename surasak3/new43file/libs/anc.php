<?php 

list($year, $month, $day) = explode('-', $thimonth);
$dServ = ( $year - 543 ).$month.$day;

$sql = "SELECT '11512' AS `HOSPCODE`,
`pid` AS `PID`, 
`seq` AS `SEQ`, 
`date_serv` AS `DATE_SERV`, 
`gravida` AS `GRAVIDA`, 
`ancno` AS `ANCNO`, 
`ga` AS `GA`, 
`ancres` AS `ANCRESULT`, 
`aplace` AS `ANCPLACE`, 
`provider` AS `PROVIDER`, 
`d_update` AS `D_UPDATE`, 
`cid` AS `CID`
FROM `anc` 
WHERE `date_serv` LIKE '$dServ%' ";
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

$filePath = $dirPath.'/anc.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|GRAVIDA|ANCNO|GA|ANCRESULT|ANCPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_anc.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม anc เสร็จเรียบร้อย<br>";