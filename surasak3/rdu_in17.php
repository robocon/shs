<?php


$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in17`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in17` 
select `hn`, 
CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `date_hn` 
from opday 
where ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
and an is NULL 
and ( 
    icd10 = 'z321' 
    or icd10 = 'z33' 
    or icd10 like 'z34%' 
    or icd10 like 'z35%' 
) 
group by hn 
order by hn;";
$db->exec($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in17`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in17` 
SELECT `row_id`,`date`,`hn`,`an`,`drugcode`,COUNT(`hn`) AS `rows` ,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn` 
FROM `drugrx` 
WHERE `status` = 'Y' 
AND `an` IS NULL 
AND ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
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

$sql = "select count(b.row_id) as `rows` 
from tmp_opday_in17 as a 
left join tmp_drugrx_in17 as b on b.date_hn = a.date_hn 
where b.row_id is not null ";
$db->select($sql);

$item = $db->get_item();

$in17_result = $item['rows'];