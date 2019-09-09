<?php 

if ( !defined('RDU_TEST') ) {
    echo '404 :( invalid Please try again later';
    exit;
}

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_diag_in7`");
$sql = "CREATE TEMPORARY TABLE `tmp_diag_in7` 
SELECT `diag_id` AS `row_id`,`svdate`,`hn`,`icd10`,`type`,`date_hn` 
FROM `tmp_diag_main` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
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
$db->exec($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in7`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in7` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`
FROM `tmp_drugrx_main` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
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
$db->exec($sql); 

$in7a = $in7b = $in7_result = 0;

$sql = "SELECT COUNT(b.`row_id`) AS `rows`  
FROM `tmp_diag_in7` AS a 
LEFT JOIN `tmp_drugrx_in7` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL 
AND a.`type` = 'PRINCIPLE'";
$db->select($sql);
$items_in7_a = $db->get_item();
$in7a = $items_in7_a['rows'];

$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_diag_in7`";
$db->select($sql);
$items_in7_b = $db->get_item();
$in7b = $items_in7_b['rows'];

$in7_result = ( $in7a / $in7b ) * 100 ;