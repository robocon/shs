<?php 

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in15` 
SELECT `hn`, CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `date_hn` 
FROM `opday` 
WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
AND `an` IS NULL 
AND ( `icd10` LIKE 'J45%' 
    OR `icd10` LIKE 'J46%' ) 
GROUP BY `hn`";
$db->exec($sql);


$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in15`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in15` 
SELECT `row_id`,`date`,`hn` AS `hn_drug`,`drugcode`,COUNT(`hn`) AS `rows` ,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn` 
FROM `drugrx` 
WHERE `status` = 'Y' 
AND `an` IS NULL 
AND ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
AND `drugcode` IN ( 
    '7PULR', 
    '7PULT', 
    '7SERE50', 
    '7SYMB', 
    '7BESO', 
    '7BUDE', 
    '7BUDE-N', 
    '7BUDE-NN', 
    '7SER_EVO' 
 
) 
GROUP BY `hn`";
$db->exec($sql);


$sql = "SELECT COUNT(b.`row_id`) AS `rows`
FROM `tmp_opday_in15` AS a 
LEFT JOIN `tmp_drugrx_in15` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL 
ORDER BY b.`row_id`";
$db->select($sql);
$pre_in15a = $db->get_item();
$in15a = $pre_in15a['rows'];

$db->select("SELECT COUNT(`hn`) AS `rows` FROM `tmp_opday_in15`");
$pre_in15b = $db->get_item();
$in15b = $pre_in15b['rows'];

$in15_result  = ( $in15a / $in15b ) * 100 ;
