<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 10 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_opday`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday` 
SELECT a.`row_id`,a.`thidate`,a.`hn`,a.`icd10`,b.`bp1`,b.`bp2`,b.`congenital_disease` 
FROM `opday` AS a 
LEFT JOIN `opd` AS b ON b.`thdatehn` = a.`thdatehn`
WHERE ( a.`thidate` >= '$date_min' AND a.`thidate` <= '$date_max' ) 
AND b.`row_id` IS NOT NULL 
AND a.`icd10` regexp 'I10' 
AND b.`bp1` > 130";
$db->select($sql);


$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx` 
SELECT `row_id`,`date`,`hn`,`drugcode`, CONCAT(SUBSTRING(`date`,1,10),`hn`,TRIM(`drugcode`)) AS `thidatecode` 
FROM `drugrx` 
WHERE ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
AND `status` = 'Y' 
AND `an` IS NULL 
AND `drugcode` IN ( 
    '1RENI20-C', 
    '1RENI5-C', 
    '1TRIT5', 
    '1COVE5', 
    '1TRIT5-C', 
    '1ENAL20', 
    '1BLOP16*', 
    '1OLME40', 
    '1TANZ', 
    '1APRO', 
    '1CODI160', 
    '1MICA40', 
    '1COZA', 
    '1APRO-C', 
    '1TANZ100', 
    '1EDAR', 
    '1APRO-N', 
    '1TANZ50' 
); "; 
$db->select($sql); 


//  A 
$sql = "SELECT a.*,b.`thidate`,b.`icd10`, COUNT(b.`row_id`) AS `rows`
FROM (

    SELECT `hn`,COUNT(`hn`) as `row`,'1' as `hn_row`
    FROM `tmp_drugrx` 
    GROUP BY `thidatecode` 
    HAVING COUNT(`hn`) >= 2

) AS a 
LEFT JOIN `tmp_opday` AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL ; ";
$db->select($sql);
$items_in10_a = $db->get_item();
// $in10a = count($items_in10_a);
$in10a = $items_in10_a['rows'];

// B
$sql = "SELECT a.*,b.`thidate`,b.`icd10`, COUNT(b.`row_id`) AS `rows`
FROM (

    SELECT `hn`,COUNT(`hn`) as `row`,'1' as `hn_row`
    FROM `tmp_drugrx` 
    GROUP BY `thidatecode` 

) AS a 
LEFT JOIN `tmp_opday` AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL ; ";
$db->select($sql);
$items_in10_b = $db->get_item();
// $in10b = count($items_in10_b);
$in10b = $items_in10_b['rows'];

$in10_result = ( $in10a / $in10b ) * 100 ;