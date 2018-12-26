<?php

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

$sql = "SELECT '11512' AS `HOSPCODE`, 
x.`hn` AS `PID`, 
y.`vn` AS `vn`, 
thDateToEn(SUBSTRING(y.`thidate`, 1,10)) AS `DATE_SERV`, 
x.`weight` AS `WEIGHT`, 
x.`height` AS `HEIGHT`, 
CASE 
    WHEN y.`waist` <> '' THEN y.`waist` 
    ELSE '0'  
END AS `WAIST_CM`,
x.`bp1` AS `SBP`, 
x.`bp2` AS `DBP`, 
x.`foot` AS `FOOT`, 
x.`retina` AS `RETINA`, 
TRIM(y.`doctor`) AS `doctor`,
thDateTimeToEn(y.`thidate`) AS `D_UPDATE`, 
'11512' AS `CHRONICFUPLACE`, 
TRIM(c.`idcard`) AS `CID`
 FROM (

    SELECT a.`hn`,a.`dateN`,a.`thidate`,a.`height`,a.`weight`,a.`bp1`,a.`bp2`,
    CASE
        WHEN a.`foot` = 'No DR' THEN '1'
        WHEN a.`foot` = '' THEN '2'
        ELSE '3'
    END AS `foot`,
    '2' AS `retina`, 
    a.`officer`,
    CONCAT(SUBSTRING(a.`thidate`, 9, 2),'-',SUBSTRING(a.`thidate`, 6, 2),'-',( SUBSTRING(a.`thidate`, 1, 4) + 543 ),a.`hn`) AS `thdatehn` 
    FROM `diabetes_clinic` AS a 
    WHERE a.`thidate` LIKE '$yrmonth%'

		UNION

    SELECT b.`hn`,b.`dateN`,b.`thidate`,b.`height`,b.`weight`,b.`bp1`,b.`bp2`,
    '2' AS `foot`,
    '8' AS `ratina`,
    b.`officer`, 
    CONCAT(SUBSTRING(b.`thidate`, 9, 2),'-',SUBSTRING(b.`thidate`, 6, 2),'-',( SUBSTRING(b.`thidate`, 1, 4) + 543 ),b.`hn`) AS `thdatehn` 
    FROM `hypertension_clinic` AS b 
    WHERE b.`thidate` LIKE '$yrmonth%'

) AS x
LEFT JOIN (  
    SELECT `thidate`,`thdatehn`,`vn`,`weight`,`height`,`bp1`,`bp2`,`cigarette`,`alcohol`,`waist`,`doctor` 
    FROM `opd` 
    WHERE `thidate` LIKE '$thimonth%' 
) AS y ON y.`thdatehn` = x.`thdatehn` 
LEFT JOIN `opcard` AS c ON c.`hn` = x.`hn` 
WHERE y.`vn` IS NOT NULL;";

$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = "";
while ( $item = mysql_fetch_assoc($q) ) { 

    $seq = $item['DATE_SERV'].$item['vn'];

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

    $weight = number_format($item['WEIGHT'], 1);
    $height = number_format($item['HEIGHT'], 1);
    $waist_cm = number_format($item['WAIST_CM'], 1);

    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$seq.'|'
    .$item['DATE_SERV'].'|'
    .$weight.'|'
    .$height.'|'
    .$waist_cm.'|'
    .$item['SBP'].'|'
    .$item['DBP'].'|'
    .$item['FOOT'].'|'
    .$item['RETINA'].'|'
    .$provider.'|'
    .$item['D_UPDATE'].'|'
    .$item['CHRONICFUPLACE'].'|'
    .$item['CID']
    ."\r\n";
}

$filePath = $dirPath.'/chronicfu.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|WEIGHT|HEIGHT|WAIST_CM|SBP|DBP|FOOT|RETINA|PROVIDER|D_UPDATE|CHRONICFUPLACE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_chronicfu.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

mysql_close($db2);

echo "สร้างแฟ้ม chronicfu เสร็จเรียบร้อย<br>";