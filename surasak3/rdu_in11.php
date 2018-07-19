<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 10+1 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$en_date_min = bc_to_ad($date_min);
$en_date_max = bc_to_ad($date_max);

// ผู้ป่วยที่ได้รับ Glibenclamide 
// $db->select("DROP TEMPORARY TABLE `test_opday`");
// $sql = "CREATE TEMPORARY TABLE `test_opday` AS ( 
//     SELECT `hn`, 
//     SUBSTRING(`age`,1,2) AS `shortage`,
//     SUBSTRING(`thidate`,1,10) AS `date`,
//     CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `datehn`,
//     CONCAT((SUBSTRING(`thidate`,1,4) - 543),SUBSTRING(`thidate`,5,15)) AS `opd_date`
//     FROM `opday` 
//     WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
//     AND `icd10` regexp 'E11' 
// )";
// $test = $db->select($sql);
// dump($sql);

// $sql = "select * from test_opday";
// $test = $db->select($sql);
// dump($test);
// exit;
// dump($test);


// $test = $db->select("DROP TEMPORARY TABLE IF EXISTS `123123pre_user`");
// dump($test);
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `123123pre_user` AS ( 
SELECT a.*,b.`drugcode` 
FROM ( 
    SELECT `hn`, 
    SUBSTRING(`age`,1,2) AS `shortage`, 
    SUBSTRING(`thidate`,1,10) AS `date`, 
    CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `datehn`, 
    CONCAT((SUBSTRING(`thidate`,1,4) - 543),SUBSTRING(`thidate`,5,15)) AS `opd_date` 
    FROM `opday` 
    WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
    AND `icd10` regexp 'E11' 
) AS a 
LEFT JOIN ( 
    SELECT `row_id`,`hn`,`drugcode`,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `datehn` 
    FROM `drugrx` 
    WHERE ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
    AND `drugcode` LIKE '1EUGL-C%' 
) AS b ON b.`datehn` = a.`datehn` 
WHERE b.`hn` IS NOT NULL 
GROUP BY b.`hn` 
)"; 


dump($sql);
$test = $db->select($sql);
dump($test);

exit;

$sql = "SELECT d.`hn`,c.`opd_date`, c.`shortage`,d.`orderdate`,e.`result`,
TIMESTAMPDIFF(MONTH,d.`orderdate`,c.`opd_date`) AS `month_diff`, 
eGFR(c.`shortage`,d.`sex`,e.`result`) AS `egfr` 
FROM ( 
    SELECT MAX(b.`autonumber`) AS `latest_id`, a.`opd_date`, a.`shortage`
    FROM `pre_user` AS a 
    LEFT JOIN `resulthead` AS b ON b.`hn` = a.`hn` 
    WHERE a.`shortage` <= 65 
    AND b.`orderdate` <= a.`opd_date` 
    AND ( b.`profilecode` = 'CREA' OR b.`profilecode` = 'CREAG' ) 
    GROUP BY b.`hn`
) AS c 
LEFT JOIN `resulthead` AS d ON d.`autonumber` = c.`latest_id` 
LEFT JOIN `resultdetail` AS e ON e.`autonumber` = c.`latest_id`
WHERE e.`labname` = 'Creatinine' 
HAVING eGFR(c.`shortage`,d.`sex`,e.`result`) < 60 
    AND TIMESTAMPDIFF(MONTH, d.`orderdate`,c.`opd_date`) <= 6";
// dump($sql);
// $db->select($sql);
// $items = $db->get_items();
// dump($items);
exit;



// A 1
$sql = "SELECT COUNT(`hn`) AS `rows`
FROM `pre_user` 
WHERE `shortage` > 65 ;";
$db->select($sql);
$pre_a1 = $db->get_item();





// $to_en_date = bc_to_ad($date);
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




// $db->select($sql);
// $pre_a2 = $db->get_items();


$in11a = $pre_a1['rows'] + count($pre_a2);


// ตัวหาร
$sql = "SELECT COUNT(`hn`) AS `rows` FROM `pre_user` ";
$db->select($sql);
$pre_b = $db->get_item();
$in11b = $pre_b['rows'];

$in11_result  = ( $in11a / $in11b ) * 100 ;

