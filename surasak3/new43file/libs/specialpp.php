<?php

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

$HOSPCODE = '11512';
$SERVPLACE = '1';

//แฟ้ม 41 SPECIALPP
$sql = "SELECT a.`date`, a.`hn`, a.`tvn`, 
# YYYYMMDD
CONCAT((SUBSTRING( a.`date`, 1, 4 ) - 543), SUBSTRING( a.`date`, 6, 2 ), SUBSTRING( a.`date`, 9, 2 )) AS `date_serv`,
# HHIISS
CONCAT(SUBSTRING( a.`date`, 12, 2 ), SUBSTRING( a.`date`, 15, 2 ), SUBSTRING( a.`date`, 18, 2 )) AS `time`,
# Docter Code
SUBSTRING( a.`doctor`, 1, 5) AS `dt_code`, 
b.`idcard`, 
TRIM( a.`idname` ) AS `idname`, 
c.`icd10` 
FROM `depart` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
LEFT JOIN `opday` AS c ON c.`thdatehn` = CONCAT( SUBSTRING( a.`date`, 9, 2 ),'-', SUBSTRING( a.`date`, 6, 2 ),'-', SUBSTRING( a.`date`, 1, 4 ), a.`hn`)  
WHERE a.`date` LIKE '$thimonth%' 
AND a.`staf_massage` != '' 
AND a.`status` = 'Y' 
GROUP BY a.`hn`, `date_serv`
ORDER BY `date_serv`, `time`";
$q = mysql_query($sql,$db2) or die( mysql_error() );


// ฟิกเลขแพทย์แผนไทยไปก่อน
$staff = array(
    'ธัญญาวดี มูลรัตน์' => '1038',
    'ศิริพร อินปัน' => '1272',
    'ภาคภูมิ พิสุทธิวงษ์' => '714',
    'น.ส.หทัยรัตน์ กุลชิงชัย' => '2252',
    'ศศิภา ศิริรัตน์' => '819',
    'กัณต์กัลยา  ตัณชวนิชย์' => '21020',
    'กันยกร มาเกตุ' => '907'
);

$header = "HOSPCODE|PID|SEQ|DATE_SERV|SERVPLACE|PPSPECIAL|PPSPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = '';
while ( $item = mysql_fetch_assoc($q) ) {
    
    $PID = trim($item['hn']);
    $SEQ = $item['date_serv'].(sprintf('%08d', trim($item['tvn'])));
    $DATE_SERV = $item['date_serv'];
    $SERVPLACE = '1';
    $PPSPECIAL = $item['icd10'];
    $PPSPLACE = $HOSPCODE;
    $CID = trim($item['idcard']);

    $hn = str_replace('-', '', trim($item['hn']));
    
    $D_UPDATE = $item['date_serv'].$item['time'];

    $find_key = $item['idname'];
    if( isset($staff[$find_key]) ){
        $dr_code = $staff[$find_key];
    }else{
        $dr_code = 00000;
    }
    
    $PROVIDER = $item['date_serv'].(sprintf('%07d', $dr_code));
    
    $txt .= "$HOSPCODE|$PID|$SEQ|$DATE_SERV|$SERVPLACE|$PPSPECIAL|$PPSPLACE|$PROVIDER|$D_UPDATE|$CID\r\n";


}


$filePath = $dirPath.'/specialpp.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$txt = $header.$txt;
$qofPath = $dirPath.'/qof_specialpp.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม specialpp เสร็จเรียบร้อย<br>";
