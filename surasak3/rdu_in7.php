<?php 

if ( !defined('RDU_TEST') ) {
    echo '404 :( invalid Please try again later';
    exit;
}

$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in7`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in7` 
SELECT `row_id`,`thidate`,`hn`,`icd10` 
FROM `opday` 
WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
AND ( 
    `icd10` IN ( 'A000', 'A001', 'A009' ) 
    OR `icd10` IN ( 'A020' ) 
    OR `icd10` IN ( 'A030', 'A031', 'A032', 'A033', 'A038', 'A039' ) 
    OR `icd10` LIKE 'A04%' 
    OR `icd10` IN ( 'A050', 'A053', 'A054', 'A059' ) 
    OR `icd10` IN ( 'A080', 'A081', 'A082', 'A083', 'A084', 'A085' ) 
    OR `icd10` IN ( 'A09', 'A090', 'A099' ) 
    OR `icd10` IN ( 'K521', 'K528', 'K529' ) 
)";
$db->select($sql);

$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in7`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in7` 
SELECT `row_id`,`date`,`hn`,`drugcode`  
FROM `drugrx` 
WHERE ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
AND `status` = 'Y' 
AND `an` IS NULL 
AND `drugcode` IN ( 
    '1CIPR-C*?', 
    '1CRAV*', 
    '1TARI-C', 
    '1LEX400-C', 
    '1CRAV-NN', 
    '1TAR300', 
    '1CRAV-C', 
    '1CRAV-N', 
    '1LEX400-N', 
    '1OMNI*$', 
    '1MEIA', 
    '5CEFS', 
    '5DIST', 
    '5MEIA', 
    '1CEFS' 
); "; 
$db->select($sql); 

$in7a = $in7b = $in7_result = 0;

$sql = "SELECT COUNT(b.`row_id`) AS `rows`  
FROM `tmp_opday_in7` AS a 
LEFT JOIN `tmp_drugrx_in7` AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL";
$db->select($sql);
$items_in7_a = $db->get_item();
$in7a = $items_in7_a['rows'];

$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_opday_in7`";
$db->select($sql);
$items_in7_b = $db->get_item();
$in7b = $items_in7_b['rows'];

$in7_result = ( $in7a / $in7b ) * 100 ;