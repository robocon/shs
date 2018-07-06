<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 10+1 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$db->select("DROP TEMPORARY TABLE IF EXISTS `pre_user`");
$sql = "CREATE TEMPORARY TABLE `pre_user` 
SELECT a.`datehn`,a.`hn`,a.`shortage`,b.`drugcode` 
FROM ( 

    SELECT `hn`,SUBSTRING(`age`,1,2) AS `shortage`, SUBSTRING(`thidate`,1,10) AS `date`, CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `datehn` 
    FROM `opday` 
    WHERE `thidate` LIKE '$date%' 
    AND `icd10` regexp 'E11'

) AS a 
LEFT JOIN ( 

    SELECT `hn`,`drugcode`,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `datehn`
    FROM `drugrx` 
    WHERE `date` LIKE '$date%' 
    AND `drugcode` LIKE '1EUGL-C%'

) AS b on b.`datehn` = a.`datehn` 
WHERE b.`hn` IS NOT NULL "; 
$db->select($sql);

// A 1
$sql = "SELECT * 
FROM `pre_user` 
WHERE `shortage` > 65 ;";
$db->select($sql);
$pre_a1 = $db->get_items();

$to_en_date = bc_to_ad($date);
// A2 
$sql = "SELECT a.*,b.`sex`, c.`result`  
FROM (
	SELECT * 
	FROM `pre_user` 
	WHERE `shortage` <= 65 
) AS a 
LEFT JOIN ( 

	SELECT `autonumber`,`hn`,`labnumber`,`patientname`,`sex`,
	CONCAT(SUBSTRING(`orderdate`,1,4)+543, SUBSTRING(`orderdate`,5,6), `hn`) AS `datehn`
	FROM `resulthead` 
	WHERE `orderdate` LIKE '$to_en_date%' 
	AND ( `profilecode` = 'CREA' OR `profilecode` = 'CREAG' ) 

) AS b ON b.`datehn` = a.`datehn` 
LEFT JOIN `resultdetail` AS c ON c.`autonumber` = b.`autonumber`
WHERE c.`labname` = 'Creatinine' 
AND b.`autonumber` IS NOT NULL 
HAVING eGFR(a.`shortage`,b.sex,c.result) < 60 "; 
$db->select($sql);
$pre_a2 = $db->get_items();

$in11a = count($pre_a1) + count($pre_a2);

$sql = "SELECT * FROM `pre_user` ";
$db->select($sql);
$pre_b = $db->get_items();
$in11b = count($pre_b);

$in11_result  = ( $in11a / $in11b ) * 100 ;

