<?php

// �ͺ 1�� �֧ 30�� �ͧ�նѴ�
if( $rptmo >= 10 && $rptmo <= 12 ){
    $thiyr_end = $thiyr + 1;
}else{
    $thiyr_end = $thiyr;
}

// ���Ǩ���� 1 ���� ����ͺ�է�����ҳ
$sql = "SELECT 
'11512' AS `HOSPCODE`, 
'' AS `DISABID`, 
`hn` AS `PID`, 
`vn` AS `SEQ`, 
thDateToEn(SUBSTRING(`thidate`, 1, 10)) AS `DATE_SERRV`, 
'' AS `ICF`,
'' AS `QUALIFIER`,
'' AS `PROVIDER`,
thDateTimeToEn(`thidate`) AS `D_UPDATE` 
FROM `opday` 
WHERE `thidate` LIKE '$thimonth%'
AND ( 
    `ptright` LIKE 'R12%' 
    OR `ptright` LIKE 'R40%' 
    OR `ptright` LIKE 'R27%' 
 );";
$q = mysql_query($sql) or die( mysql_error() );

$txt = "";
while ( $item = mysql_fetch_assoc($q) ) {
    $txt .= $item['HOSPCODE'].'|'
    .$item['DISABID'].'|'
    .$item['PID'].'|'
    .$item['SEQ'].'|'
    .$item['DATE_SERRV'].'|'
    .$item['ICF'].'|'
    .$item['QUALIFIER'].'|'
    .$item['PROVIDER'].'|'
    .$item['D_UPDATE']
    ."\r\n";
}

$filePath = $dirPath.'/icf.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|DISABID|PID|SEQ|DATE_SERRV|ICF|QUALIFIER|PROVIDER|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_icf.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "���ҧ��� icf �������º����<br>";