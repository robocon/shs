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
a.`hn` AS `PID`, 
b.`DISABTYPE`, 
'' AS `DISABCAUSE`, 
'' AS `DIAGCODE`, 
'' AS `DATE_DETECT`, 
'' AS `DATE_DISAB`, 
thDateTimeToEn(a.`thidate`) AS `D_UPDATE`, 
TRIM(a.`idcard`) AS `CID` 
FROM `opday` AS a 
LEFT JOIN `DISABILITY` AS b ON b.`hn` = a.`hn` 
WHERE a.`thidate` LIKE '$thimonth%' 
AND ( 
    a.`ptright` LIKE 'R12%' 
    OR a.`ptright` LIKE 'R40%' 
    OR a.`ptright` LIKE 'R27%' 
);";
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
    .$item['CID']
    ."\r\n";
}

$filePath = $dirPath.'/disability.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|DISABID|PID|DISABTYPE|DISABCAUSE|DIAGCODE|DATE_DETECT|DATE_DISAB|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_disability.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "���ҧ��� disability �������º����<br>";