<?php

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in13`");

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in13` 
SELECT `hn`,`date_hn` 
FROM `opday` 
WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
AND ( `icd10` = 'N183' 
    OR `icd10` = 'N184' 
    OR `icd10` = 'N185' 
    OR `icd10` = 'N189' ) 
GROUP BY `hn` ";
$db->exec($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in13`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in13` 
SELECT `row_id`,`date`,`hn`,`an`,`drugcode`,COUNT(`hn`) AS `rows` ,`date_hn` 
FROM `drugrx` 
AND ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
AND `drugcode` IN ( 
    '1CELE200*', 
    '1INDO', 
    '1LOXO', 
    '1NID', 
    '1VOL-C', 
    '1VOLSR', 
    '2CLOF', 
    '2DYNA', 
    '1PONS', 
    '1ARCO', 
    '4PLAI', 
    '4VOLT-C', 
    '1BREX', 
    '1MOBI', 
    '1ARCO30', 
    '1CELE_400', 
    '2KETO', 
    '1MOBI-C', 
    '1ACEO', 
    '1NID-C', 
    '1ARCO_60', 
    '1LOXO-N', 
    '1NAPR', 
    '1MOB7.5', 
    '1VOL-N', 
    '1VOL-NN', 
    '1INDO-N', 
    '2DICL', 
    '1NAPR-N', 
    '1ARCO120'  
) 
GROUP BY `hn`";
$db->exec($sql);

$sql = "SELECT COUNT(b.`hn`) AS `rows`  
FROM `tmp_opday_in13` AS a 
LEFT JOIN `tmp_drugrx_in13` AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL";
$db->select($sql);
$items_in14_a = $db->get_item();
$in14a = $items_in14_a['rows'];

// dump($in14a);

$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_opday_in13` ";
$db->select($sql);
$items_in14_b = $db->get_item();
$in14b = $items_in14_b['rows'];

// dump($in14b);

$in14_result  = ( $in14a / $in14b ) * 100 ;