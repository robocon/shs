<?php

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_rdu_in13`");
$sql = "CREATE TEMPORARY TABLE `tmp_rdu_in13` 
SELECT `row_id`,`date`,`hn`,`drugcode`,COUNT(`hn`) AS `rows` ,`date_hn` 
FROM `rdu_drugrx` 
WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
AND `drugcode` IN ( 
    '1CELE200*',
    '1ARCO',
    '1MOBI-C',
    '1ACEO',
    '1ARCO_60',
    '1LOXO-N',
    '1NAPRO',
    '1VOL-N',
    '1INDO-N',
    '1VOLT-C',
    '1VOL100'
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