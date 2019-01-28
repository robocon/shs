<?php 

// $db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
// mysql_select_db('smdb', $db2) or die( mysql_error() );

// ข้อมูลยาตามรายการที่ต้องตรวจในเดือนนั้นๆ
$sql_pre_labfu = "CREATE TEMPORARY TABLE `pre_labfu` 
SELECT 
a.*, b.`sex`,b.`hn`, CONCAT(SUBSTRING(b.`orderdate`,1,10),b.`hn`) AS `date_hn`
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
        OR `labname` = 'Urine-microalbumin' 
    ) 
    AND ( `result` != 'DELETE' AND `result` != '*' ) 
) AS a 
LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`autonumber`";
$q_test = mysql_query($sql_pre_labfu, $db2) or die( mysql_error() );

// ผู้ป่วยโรคเบาหวาน-ความดันโลหิตสูง ที่ได้รับการตรวจทางห้องปฏิบัติการทุกครั้ง โดย่โรงพยาบาลและสถานบริการระดับปฐมภูมิ
$sql_labfu1 = "SELECT 
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
    WHEN y.`labname` = 'Blood Sugar' THEN '0531002' 
    WHEN y.`labname` = 'HBsAg' THEN '0746299' 
    WHEN y.`labname` = 'Creatinine' THEN '0581904' 
    WHEN y.`labname` = 'Urine-microalbumin' THEN '0440204' 
END AS `LABTEST`, 

CASE
    WHEN y.`labname` = 'Creatinine' THEN ROUND(eGFR(x.`age`,y.`sex`,y.`result`), 2) 
    ELSE ROUND(y.`result`, 2) 
END AS `LABRESULT`, 

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
    AND ( `icd10` regexp 'I(1[0-5])' OR `icd10` regexp 'E(1[0-4])' ) 

) AS x 
LEFT JOIN `pre_labfu` AS y ON y.`date_hn` = x.`date_hn` 
WHERE y.`autonumber` IS NOT NULL ;";
$q = mysql_query($sql_labfu1, $db2) or die(mysql_error());

$txt = '';
while ( $item = mysql_fetch_assoc($q) ) { 

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

file_put_contents($dirPath.'/labfu.txt', $txt);

$header = "HOSPCODE|PID|SEQ|DATE_SERV|LABTEST|LABRESULT|D_UPDATE|LABPLACE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_labfu.txt';
file_put_contents($qofPath, $txt);

echo "สร้างแฟ้ม labfu เสร็จเรียบร้อย<br>";

// mysql_close($db2);
?>