<?php

if ( !defined('RDU_TEST') ) {
    echo '404 Wowwwwwwwwwwwwwwwwwwwwwwwww invalid way';
    exit;
}

/*
DDL = ยาในบัญชียาหลักแห่งชาติ
DDY = ยานอกบัญชียาหลักแห่งชาติ แต่เบิกได้
DDN = ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
DSY = เวชภัณฑ์เบิกได้
DSN = เวชภัณฑ์เบิกไม่ได้
DPY = อุปกรณ์เบิกได้
DPN = อุปกรณ์เบิกไม่ได้ 
*/

$in1a = $in1b = $in1_result = 0;

$sql = "SELECT COUNT(`row_id`) AS `rows` 
FROM `drugrx` 
WHERE `date` >= '$date_min' AND `date` <= '$date_max' 
AND `an` IS NULL 
AND `part` = 'DDL' ";
$db->select($sql);
$items_a = $db->get_item();
$in1a = $items_a['rows'];

$sql = "SELECT COUNT(`row_id`) AS `rows` 
FROM `drugrx` 
WHERE `date` >= '$date_min' AND `date` <= '$date_max' 
AND `an` IS NULL ";
$db->select($sql);
$items_b = $db->get_item();
$in1b = $items_b['rows'];

$in1_result = ( $in1a / $in1b ) * 100 ;