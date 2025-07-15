<?php 
if ( !defined('RDU_TEST') ) {
    echo '404 :( invalid Please try again later';
    exit;
}

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in7` 
SELECT * 
FROM `tmp_base_opday` 
WHERE ( 
    `icd10` IN ( 'A000', 'A001', 'A009' ) 
    OR `icd10` IN ( 'A020' ) 
    OR `icd10` IN ( 'A030', 'A031', 'A032', 'A033', 'A038', 'A039' ) 
    OR `icd10` LIKE 'A04%' 
    OR `icd10` IN ( 'A050', 'A053', 'A054', 'A059' ) 
    OR `icd10` IN ( 'A080', 'A081', 'A082', 'A083', 'A084', 'A085' ) 
    OR `icd10` IN ( 'A09', 'A090', 'A099' ) 
    OR `icd10` IN ( 'K521', 'K528', 'K529' ) 
)";
$query = $db->exec($sql);
if($query['error']){
    echo 'tmp_opday_in7 : '.$query['error'];
    exit;
}

$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in7` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`thdatehn`
FROM `tmp_base_drugrx` 
WHERE `drugcode` IN ( '1CIPR-C*?','1CRAV-NN','1LEX400-N','1GRAC','5ERY','5ZITH*$','1DOXY','1COTR4' )
GROUP BY `thdatehn`; "; 
$res = $db->exec($sql);
if($res['error']){
    echo 'tmp_drugrx_in7 : '.$res['error'];
    exit;
} 

$in7a = $in7b = $in7_result = 0;

$sqlIn7a = "SELECT a.*,b.* 
FROM `tmp_opday_in7` AS a 
LEFT JOIN `tmp_drugrx_in7` AS b ON b.`thdatehn` = a.`thdatehn` 
WHERE b.`row_id` IS NOT NULL";
$db->select($sqlIn7a);
$items_in7_a = $db->get_items();
$in7a = $db->get_rows();

$sql = "SELECT * FROM `tmp_opday_in7`";
$db->select($sql);
$items_in7_b = $db->get_items();
$in7b = $db->get_rows();

$in7_result = ( $in7a / $in7b ) * 100 ;