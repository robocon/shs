<?php 

if ( !defined('RDU_TEST') ) {
    echo '404 :( invalid Please try again later';
    exit;
}

$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_opday`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday` 
SELECT `row_id`,`thidate`,`hn`,`icd10` 
FROM `opday` 
WHERE `thidate` LIKE '$date%' 
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

$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx` 
SELECT `row_id`,`date`,`hn`,`drugcode`  
FROM `drugrx` 
WHERE `date` LIKE '$date%' 
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

$sql = "SELECT b.`row_id` AS `drug_id` 
FROM `tmp_opday` AS a 
LEFT JOIN `tmp_drugrx` AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL";
$db->select($sql);
$items_in7_a = $db->get_items();
$in7a = count($items_in7_a);


$sql = "SELECT * FROM `tmp_opday`";
$db->select($sql);
$items_in7_b = $db->get_items();
$in7b = count($items_in7_b);


$in7_result = ( $in7a / $in7b ) * 100 ;