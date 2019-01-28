<?php 

// $db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
// mysql_select_db('smdb', $db2) or die( mysql_error() );

$sql = "SELECT '11512' AS `HOSPCODE`, 
a.`hn` AS `PID`,
b.`vn`,
thDateToEn(b.`thidate`) AS `DATE_SERV`,
'1' AS `SERVPLACE`,
b.`cigarette` AS `SMOKE`,
b.`alcohol` AS `ALCOHOL`,
'' AS `DMFAMILY`,
'' AS `HTFAMILY`,

CASE 
    WHEN b.`weight` > 0 THEN ROUND(b.`weight`,1) 
    ELSE '0.0'  
END AS `WEIGHT`,

ROUND(b.`height`,0) AS `HEIGHT`,

CASE 
    WHEN b.`waist` <> '' THEN ROUND(b.`waist`,0) 
    ELSE '0'  
END AS `WAIST_CM`,

b.`bp1` AS `SBP_1`,
b.`bp2` AS `DBP_1`,
b.`bp3` AS `SBP_2`,
b.`bp4` AS `DBP_2`,
'' AS `BSLEVEL`,
'1' AS `BSTEST`,
'11512' AS `SCREENPLACE`,
b.`doctor`,
thDateTimeToEn(b.`thidate`) AS `D_UPDATE`,
TRIM(c.`idcard`) AS `CID`,
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
    SELECT `thidate`,`thdatehn`,`vn`,`weight`,`height`,`bp1`,`bp2`,`cigarette`,`alcohol`,`waist`,`bp3`,`bp4`,`doctor`  
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

    $vn = sprintf("%03d", $item['vn']);
    $seq = $item['DATE_SERV'].$vn;

    $code = '00000';
    if( preg_match('/^(MD\d+)/', $item['doctor'], $matchs) > 0 ){ 

        $pre_doc = $matchs['1'];
        $q2 = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$pre_doc%'", $db2) or die( mysql_error() );
        if ( mysql_num_rows($q2) > 0 ) {
            $dt = mysql_fetch_assoc($q2);
            $code = sprintf("%05d", $dt['doctorcode']);
        }

    }else{

        $test_match = preg_match('/(\d+){4,5}/', $item['doctor'], $match);
        if( $test_match > 0 ){
            $code = $match['1'];
        }

    }

    $provider = $seq.$code;

    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$seq.'|'
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
    .$provider.'|'
    .$item['D_UPDATE'].'|'
    .$item['CID']."\r\n";

}

$filePath = $dirPath.'/ncdscreen.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|SERVPLACE|SMOKE|ALCOHOL|DMFAMILY|HTFAMILY|WEIGHT|HEIGHT|WAIST_CM|SBP_1|DBP_1|SBP_2|DBP_2|BSLEVEL|BSTEST|SCREENPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_ncdscreen.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม ncdscreen เสร็จเรียบร้อย<br>";

// mysql_close($db2);