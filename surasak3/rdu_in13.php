<?php

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_rdu_in13`");
$sql = "CREATE TEMPORARY TABLE `tmp_rdu_in13` 
SELECT `row_id`,`date`,`hn`,`drugcode`,COUNT(`hn`) AS `rows` ,`date_hn` 
FROM `tmp_drugrx_main` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` IN ( 
    '1CELE200*', 
    '1INDO', 
    '1LOXO', 
    '1NID', 
    '1VOL-C', 
    '1VOLSR', 
    '1PONS', 
    '1ARCO', 
    '1BREX', 
    '1MOBI', 
    '1ARCO30', 
    '1CELE_400', 
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
    '1NAPR-N', 
    '1ARCO120'  
) 
GROUP BY `date_hn`";
$db->exec($sql);


$sql = "SELECT COUNT(`hn`) AS `aRows` FROM `tmp_rdu_in13` WHERE `rows` >= 2 ";
$db->select($sql);
$items_in13_a = $db->get_item();
$in13a = $items_in13_a['aRows'];

$sql = "SELECT COUNT(`hn`) AS `bRows` FROM `tmp_rdu_in13` ";
$db->select($sql);
$items_in13_b = $db->get_item();
$in13b = $items_in13_b['bRows'];

$in13_result  = ( $in13a / $in13b ) * 100 ;