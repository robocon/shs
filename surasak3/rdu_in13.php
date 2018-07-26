<?php

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_rdu_in13`");
$sql = "CREATE TEMPORARY TABLE `tmp_rdu_in13` 
SELECT `row_id`,`date`,`hn`,`an`,`drugcode`,COUNT(`hn`) AS `rows` ,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn` 
FROM `drugrx` 
WHERE `status` = 'Y' 
AND `an` IS NULL 
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


$sql = "SELECT COUNT(`hn`) AS `aRows` FROM `tmp_rdu_in13` WHERE `rows` > 1 ";
$db->select($sql);
$items_in13_a = $db->get_item();
$in13a = $items_in13_a['aRows'];

$sql = "SELECT COUNT(`hn`) AS `bRows` FROM `tmp_rdu_in13` WHERE `rows` > 0 ";
$db->select($sql);
$items_in13_b = $db->get_item();
$in13b = $items_in13_b['bRows'];

$in13_result  = ( $in13a / $in13b ) * 100 ;