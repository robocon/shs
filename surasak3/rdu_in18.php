<?php

<<<<<<< HEAD
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in18` 
SELECT `row_id`,`hn`,`date_hn` 
=======
$sql18a = "CREATE TEMPORARY TABLE `tmp_opday_in18` 
SELECT * 
>>>>>>> rdu
FROM `opday` 
WHERE `year` = '$year' AND `quarter` = '$quarter'  
AND `age` <> '' 
AND (
	( TRIM(SUBSTRING(`age`,1,2)) >= 0 AND TRIM(SUBSTRING(`age`,1,2)) < 18 )
)
AND ( 
    `icd10` IN ( 'J00', 'J000' ) 
    OR `icd10` regexp 'J01([0-4]|[8-9])' 
    OR `icd10` IN ( 'J020', 'J029' ) 
    OR `icd10` IN ( 'J030', 'J038', 'J039' ) 
    OR `icd10` IN ( 'J040', 'J041', 'J042' ) 
    OR `icd10` IN ( 'J050', 'J051' ) 
    OR `icd10` IN ( 'J060', 'J068', 'J069' ) 
    OR `icd10` IN ( 'J101', 'J111' ) 
    OR `icd10` regexp 'J(20[0-9])' 
    OR `icd10` IN ( 'J210', 'J218', 'J219' ) 
    OR `icd10` IN ( 'H650', 'H651', 'H659' ) 
    OR `icd10` IN ( 'H660', 'H664', 'H669' ) 
    OR `icd10` IN ( 'H670', 'H671', 'H678' ) 
    OR `icd10` IN ( 'H720', 'H721', 'H722' ) 
    OR `icd10` IN ( 'H728', 'H729' ) 
) 
GROUP BY `date_hn` ";
$db->exec($sql18a);


<<<<<<< HEAD
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in18` 
=======
$sql18b = "CREATE TEMPORARY TABLE `tmp_drugrx_in18` 
>>>>>>> rdu
SELECT * 
FROM `drugrx` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` IN ( 
    '1AERI*', 
    '1CLAR-C', 
    '5ZYR', 
    '1XYZA', 
    '1ZYRT-C', 
    '1TELF180', 
    '5AERI', 
    '1TELF-C', 
    '1ZYRT-N', 
    '1RUPA', 
    '5ZYR-N', 
    '1XYZA-N', 

    '1CETI', 
    '1BILA', 
    '5AERI-C' 

);";
$db->exec($sql18b);

$pre_in18a = $in18a = $pre_in18b = $in18b = $in18_result = 0;

$sqla = "SELECT COUNT(a.`row_id`) AS `rows` 
FROM `tmp_opday_in18` AS a 
LEFT JOIN `tmp_drugrx_in18` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL";
$db->select($sqla);
$pre_in18a = $db->get_item();
$in18a = $pre_in18a['rows'];


$sqlb = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_opday_in18`";
$db->select($sqlb);
$pre_in18b = $db->get_item();
$in18b = $pre_in18b['rows'];

$in18_result  = ( $in18a / $in18b ) * 100 ;

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in18`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in18`");