<?php
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_base_opday` (
`row_id` INT(11),
`thidate` VARCHAR(10) CHARACTER SET utf8,
`thdatehn` VARCHAR(10) CHARACTER SET utf8,
`hn` VARCHAR(20) CHARACTER SET utf8,
`ptname` VARCHAR(255) CHARACTER SET utf8,
`age` VARCHAR(50) CHARACTER SET utf8,
`doctor` VARCHAR(255) CHARACTER SET utf8,
`icd10` VARCHAR(20) CHARACTER SET utf8,
`diag` VARCHAR(255) CHARACTER SET utf8,
KEY `hn` (`hn`),
KEY `thdatehn` (`thdatehn`),
KEY `icd10` (`icd10`)
)
SELECT `row_id`,`thidate`,`thdatehn`,`hn`,`ptname`,`age`,`doctor`,`icd10`,`diag` 
FROM `opday` 
WHERE `thidate` >= '$dateStartTh' AND `thidate` <= '$dateEndTh' ;";
$res = $db->exec($sql);
if($res['error']){
    echo 'tmp_base_opday : '.$res['error'];
    exit;
}