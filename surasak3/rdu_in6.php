<?php

if ( !defined('RDU_TEST') ) {
    echo '404 Wowwwwwwwwwwwwwwwwwwwwwwwww invalid way';
    exit;
}

// ������ B
// OPD + ICD10

$sql = "CREATE TEMPORARY TABLE `tmp_diag_in6` 
SELECT `diag_id` AS `row_id` ,`svdate`,`hn`,`icd10`,`date_hn` 
FROM `diag` 
WHERE `svdate` LIKE '$whereMonthTH%'
#`year` = '$year' AND `quarter` = '$quarter' 
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
) 
GROUP BY `date_hn`";
$db->exec($sql);


$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in6` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn` 
FROM `drugrx` 
WHERE `date` LIKE '$whereMonthTH%' 
#`year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` IN ( 

    '1AMOX250',
    '1AMOX500',
    '1AMOX625',
    '5AMOX',
    '1DIC250',
    '5AMOX250',
    '1AUGM',
    '5AUG35',
    '1AUGM1-C',
    '5AUG35-C',
    '1OMNI*$',
    '1DISMR',
    '1MEIA',
    '2INVA',
    '5CEFS',
    '5DIST',
    '5MEIA',
    '1CEFS',
    '1ERYT',
    '1KLA500-C*',
    '1RUL150-C',
    '1ZITH*',
    '5ERY',
    '5ZITH*$',
    '5ZMAX',
    '1ZITH-C',
    '1KLA500-N',
    '2ZITH',
    '1DOXY',
    '1DALA300-N',
    '1CRAV-NN',
    '1AUGM1-N',
    '1AMOX500-N'
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