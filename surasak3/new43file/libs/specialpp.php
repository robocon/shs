<?php

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

$HOSPCODE = '11512';
$SERVPLACE = '1';

//��� 41 SPECIALPP
$sql = "SELECT a.`date`, a.`hn`, a.`tvn`, 
thDateToEn(SUBSTRING(a.`date`, 1, 10)) AS `date_serv`, 
# HHIISS
CONCAT(SUBSTRING( a.`date`, 12, 2 ), SUBSTRING( a.`date`, 15, 2 ), SUBSTRING( a.`date`, 18, 2 )) AS `time`,
SUBSTRING( a.`doctor`, 1, 5) AS `dt_code`, 
TRIM(b.`idcard`) AS `idcard`, 
TRIM( a.`idname` ) AS `idname`, 
c.`icd10`,
thDateTimeToEn(a.`date`) AS `d_update` 
FROM `depart` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
LEFT JOIN `opday` AS c ON c.`thdatehn` = CONCAT( SUBSTRING( a.`date`, 9, 2 ),'-', SUBSTRING( a.`date`, 6, 2 ),'-', SUBSTRING( a.`date`, 1, 4 ), a.`hn`)  
WHERE a.`date` LIKE '$thimonth%' 
AND a.`staf_massage` != '' 
AND a.`status` = 'Y' 
GROUP BY a.`hn`, `date_serv`
ORDER BY `date_serv`, `time`";
$q = mysql_query($sql,$db2) or die( mysql_error() );


// �ԡ�Ţᾷ��Ἱ��仡�͹
$staff = array(
    '�ѭ��Ǵ� ����ѵ��' => '1038',
    '���Ծ� �Թ�ѹ' => '1272',
    '�Ҥ���� ���ط��ǧ��' => '714',
    '�.�.˷���ѵ�� ��Ūԧ���' => '2252',
    '����� �����ѵ��' => '819',
    '�ѳ������  �ѳ�ǹԪ��' => '21020',
    '�ѹ¡� ��ࡵ�' => '907'
);

$header = "HOSPCODE|PID|SEQ|DATE_SERV|SERVPLACE|PPSPECIAL|PPSPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = '';
while ( $item = mysql_fetch_assoc($q) ) {
    
    $PID = trim($item['hn']);
    $vn = sprintf('%03d', $item['tvn']);
    $SEQ = $item['date_serv'].$vn;
    $DATE_SERV = $item['date_serv'];
    $PPSPECIAL = $item['icd10'];
    $PPSPLACE = $HOSPCODE;
    $CID = $item['idcard'];
    
    $D_UPDATE = $item['d_update'];

    $find_key = $item['idname'];
    if( isset($staff[$find_key]) ){
        $dr_code = $staff[$find_key];
    }else{
        $dr_code = 00000;
    }
    
    $PROVIDER = $SEQ.sprintf("%05d", $dr_code);
    
    $txt .= "$HOSPCODE|$PID|$SEQ|$DATE_SERV|$SERVPLACE|$PPSPECIAL|$PPSPLACE|$PROVIDER|$D_UPDATE|$CID\r\n";


}


$filePath = $dirPath.'/specialpp.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$txt = $header.$txt;
$qofPath = $dirPath.'/qof_specialpp.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "���ҧ��� specialpp �������º����<br>";
