<?php

// $db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
// mysql_select_db('smdb', $db2) or die( mysql_error() );

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
a.`vn`, 
thDateToEn(SUBSTRING(a.`thidate`, 1, 10)) AS `DATE_SERRV`, 
b.`ICF`,
'' AS `QUALIFIER`,
TRIM(`doctor`) AS `doctor`,
thDateTimeToEn(a.`thidate`) AS `D_UPDATE`,
TRIM(a.`idcard`) AS `CID` 
FROM `opday` AS a 
LEFT JOIN `ICF` AS b ON b.`hn` = a.`hn`  
WHERE a.`thidate` LIKE '$thimonth%'
AND ( 
    a.`ptright` LIKE 'R12%' 
    OR a.`ptright` LIKE 'R40%' 
    OR a.`ptright` LIKE 'R27%' 
 );";
$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = "";
while ( $item = mysql_fetch_assoc($q) ) {

    $seq = $item['DATE_SERRV'].sprintf("%03d", $item['vn']);

    if( preg_match('/^(MD\d+)/', $item['doctor'], $matchs) > 0 ){ 

        $pre_doc = $matchs['1'];
        $q2 = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$pre_doc%'", $db2) or die( mysql_error() );
        if ( mysql_num_rows($q2) > 0 ) {
            $dt = mysql_fetch_assoc($q2);
            $code = sprintf("%05d", $dt['doctorcode']);
        }else{

            $code = '00000';
        }

    }else{

        $test_match = preg_match('/(\d+){4,5}/', $item['doctor'], $match);
        if( $test_match > 0 ){
            $code = $match['1'];
        }

    }

    $provider = $seq.$code;


    $txt .= $item['HOSPCODE'].'|'
    .$item['DISABID'].'|'
    .$item['PID'].'|'
    .$seq.'|'
    .$item['DATE_SERRV'].'|'
    .$item['ICF'].'|'
    .$item['QUALIFIER'].'|'
    .$provider.'|'
    .$item['D_UPDATE'].'|'
    .$item['CID']."\r\n";
}

$filePath = $dirPath.'/icf.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|DISABID|PID|SEQ|DATE_SERRV|ICF|QUALIFIER|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_icf.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "���ҧ��� icf �������º����<br>";