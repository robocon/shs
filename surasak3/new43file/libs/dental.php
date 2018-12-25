<?php

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

$sql = "SELECT '11512' AS `HOSPCODE`, 
`hn` AS `PID`, 
TRIM(`vn`) AS `vn`, 
thDateToEn(SUBSTRING(`thidate`, 1, 10)) AS `DATE_SERRV`, 
'5' AS `DENTTYPE`, 
'1' AS `SERVPLACE`, 
'' AS `PTEETH`, '' AS `PCARIES`, '' AS `PFILLING`, '' AS `PEXTRACT`, 
'' AS `DTEETH`, '' AS `DCARIES`, '' AS `DFILLING`, '' AS `DEXTRACT`, 
'' AS `NEED_FLUORIDE`, '' AS `NEED_SCALING`, '' AS `NEED_SEALANT`, '' AS `NEED_PFILLING`, 
'' AS `NEED_DFILLING`, '' AS `NEED_PEXTRACT`, '' AS `NEED_DEXTRACT`, '' AS `NPROSTHESIS`, 
'' AS `PERMANENT_PERMANENT`,'' AS `PERMANENT_PROSTHESIS`,'' AS `PROSTHESIS_PROSTHESIS`, '' AS `GUM`, 
'' AS `SCHOOLTYPE`,'' AS `CLASS`,`doctor` AS `PROVIDER`, 
thDateTimeToEn(`thidate`) AS `D_UPDATE`,
TRIM(`idcard`) AS 'CID' 
FROM `opday` 
WHERE `thidate` LIKE '$thimonth%'
AND `toborow` LIKE 'ex07%'";
$q = mysql_query($sql, $db2);

$txt = "";
while ( $item = mysql_fetch_assoc($q) ) { 

    if( preg_match('/^(MD\d+)/', $item['PROVIDER']) > 0 ){ 

        $test_dt = substr($item['PROVIDER'], 0, 5);
        if( $test_dt == 'MD020' ){
            $code = '3448';
        }elseif ( $test_dt == 'MD030' ) {
            $code = '5947';
        }

    }else{

        $test_match = preg_match('/(\d+){4,5}/', $item['PROVIDER'], $match);
        if( $test_match > 0 ){
            $code = $match['1'];
        }

    }

    $seq = $item['DATE_SERV'].sprintf("%03d",$item['vn']);
    $provider = $seq.$code;

    $txt .= $item['HOSPCODE'].'|'.$item['PID'].'|'.$seq.'|'.$item['DATE_SERV'].'|';
    $txt .= $item['DENTTYPE'].'|'.$item['SERVPLACE'].'|'.$item['PTEETH'].'|'.$item['PCARIES'].'|';
    $txt .= $item['PFILLING'].'|'.$item['PEXTRACT'].'|'.$item['DTEETH'].'|'.$item['DCARIES'].'|';
    $txt .= $item['DFILLING'].'|'.$item['DEXTRACT'].'|'.$item['NEED_FLUORIDE'].'|'.$item['NEED_SCALING'].'|';
    $txt .= $item['NEED_SEALANT'].'|'.$item['NEED_PFILLING'].'|'.$item['NEED_DFILLING'].'|'.$item['NEED_PEXTRACT'].'|';
    $txt .= $item['NEED_DEXTRACT'].'|'.$item['NPROSTHESIS'].'|'.$item['PERMANENT_PERMANENT'].'|'.$item['PERMANENT_PROSTHESIS'].'|';
    $txt .= $item['PROSTHESIS_PROSTHESIS'].'|'.$item['GUM'].'|'.$item['SCHOOLTYPE'].'|'.$item['CLASS'].'|';
    $txt .= $provider.'|'.$item['D_UPDATE'].'|'.$item['CID']."\r\n";

}

$filePath = $dirPath.'/dental.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|DENTTYPE|SERVPLACE|PTEETH|PCARIES|PFILLING|PEXTRACT|";
$header .= "DTEETH|DCARIES|DFILLING|DEXTRACT|NEED_FLUORIDE|NEED_SCALING|NEED_SEALANT|NEED_PFILLING|NEED_DFILLING|NEED_PEXTRACT|";
$header .= "NEED_DEXTRACT|NPROSTHESIS|PERMANENT_PERMANENT|PERMANENT_PROSTHESIS|PROSTHESIS_PROSTHESIS|GUM|SCHOOLTYPE|CLASS|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_dental.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม dental เสร็จเรียบร้อย<br>";