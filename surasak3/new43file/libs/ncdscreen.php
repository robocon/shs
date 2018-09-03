<?php 

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );
mysql_query("SET NAMES UTF8", $db2);

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$sql = "SELECT '11512' AS `HOSPCODE`, 
a.`hn` AS `PID`,
b.`vn` AS `SEQ`,
thDateToEn(b.`thidate`) AS `DATE_SERV`,
'1' AS `SERVPLACE`,
b.`cigarette` AS `SMOKE`,
b.`alcohol` AS `ALCOHOL`,
'' AS `DMFAMILY`,
'' AS `HTFAMILY`,
b.`weight` AS `WEIGHT`,
b.`height` AS `HEIGHT`,
b.`waist` AS `WAIST_CM`, 
b.`bp1` AS `SBP_1`,
b.`bp2` AS `DBP_1`,
'' AS `SBP_2`,
'' AS `DBP_2`,
'' AS `BSLEVEL`,
'1' AS `BSTEST`,
'11512' AS `SCREENPLACE`,
CONCAT(thDateToEn(b.`thidate`), LPAD(b.`vn`, 3, 0),'0000') AS `PROVIDER`,
thDateTimeToEn(b.`thidate`) AS `D_UPDATE`,
c.`idcard` AS `CID`,
toEn(SUBSTRING(b.`thidate`,1,10)) AS `toLis`
FROM ( 

    SELECT `dm_no`,`thidate`,`dateN`,`hn`,`doctor`,`ptname`, 
    CONCAT(SUBSTRING(`thidate`, 9, 2),'-',SUBSTRING(`thidate`, 6, 2),'-',( SUBSTRING(`thidate`, 1, 4) + 543 ),`hn`) AS `thdatehn`, 
    'diabet' AS `type`  
    FROM `diabetes_clinic` 
    WHERE `thidate` LIKE '$yrmonth%' 

    UNION 

    SELECT `ht_no`,`thidate`,`dateN`,`hn`,`doctor`,`ptname`, 
    CONCAT(SUBSTRING(`thidate`, 9, 2),'-',SUBSTRING(`thidate`, 6, 2),'-',( SUBSTRING(`thidate`, 1, 4) + 543 ),`hn`) AS `thdatehn`, 
    'hyper' AS `type`  
    FROM `hypertension_clinic` 
    WHERE `thidate` LIKE '$yrmonth%' 

) AS a 
LEFT JOIN (  
    SELECT `thidate`,`thdatehn`,`vn`,`weight`,`height`,`bp1`,`bp2`,`cigarette`,`alcohol`,`waist` 
    FROM `opd` 
    WHERE `thidate` LIKE '$thimonth%' 
) AS b ON b.`thdatehn` = a.`thdatehn` 
LEFT JOIN `opcard` AS c ON c.`hn` = a.`hn` 
WHERE b.`vn` IS NOT NULL ";

$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = '';

while ($item = mysql_fetch_assoc($q)) {

    $date_lis = $item['toLis'];
    $hn = $item['PID'];

    $sql_lab = "SELECT b.`result` 
    FROM ( 
        SELECT a.`autonumber` 
        FROM `resulthead` AS a 
        WHERE a.`orderdate` LIKE '$date_lis%' 
        AND a.`profilecode` = 'GLU' 
        AND a.`hn` = '$hn' 
    ) AS a 
    LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber`
    ";
    $q_lab = mysql_query($sql_lab, $db2) or die( mysql_error() );
    $lab = mysql_fetch_assoc($q_lab);
    
    $item['BSLEVEL'] = '0.00';
    if( $lab['result'] !== false ){
        $item['BSLEVEL'] = number_format($lab['result'], 2);
    }

    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$item['SEQ'].'|'
    .$item['DATE_SERV'].'|'
    .$item['SERVPLACE'].'|'
    .$item['SMOKE'].'|'
    .$item['ALCOHOL'].'|'
    .$item['DMFAMILY'].'|'
    .$item['HTFAMILY'].'|'
    .$item['WEIGHT'].'|'
    .$item['HEIGHT'].'|'
    .$item['WAIST_CM'].'|'
    .$item['SBP_1'].'|'
    .$item['DBP_1'].'|'
    .$item['SBP_2'].'|'
    .$item['DBP_2'].'|'
    .$item['BSLEVEL'].'|'
    .$item['BSTEST'].'|'
    .$item['SCREENPLACE'].'|'
    .$item['PROVIDER'].'|'
    .$item['D_UPDATE'].'|'
    .$item['CID']."\r\n";

}
mysql_close($db2);


$filePath = $dirPath.'/ncdscreen.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|SERVPLACE|SMOKE|ALCOHOL|DMFAMILY|HTFAMILY|WEIGHT|HEIGHT|WAIST_CM|SBP_1|DBP_1|SBP_2|DBP_2|BSLEVEL|BSTEST|SCREENPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_ncdscreen.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;