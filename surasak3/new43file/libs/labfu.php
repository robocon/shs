<?php 

// การ MAP ICD10 แลป กับรหัสใน resultdetail
// รหัส ICD10 ของ LAB ตาม กยผ.
/*
0531601	05=ตรวจ HbA1C
0546602	06=ตรวจ Triglyceride
0541602	07=ตรวจ Total Cholesterol  
0541202	08=ตรวจ HDL Cholesterol 
0541402	09=ตรวจ LDL Cholesterol  
0583001	10=ตรวจ BUN ในเลือด  
0531002	01=ตรวจน้ำตาลในเลือด จากหลอดเลือดดำ หลังอดอาหาร  
0746299	HBsAg 
0581904	15=ตรวจหาค่า eGFR (ใช้สูตร CKD-EPI  formula)
0440204	12=ตรวจโปรตีน microalbumin ในปัสสาวะ (ใน filed ผลการตรวจใส่ค่า 0=negative, 1=trace, 2=positive)
*/

// resultdetail
// labcode - labname
/*
HBA1CC  HBA1C
TRIG	Triglyceride
CHOL	Cholesterol
HDL     HDL
10001   LDLC
BUN     BUN
GLU     Blood Sugar ---> BS
HBSAG   HBsAg
CREA    Creatinine เอามาคำนวณแล้วตีเป็น eGFR
MAU     Urine-microalbumin
*/

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );
mysql_query("SET NAMES UTF8", $db2);

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$sql = "CREATE TEMPORARY TABLE `pre_labfu` 
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
mysql_query($sql) or die(mysql_error());

// ผู้ป่วยโรคเบาหวาน-ความดันโลหิตสูง ที่ได้รับการตรวจทางห้องปฏิบัติการทุกครั้ง โดย่โรงพยาบาลและสถานบริการระดับปฐมภูมิ
$sql = "SELECT 
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
mysql_query($sql) or die(mysql_error());
// dump($sql)

/**
 * @todo ค้างข้อ2
 */

?>