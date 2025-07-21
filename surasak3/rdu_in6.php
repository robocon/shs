<?php

if ( !defined('RDU_TEST') ) {
    echo '404 Wowwwwwwwwwwwwwwwwwwwwwwwww invalid way';
    exit;
}

// ตัวหาร B
// OPD + ICD10
// DROP TEMPORARY TABLE IF EXISTS `tmp_diag_in6`;
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_diag_in6`
SELECT a.`row_id`,a.`svdate`,a.`svdate_en`,a.`hn`,a.`icd10`,a.`diag`,CONCAT(SUBSTRING(a.`svdate`,9,2),'-',SUBSTRING(a.`svdate`,6,2),'-',SUBSTRING(a.`svdate`,1,4),a.`hn`) AS `thdatehn`, 
c.`ptname`,c.`age`,c.`doctor`
FROM `tmp_base_diag` AS a 
LEFT JOIN `tmp_base_opday` AS c ON c.`thdatehn` = CONCAT(SUBSTRING(a.`svdate`,9,2),'-',SUBSTRING(a.`svdate`,6,2),'-',SUBSTRING(a.`svdate`,1,4),a.`hn`) 
WHERE ( a.`svdate_en` >= '$date_start' AND a.`svdate_en` <= '$date_end' ) 
AND ( 
    a.`icd10` IN ( 'J00', 'J010', 'J011', 'J012', 'J013', 'J014', 'J018', 'J019' ) 
    OR a.`icd10` IN ( 'J020', 'J029' ) 
    OR a.`icd10` IN ( 'J030', 'J038', 'J039' ) 
    OR a.`icd10` IN ( 'J040', 'J041', 'J042' ) 
    OR a.`icd10` IN ( 'J050', 'J051' ) 
    OR a.`icd10` IN ( 'J060', 'J068', 'J069' ) 
    OR a.`icd10` IN ( 'J101', 'J111' ) 
    OR a.`icd10` LIKE 'J20%' 
    OR a.`icd10` IN ( 'J210', 'J218', 'J219' ) 
    OR a.`icd10` IN ( 'H650','H651','H659','H660','H664','H669','H670','H671','H678','H720','H721','H722','H728','H729' )
) AND a.`svdate` <> '' ;";
$res = $db->exec($sql);
if($res['error']){
    echo 'tmp_diag_in6 : '.$res['error'];
    exit;
}

$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_drugrx_in6` 
SELECT * 
FROM `tmp_base_drugrx` 
WHERE `an` IS NULL AND `drugcode` IN ('1AMOX500-D','1AMOX625','1AUGM1-N','1CEFS','1CRAV-NN','1DOXY','1FARM','1KLA500-N','1RUL150-C','1AZI','5AMOX','5AMO250','5AUG35-C','5CEFA','5CEFS','5CEFU','5ERY','1MEIA200','5ZITH*$' ) 
GROUP BY `thdatehn`;"; 
$res = $db->exec($sql);
if($res['error']){
    echo 'tmp_drugrx_in6 : '.$res['error'];
    exit;
}

$in6a = $items_a = $in6b = $items_b = $in6_result = 0;

$sql = "SELECT a.*,b.* 
FROM `tmp_diag_in6` AS a 
LEFT JOIN `tmp_drugrx_in6` AS b ON b.`thdatehn` = a.`thdatehn` 
WHERE b.`row_id` IS NOT NULL;";
$db->select($sql);
$items_a = $db->get_items();
$in6a = $db->get_rows();

$sql = "SELECT * FROM `tmp_diag_in6` GROUP BY `thdatehn`";
$db->select($sql);
$items_b = $db->get_items();
$in6b = $db->get_rows();

$in6_result = ( $in6a / $in6b ) * 100 ;