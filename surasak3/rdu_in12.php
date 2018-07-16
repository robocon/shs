<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 12 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$to_en_date = bc_to_ad($date);

$pre_find_last_day = strtotime($to_en_date.'-01');
$last_day = date('t', $pre_find_last_day);

$latest_time = strtotime(($to_en_date.'-01')." -6 months");
$latest_date = date('Y-m-d', $latest_time);


// lab ��͹��ѧ 6 ��͹
$db->select("DROP TEMPORARY TABLE IF EXISTS `pre_in11_lab`");
$sql = "CREATE TEMPORARY TABLE `pre_in11_lab` 
SELECT b.`autonumber`,b.`orderdate`,b.`hn`,b.`patientname`,b.`sex`,c.`result`
FROM (  

	SELECT MAX(`autonumber`) as `latest_id`
	FROM `resulthead` 
	WHERE (`orderdate` >= '$latest_date 00:00:00' AND `orderdate` <= '$to_en_date-$last_day 23:59:59' ) 
	AND ( `profilecode` = 'CREA' OR `profilecode` = 'CREAG' ) 
	GROUP BY `hn` 

) AS a 
LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
WHERE c.`labname` = 'Creatinine' ";
$db->select($sql);


$db->select("DROP TEMPORARY TABLE IF EXISTS `pre_in11_b`");
$sql = "CREATE TEMPORARY TABLE `pre_in11_b` 
SELECT a.`shortage`,a.`datehn`,b.*, eGFR(a.`shortage`,b.`sex`,b.`result`) AS `eGFR`
FROM ( 
	
	SELECT `hn`,SUBSTRING(`age`,1,2) AS `shortage`, 
	SUBSTRING(`thidate`,1,10) AS `date`, 
	CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `datehn` 
	FROM `opday` 
	WHERE `thidate` LIKE '2561-06%' 
	AND `icd10` regexp 'E11' 	

) AS a 
LEFT JOIN `pre_in11_lab` AS b ON b.`hn` = a.`hn`
WHERE b.`autonumber` IS NOT NULL 
HAVING eGFR(a.`shortage`,b.`sex`,b.`result`) > 30 ";
$db->select($sql);

// Table B
$sql = "SELECT * FROM `pre_in11_b`";
$db->select($sql);
$pre_in12b = $db->get_items();
$in12b = count($pre_in12b );

// Table A
$sql = "SELECT * 
FROM ( 
    SELECT `row_id`,`date`,`hn`,`drugcode`,
    CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `datehn`
    FROM `drugrx` 
    WHERE `date` LIKE '$date%' 
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
$pre_in12a = $db->get_items();
$in12a = count($pre_in12a ); 

$in12_result = ( $in12a / $in12b ) * 100 ;