<?php 

// $configs_rdu = array(
//     'host' => '192.168.1.13',
//     'port' => '3306',
//     'dbname' => 'rdu',
//     'user' => 'dottow',
//     'pass' => ''
// );
// $db = Mysql::load($configs_rdu);
// dump($db);

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in15` 
SELECT `hn`, `date_hn` 
FROM `opday` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND ( `icd10` LIKE 'J45%' 
    OR `icd10` LIKE 'J46%' ) 
GROUP BY `hn`";
$test = $db->exec($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in15`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in15` 
SELECT `row_id`,`date`,`hn` AS `hn_drug`,`drugcode`,COUNT(`hn`) AS `rows` ,`date_hn` 
FROM `drugrx` 
WHERE `year` = '$year' AND `quarter` = '$quarter'  
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
