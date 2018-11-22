<?php

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

$sql = "SELECT '11512' AS `HOSPCODE`, 
x.`hn` AS `PID`, 
y.`vn` AS `SEQ`, 
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
CONCAT(thDateToEn(y.`thidate`), LPAD(y.`vn`, 3, 0),'0000') AS `PROVIDER`,
thDateTimeToEn(y.`thidate`) AS `D_UPDATE`, 
'11512' AS `CHRONICFUPLACE`, 
c.`idcard` AS `CID`
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
    SELECT `thidate`,`thdatehn`,`vn`,`weight`,`height`,`bp1`,`bp2`,`cigarette`,`alcohol`,`waist` 
    FROM `opd` 
    WHERE `thidate` LIKE '$thimonth%' 
) AS y ON y.`thdatehn` = x.`thdatehn` 
LEFT JOIN `opcard` AS c ON c.`hn` = x.`hn` 
WHERE y.`vn` IS NOT NULL;";

$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = "";
while ( $item = mysql_fetch_assoc($q) ) {
    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$item['SEQ'].'|'
    .$item['DATE_SERV'].'|'
    .$item['WEIGHT'].'|'
    .$item['HEIGHT'].'|'
    .$item['WAIST_CM'].'|'
    .$item['SBP'].'|'
    .$item['DBP'].'|'
    .$item['FOOT'].'|'
    .$item['RETINA'].'|'
    .$item['PROVIDER'].'|'
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