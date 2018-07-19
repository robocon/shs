<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 12 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$en_date_min = bc_to_ad($date_min);
$en_date_max = bc_to_ad($date_max);

// lab ย้อนหลัง 6 เดือน
$db->select("DROP TEMPORARY TABLE IF EXISTS `pre_in11_lab`");
$sql = "CREATE TEMPORARY TABLE `pre_in11_lab` 
SELECT b.`autonumber`,b.`orderdate`,b.`hn`,b.`patientname`,b.`sex`,c.`result`
FROM (  

	SELECT MAX(`autonumber`) as `latest_id`
	FROM `resulthead` 
	WHERE (`orderdate` >= '$en_date_min' AND `orderdate` <= '$en_date_max' ) 
	AND ( `profilecode` = 'CREA' OR `profilecode` = 'CREAG' ) 
	GROUP BY `hn` 

) AS a 
LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
WHERE c.`labname` = 'Creatinine' ";
$db->select($sql);

// หา eGFR
$db->select("DROP TEMPORARY TABLE IF EXISTS `pre_in11_b`");
$sql = "CREATE TEMPORARY TABLE `pre_in11_b` 
SELECT a.`shortage`,a.`datehn`,b.*, eGFR(a.`shortage`,b.`sex`,b.`result`) AS `eGFR`
FROM ( 
	
	SELECT `hn`,SUBSTRING(`age`,1,2) AS `shortage`, 
	SUBSTRING(`thidate`,1,10) AS `date`, 
	CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `datehn` 
	FROM `opday` 
	WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
	AND `icd10` regexp 'E11' 	

) AS a 
LEFT JOIN `pre_in11_lab` AS b ON b.`hn` = a.`hn`
WHERE b.`autonumber` IS NOT NULL 
HAVING eGFR(a.`shortage`,b.`sex`,b.`result`) > 30 ";
$db->select($sql);

// Table B
$sql = "SELECT COUNT(`autonumber`) AS `rows` FROM `pre_in11_b`";
$db->select($sql);
$pre_in12b = $db->get_item();
// $in12b = count($pre_in12b );
$in12b = $pre_in12b['rows'];

// Table A
$sql = "SELECT COUNT(a.`row_id`) AS `rows` 
FROM ( 
    SELECT `row_id`,`date`,`hn`,`drugcode`,
    CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `datehn`
    FROM `drugrx` 
    WHERE ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
    AND `status` = 'Y' 
    AND `an` IS NULL 
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
RIGHT JOIN `pre_in11_b` AS b ON b.`datehn` = a.`datehn` 
WHERE a.`row_id` IS NOT NULL ";
$db->select($sql);
$pre_in12a = $db->get_item();
// $in12a = count($pre_in12a ); 
$in12a = $pre_in12a['rows']; 

$in12_result = ( $in12a / $in12b ) * 100 ;