<?php


$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in17`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in17` 
SELECT `hn`,`date_hn` 
FROM `opday` 
WHERE `quarter` = '$quarter' 
AND ( 
    `icd10` = 'z321' 
    OR `icd10` = 'z33' 
    OR `icd10` LIKE 'z34%' 
    OR `icd10` LIKE 'z35%' 
) 
GROUP BY hn;";
$db->exec($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in17`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in17` 
SELECT `row_id`,`date`,`hn`,`drugcode`,COUNT(`hn`) AS `rows` ,`date_hn` 
FROM `drugrx` 
WHERE `quarter` = '$quarter' 
AND `drugcode` IN ( 
'1COUM-C1', 
'1COUM-C2', 
'1COUM-C3', 
'1COUM-C5', 

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
'1TANZ50', 

'1LESC80*??', 
'1LIPI*??', 
'1MEVA40*?', 
'1ZOC40', 
'1CRES20', 
'1LIVA', 
'1ZOC10', 
'1LIPI40-C', 
'1LIP40-N', 
'1CRES-C', 
'1LIP40-NN', 
'1ZOC20', 
'1ZOC10-N', 
'1ZOC20-N', 
'1VYTO', 
'1CRES20-N', 
'1ZOC10-NN', 
'1ZOC20-NN', 
'1ZIMMEX20', 

'1CAFE-C', 
'1SER30-N', 
'1SER30*', 
'1HYDE-C', 

'1MTX*'  
) 
GROUP BY `hn`;";
$db->exec($sql);

$sql = "SELECT COUNT(b.`row_id`) as `rows` 
FROM `tmp_opday_in17` AS a 
LEFT JOIN `tmp_drugrx_in17` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL ";
$db->select($sql);

$item = $db->get_item();

$in17_result = $item['rows'];