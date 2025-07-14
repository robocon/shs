<?php

if ( !defined('RDU_TEST') ) {
    echo '404 Wowwwwwwwwwwwwwwwwwwwwwwwww invalid way';
    exit;
}

// ตัวหาร B
// OPD + ICD10
// DROP TEMPORARY TABLE IF EXISTS `tmp_diag_in6`;
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_diag_in6` (
`row_id` INT(11),
`svdate_en` VARCHAR(10) CHARACTER SET utf8,
`hn` VARCHAR(20) CHARACTER SET utf8,
`icd10` VARCHAR(20) CHARACTER SET utf8,
`thdatehn` VARCHAR(20) CHARACTER SET utf8,
KEY `svdate_en` (`svdate_en`),
KEY `thdatehn` (`thdatehn`),
KEY `icd10` (`icd10`)
)
SELECT `row_id`,`svdate_en`,`hn`,`icd10`,CONCAT(SUBSTRING(`svdate`,9,2),'-',SUBSTRING(`svdate`,6,2),'-',SUBSTRING(`svdate`,1,4),`hn`) AS `thdatehn` 
FROM `diag` 
WHERE ( `svdate_en` >= '$date_start' AND `svdate_en` <= '$date_end' ) 
AND ( 
    `icd10` IN ( 'J00', 'J010', 'J011', 'J012', 'J013', 'J014', 'J018', 'J019' ) 
    OR `icd10` IN ( 'J020', 'J029' ) 
    OR `icd10` IN ( 'J030', 'J038', 'J039' ) 
    OR `icd10` IN ( 'J040', 'J041', 'J042' ) 
    OR `icd10` IN ( 'J050', 'J051' ) 
    OR `icd10` IN ( 'J060', 'J068', 'J069' ) 
    OR `icd10` IN ( 'J101', 'J111' ) 
    OR `icd10` LIKE 'J20%' 
    OR `icd10` IN ( 'J210', 'J218', 'J219' ) 
    OR `icd10` IN ( 'H650','H651','H659','H660','H664','H669','H670','H671','H678','H720','H721','H722','H728','H729' )
) AND `svdate` <> '' 
GROUP BY `thdatehn` ;";
$db->exec($sql);


$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in6` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn` 
FROM `rdu_drugrx` 
WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' )
AND `drugcode` IN ( 
    '1AMOX500-D',
    '1AMOX625',
    '1AUGM1-N',
    '1CEFS',
    '1CRAV-NN',
    '1DOXY',
    '1FARM',
    '1KLA500-N',
    '1RUL150-C',
    '1AZI',
    '5AMOX',
    '5AMO250',
    '5AUG35-C',
    '5CEFA',
    '5CEFS',
    '5CEFU',
    '5ERY',
    '1MEIA200',
    '5ZITH*$'
 ) 
GROUP BY `date_hn`"; 
$db->exec($sql);

$in6a = $items_a = $in6b = $items_b = $in6_result = 0;

$sql = "SELECT COUNT(b.`row_id`) AS `rows` 
FROM `tmp_diag_in6` AS a 
LEFT JOIN `tmp_drugrx_in6` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL ";
$db->select($sql);
$items_a = $db->get_item();
$in6a = $items_a['rows'];


$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_diag_in6`";
$db->select($sql);
$items_b = $db->get_item();
$in6b = $items_b['rows'];

$in6_result = ( $in6a / $in6b ) * 100 ;

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_diag_in6`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in6`");