<?php 

mysql_query('DROP TEMPORARY TABLE IF EXISTS `pre_labfu`');
$sql_pre_labfu = "CREATE TEMPORARY TABLE `pre_labfu` 
SELECT a.*, b.`sex`,b.`hn`, CONCAT(SUBSTRING(b.`orderdate`,1,10),b.`hn`) AS `date_hn`
FROM ( 
    SELECT `autonumber`,`labcode`,`labname`,`result`,`unit`,`normalrange`,`flag`,`authorisedate` 
    FROM  `resultdetail` 
    WHERE `authorisedate` LIKE  '%$yrmonth%' 
    AND ( 
        `labname` = 'HBA1C' 
        OR `labname` = 'Triglyceride' 
        OR `labname` = 'Cholesterol' 
        OR `labname` = 'HDL' 
        OR `labname` = 'LDLC' 
        OR `labname` = 'LDL' 
        OR `labname` = 'BUN' 
        OR `labname` = 'Blood Sugar' 
        OR `labname` = 'HBsAg' 
        OR `labname` = 'Creatinine' 
        OR `labname` = 'Creatinine Urine' 
        OR `labname` = 'Urine-microalbumin' 
        OR `labname` = 'eGFR' 
    ) 
    AND ( `result` != 'DELETE' AND `result` != '*' ) 
) AS a 
LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`autonumber`";
mysql_query($sql_pre_labfu, $db2) or die(mysql_error());


// ผู้ป่วยที่ไม่ใช่ความดันโลหิตสูง-เบาหวาน ที่ตรวจ macroalbumin microalbumin เป็น positive หรือ egfr < 60
$sql_labfu2 = "SELECT 
'11512' AS `HOSPCODE`, 
x.`hn` AS `PID`, 
x.`vn` AS `SEQ`, 
x.`date_serv` AS `DATE_SERV`, 
CASE 
    WHEN y.`labname` = 'HBA1C' THEN '0531601' 
    WHEN y.`labname` = 'Triglyceride' THEN '0546602' 
    WHEN y.`labname` = 'Cholesterol' THEN '0541602' 
    WHEN y.`labname` = 'HDL' THEN '0541202' 
    WHEN y.`labname` = 'LDLC' THEN '0541402' 
    WHEN y.`labname` = 'LDL' THEN '0541402' 
    WHEN y.`labname` = 'BUN' THEN '0583001' 
    WHEN y.`labname` = 'Blood Sugar' THEN '0531004' 
    WHEN y.`labname` = 'HBsAg' THEN '0746299' 
    WHEN y.`labname` = 'Creatinine' THEN '0581904' 
    WHEN y.`labname` = 'Creatinine Urine' THEN '0581903' 
    WHEN y.`labname` = 'Urine-microalbumin' THEN '0440204' 
    WHEN y.`labname` = 'eGFR' THEN '0581904' 
END AS `LABTEST`, 
ROUND(y.`result`, 2) AS `LABRESULT`, 
x.`en_date` AS `D_UPDATE`, 
'11512' AS `LABPLACE`, 
x.`idcard` AS `CID` 
FROM ( 

    SELECT thDateTimeToEn(`thidate`) AS `en_date`,`hn`,`vn`,`icd10`,
    SUBSTRING(`age`,1,2) AS `age`,
    TRIM(`idcard`) AS `idcard`,
    thDateToEn(SUBSTRING(`thidate`,1,10)) AS `date_serv`,
    CONCAT(toEn(SUBSTRING(`thidate`,1,10)),`hn`) AS `date_hn` 
    FROM `opday` 
    WHERE `thidate` LIKE '$thimonth%' 
    AND ( `icd10` NOT regexp 'I(1[0-5])' AND `icd10` NOT regexp 'E(1[0-4])' ) 

) AS x 
LEFT JOIN `pre_labfu` AS y ON y.`date_hn` = x.`date_hn` 
WHERE y.`autonumber` IS NOT NULL 
AND ( y.`labcode` = 'eGFR' AND y.`result` < 60 ) 
GROUP BY CONCAT(x.`date_serv`,x.`vn`,`LABTEST`)
ORDER BY x.`hn`;";
$q_labfu2 = mysql_query($sql_labfu2, $db2) or die(mysql_error()); 




$sql = "SELECT a.*, b.`sex`,b.`hn`, 
CONCAT(SUBSTRING(b.`orderdate`,9,2),'-',SUBSTRING(b.`orderdate`,6,2),'-',( SUBSTRING(b.`orderdate`,1,4) + 543 ),b.`hn`) AS `date_hn`,
c.`row_id`,c.`vn`,c.`ptname`,c.`icd10`,c.`diag`
FROM ( 
    SELECT `autonumber`,`labcode`,`labname`,`result`,`unit`,`normalrange`,`flag`,`authorisedate` 
    FROM  `resultdetail` 
    WHERE `authorisedate` LIKE  '%2019-02%' 
    AND `labname` = 'eGFR' 
    AND ( `result` != 'DELETE' AND `result` != '*' ) 
) AS a 
LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`autonumber` 
LEFT JOIN ( 

	SELECT `row_id`,`thdatehn`,`hn`,`vn`,`ptname`,`icd10`,`diag`,
	thDateTimeToEn(`thidate`) AS `en_date`,
	SUBSTRING(`age`,1,2) AS `age`,
	TRIM(`idcard`) AS `idcard`,
	thDateToEn(SUBSTRING(`thidate`,1,10)) AS `date_serv`,
	CONCAT(toEn(SUBSTRING(`thidate`,1,10)),`hn`) AS `date_hn` 
	FROM `opday` 
	WHERE `thidate` LIKE '2562-02%' 
	AND ( `icd10` NOT REGEXP 'I(1[0-5])' AND `icd10` NOT REGEXP 'E(1[0-4])' )

 ) AS c ON c.`thdatehn` = CONCAT(SUBSTRING(b.`orderdate`,9,2),'-',SUBSTRING(b.`orderdate`,6,2),'-',( SUBSTRING(b.`orderdate`,1,4) + 543 ),b.`hn`);
WHERE c.`row_id` IS NOT NULL ";

$q_labfu2 = mysql_query($sql, $db2) or die(mysql_error()); 

$txt = '';
while ( $item = mysql_fetch_assoc($q_labfu2) ) { 

    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$item['SEQ'].'|'
    .$item['DATE_SERV'].'|'
    .$item['LABTEST'].'|'
    .$item['LABRESULT'].'|'
    .$item['D_UPDATE'].'|'
    .$item['LABPLACE'].'|'
    .$item['CID']
    ."\r\n";

}

$filePath = $dirPath.'/labfu.txt';
file_put_contents($filePath, $txt, FILE_APPEND);
$zipLists[] = $filePath;


$qofPath = $dirPath.'/qof_labfu.txt';
file_put_contents($qofPath, $txt, FILE_APPEND);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม labfu2 เสร็จเรียบร้อย<br>";

// mysql_close($db2);
?>