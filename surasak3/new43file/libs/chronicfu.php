<?php

$sql = "SELECT '11512' AS `HOSPCODE`, 
x.`hn` AS `PID`, 
s.`vn` AS `SEQ`, 
thDateToEn(SUBSTRING_INDEX(s.`thidate`, ' ', 1)) AS `DATE_SERV`, 
x.`weight` AS `WEIGHT`, 
x.`height` AS `HEIGHT`, 
'' AS `WAIST_CM`, 
x.`bp1` AS `SBP`, 
x.`bp2` AS `DBP`, 
x.`foot` AS `FOOT`, 
x.`retina` AS `RETINA`, 
c.`row_id` AS `PROVIDER`, 
thDateTimeToEn(s.`thidate`) AS `D_UPDATE` 
 FROM (
	SELECT a.hn,a.dateN,a.thidate,a.height,a.weight,a.bp1,a.bp2,
    CASE
        WHEN a.foot = 'No DR' THEN '1'
        WHEN a.foot = '' THEN '2'
        ELSE '3'
    END AS `foot`,
    '2' AS `retina`, 
    a.officer 
	FROM diabetes_clinic AS a 
	WHERE a.thidate LIKE '$yrmonth%'
	UNION
	SELECT b.hn,b.dateN,b.thidate,b.height,b.weight,b.bp1,b.bp2,'2' AS `foot`,'8' AS `ratina`,b.officer 
	FROM hypertension_clinic AS b 
	WHERE b.thidate LIKE '$yrmonth%'
) AS x
LEFT JOIN (
	SELECT vn,hn,icd10,thidate 
    FROM opday 
    WHERE thidate LIKE '$thimonth%' 
    AND ( icd10 LIKE 'I%' OR icd10 LIKE 'e%' )
) AS s ON s.hn = x.hn 
LEFT JOIN `inputm` AS c ON c.`name` = x.`officer` 
WHERE s.`icd10` IS NOT NULL;";

$q = mysql_query($sql) or die( mysql_error() );

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
    .$item['D_UPDATE']
    ."\r\n";
}

$filePath = $dirPath.'/chronicfu.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|WEIGHT|HEIGHT|WAIST_CM|SBP|DBP|FOOT|RETINA|PROVIDER|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_chronicfu.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม chronicfu เสร็จเรียบร้อย<br>";