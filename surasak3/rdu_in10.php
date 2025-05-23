<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 10 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in10` 
(
`row_id` INT(11) NOT NULL,
`date` VARCHAR(255) CHARACTER SET utf8 NULL,
`hn` VARCHAR(255) CHARACTER SET utf8 NULL,
`icd10` VARCHAR(255) CHARACTER SET utf8 NULL,
`date_hn` VARCHAR(255) CHARACTER SET utf8 NULL,
KEY `date_hn` (`date_hn`)
)
SELECT `row_id`,`date`,`hn`,`icd10`, `date_hn`
FROM `rdu_opday` 
WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
AND `icd10` regexp 'I10' ";
$db->exec($sql);


$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in10` 
(
`row_id` INT(11) NOT NULL,
`date` VARCHAR(255) CHARACTER SET utf8 NULL,
`hn` VARCHAR(255) CHARACTER SET utf8 NULL,
`drugcode` VARCHAR(255) CHARACTER SET utf8 NULL,
`thidatecode` VARCHAR(255) CHARACTER SET utf8 NULL,
`date_hn` VARCHAR(255) CHARACTER SET utf8 NULL,
KEY `date_hn` (`date_hn`),
KEY `drugcode` (`drugcode`)
)
SELECT `row_id`,`date`,`hn`,`drugcode`, CONCAT(SUBSTRING(`date`,1,10),`hn`,TRIM(`drugcode`)) AS `thidatecode`,`date_hn`
FROM `rdu_drugrx` 
WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
AND `drugcode` IN ( 
'1RENI5-C',
'1ENAL5',
'1COVE5',
'1ENAL20',
'1TANZ',
'1LOSAR100',
'1EDAR',
'1CODI160-C',
'1ENT100', 
'1EXFO-C'
) GROUP BY `thidatecode` ORDER BY `hn`; ";
$db->exec($sql); 

$items_in10_a = $in10a = $items_in10_b = $in10b = $in10_result = 0;

//  A 
$sql = "SELECT COUNT(a.`hn_row`) AS `rows`
FROM (

    SELECT `hn`,COUNT(`hn`) as `row`,'1' as `hn_row`,`date_hn`
    FROM `tmp_drugrx_in10` 
    GROUP BY `thidatecode` 
    HAVING COUNT(`hn`) >= 2

) AS a 
LEFT JOIN `tmp_opday_in10` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL ;";
$db->select($sql);
$items_in10_a = $db->get_item();
$in10a = $items_in10_a['rows'];

// B
$sql = "SELECT COUNT(a.`hn_row`) AS `rows`
FROM (

    SELECT `hn`,COUNT(`hn`) as `row`,'1' as `hn_row`,`date_hn`
    FROM `tmp_drugrx_in10` 
    GROUP BY `thidatecode` 

) AS a 
LEFT JOIN `tmp_opday_in10` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL ;";
$db->select($sql);
$items_in10_b = $db->get_item();
$in10b = $items_in10_b['rows'];

$in10_result = ( $in10a / $in10b ) * 100 ;

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in10`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in10`");