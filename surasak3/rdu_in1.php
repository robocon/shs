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

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_in1`");
$sql = "CREATE TEMPORARY TABLE `tmp_in1` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`part`,`date_hn` 
FROM `drugrx` 
WHERE `year` = '$year' AND `quarter` = '$quarter' ";
$db->exec($sql);


$in1a = $in1b = $in1_result = 0;

// xxx > '' is handle both between IS NOT EMPTY and = '' 
// Question id 2327029 in StackOverflow
$sql = "SELECT COUNT(`row_id`) AS `rows` 
FROM `tmp_in1` 
WHERE `part` = 'DDL' ";
$db->select($sql);
$items_a = $db->get_item();
$in1a = $items_a['rows'];

$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_in1`";
$db->select($sql);
$items_b = $db->get_item();
$in1b = $items_b['rows'];

$in1_result = ( $in1a / $in1b ) * 100 ;