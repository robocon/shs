<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 12 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$en_date_min = bc_to_ad($date_min);
$en_date_max = bc_to_ad($date_max);

// lab ย้อนหลัง 6 เดือน
// $db->select("DROP TEMPORARY TABLE IF EXISTS `pre_in12_lab`");
// $sql = "CREATE TEMPORARY TABLE `pre_in12_lab` 
// SELECT b.`autonumber`,b.`orderdate`,b.`hn`,b.`patientname`,b.`sex`,c.`result`
// FROM (  

// 	SELECT MAX(`autonumber`) as `latest_id`
// 	FROM `resulthead` 
// 	WHERE (`orderdate` >= '$en_date_min' AND `orderdate` <= '$en_date_max' ) 
// 	AND ( `profilecode` = 'CREA' OR `profilecode` = 'CREAG' ) 
// 	GROUP BY `hn` 

// ) AS a 
// LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
// LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
// WHERE c.`labname` = 'Creatinine' ";
// $db->select($sql);

// หา eGFR
// $db->select("DROP TEMPORARY TABLE IF EXISTS `pre_in12_b`");
// $sql = "CREATE TEMPORARY TABLE `pre_in12_b` 
// SELECT a.`shortage`,a.`datehn`,b.*, eGFR(a.`shortage`,b.`sex`,b.`result`) AS `eGFR`
// FROM ( 
	
// 	SELECT `hn`,SUBSTRING(`age`,1,2) AS `shortage`, 
// 	SUBSTRING(`thidate`,1,10) AS `date`, 
// 	CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `datehn` 
// 	FROM `opday` 
// 	WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
// 	AND `icd10` regexp 'E11' 	

// ) AS a 
// LEFT JOIN `pre_in12_lab` AS b ON b.`hn` = a.`hn`
// WHERE b.`autonumber` IS NOT NULL 
// HAVING eGFR(a.`shortage`,b.`sex`,b.`result`) > 30 ";
// $db->select($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `test_in12`");
$sql = "CREATE TEMPORARY TABLE `test_in12` 
SELECT a.`row_id`,a.`hn`,a.`date_hn`,a.`icd10`,b.`egfr` 
FROM ( 
	SELECT * FROM `opday` WHERE `year` = '$year' AND `quarter` = '$quarter' AND `icd10` regexp 'E11' GROUP BY `hn`
) AS a 
LEFT JOIN ( 
	SELECT * FROM `lab` WHERE `year` = '$year' AND `quarter` = '$quarter' AND `egfr` > 30 
) AS b ON b.`hn` = a.`hn` 
WHERE b.`autonumber` IS NOT NULL  ";
// dump($sql);

// exit;
$db->exec($sql);

// Table B
$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `test_in12`";
$db->select($sql);
$pre_in12b = $db->get_item();
// $in12b = count($pre_in12b );
$in12b = $pre_in12b['rows'];

// Table A
$sql = "SELECT COUNT(a.`row_id`) AS `rows` 
FROM ( 
    SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`
    FROM `tmp_drugrx_main` 
    WHERE `year` = '$year' AND `quarter` = '$quarter' 
    AND `drugcode` IN ( 
        '1MET500-C', 
        '1METF', 
        '1MET850-C', 
        '1GLUXR', 
        '1GLUX1000', 
        '1MET750', 
        '1METF500-N'  
    ) 
    GROUP BY `hn` 
) AS a 
RIGHT JOIN test_in12 AS b ON b.`date_hn` = a.`date_hn` 
WHERE a.`row_id` IS NOT NULL ";
$db->select($sql);
$pre_in12a = $db->get_item();
// $in12a = count($pre_in12a ); 
$in12a = $pre_in12a['rows']; 

$in12_result = ( $in12a / $in12b ) * 100 ;