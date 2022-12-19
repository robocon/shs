<?php

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in17` 
SELECT `hn`,`date_hn` 
FROM `rdu_opday` 
WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
AND ( 
    `icd10` = 'z321' 
    OR `icd10` = 'z33' 
    OR `icd10` LIKE 'z34%' 
    OR `icd10` LIKE 'z35%' 
) 
GROUP BY hn;";
$db->exec($sql);


$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in17` 
SELECT `row_id`,`date`,`hn`,`drugcode`,COUNT(`hn`) AS `rows` ,`date_hn` 
FROM `rdu_drugrx` 
WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
AND `drugcode` IN ( 
'1COUM-C1', 
'1COUM-C2', 
'1COUM-C3', 
'1COUM-C5', 
'1RENI5-C', 
'1COVE5', 
'1ENAL20', 
'1TANZ', 
'1LOSAR100', 
'1EDAR', 
'1MEVA40*?', 
'1LIVA', 
'1LIP40-N', 
'1ZOC10-N', 
'1CRES20 ',
'1CRES20-N', 
'1ZOC20-NN', 
'1CAFE-C', 
'1ATOR40-N', 
'1CODI160-C', 
'1ENT100', 
'1EXFO-C',
'1ATOZ',
'1ZOC40-N'
) 
GROUP BY `hn`;";
$db->exec($sql);

$item = NULL;
$in17_result = 0;

$sql = "SELECT COUNT(b.`row_id`) as `rows` 
FROM `tmp_opday_in17` AS a 
LEFT JOIN `tmp_drugrx_in17` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL ";
$db->select($sql);

$item = $db->get_item();

$in17_result = $item['rows'];

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in17`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in17`");