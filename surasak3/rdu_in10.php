<?php 
if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 10 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in10` 
SELECT * 
FROM `tmp_base_opday` 
WHERE `icd10` regexp 'I10' ";
$db->exec($sql);

$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in10` 
SELECT *, CONCAT(`thdatehn`,TRIM(`drugcode`)) AS `thidatecode` 
FROM `tmp_base_drugrx` 
WHERE `drugcode` IN ( '1RENI5-C','1ENAL5','1COVE5','1ENAL20','1TANZ','1LOSAR100','1EDAR','1CODI160-C','1ENT100', '1EXFO-C') ORDER BY `hn`; ";
$db->exec($sql); 


$items_in10_a = array();
$items_in10_b = array();
$in10a = $in10b = $in10_result = 0;

//  A 
$sql = "SELECT a.*,b.* 
FROM (
    SELECT `hn`,`thdatehn`,COUNT(`hn`) AS `hn_rows`,`drugcode` FROM `tmp_drugrx_in10` GROUP BY `thidatecode` HAVING COUNT(`hn`) >= 2
) AS a 
LEFT JOIN `tmp_opday_in10` AS b ON b.`thdatehn` = a.`thdatehn` 
WHERE b.`row_id` IS NOT NULL ;";
$db->select($sql);
$items_in10_a = $db->get_items();
$in10a = $db->get_rows();

// B
$sql = "SELECT a.*,b.* 
FROM (
    SELECT `hn`,`thdatehn`,COUNT(`hn`) AS `hn_rows`,`drugcode` FROM `tmp_drugrx_in10` GROUP BY `thidatecode`
) AS a 
LEFT JOIN `tmp_opday_in10` AS b ON b.`thdatehn` = a.`thdatehn` 
WHERE b.`row_id` IS NOT NULL ;";
$db->select($sql);
$items_in10_b = $db->get_items();
$in10b = $db->get_rows();

$in10_result = ( $in10a / $in10b ) * 100 ;