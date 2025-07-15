<?php
/**
 * ข้อมูลของ diag 
 * - svdate ไม่เป็นค่าว่าง
 */
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_base_diag` (
`row_id` INT(11),
`svdate` VARCHAR(10) CHARACTER SET utf8,
`svdate_en` VARCHAR(10) CHARACTER SET utf8,
`hn` VARCHAR(20) CHARACTER SET utf8,
`an` VARCHAR(20) CHARACTER SET utf8,
`icd10` VARCHAR(20) CHARACTER SET utf8,
`diag` VARCHAR(255) CHARACTER SET utf8,
`thdatehn` VARCHAR(20) CHARACTER SET utf8,
`ptname` VARCHAR(255) CHARACTER SET utf8,
`age` VARCHAR(50) CHARACTER SET utf8,
`doctot` VARCHAR(255) CHARACTER SET utf8,
KEY `svdate_en` (`svdate_en`),
KEY `thdatehn` (`thdatehn`),
KEY `icd10` (`icd10`)
)
SELECT a.`row_id`,a.`svdate`,a.`svdate_en`,a.`hn`,a.`icd10`,a.`diag`,CONCAT(SUBSTRING(a.`svdate`,9,2),'-',SUBSTRING(a.`svdate`,6,2),'-',SUBSTRING(a.`svdate`,1,4),a.`hn`) AS `thdatehn`, 
c.`ptname`,c.`age`,c.`doctor`
FROM `diag` AS a 
LEFT JOIN `opday` AS c ON c.`thdatehn` = CONCAT(SUBSTRING(a.`svdate`,9,2),'-',SUBSTRING(a.`svdate`,6,2),'-',SUBSTRING(a.`svdate`,1,4),a.`hn`) 
WHERE ( a.`svdate_en` >= '$date_start' AND a.`svdate_en` <= '$date_end' ) 
AND a.`svdate` <> '' ;";
$res = $db->exec($sql);
if($res['error']){
    echo 'tmp_base_opday : '.$res['error'];
    exit;
}