<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator (2^3)+3 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

// $en_date_min = bc_to_ad($date_min);
// $en_date_max = bc_to_ad($date_max);

// เตรียมข้อมูล opday icd10 E11
$sql = "CREATE TEMPORARY TABLE `pre_opday_in11` 
SELECT `row_id`,`date`,`hn`,`age`,`icd10`,`date_hn`,TRIM(SUBSTRING(`age`, 1, 2)) AS `shortage`
FROM `opday` 
WHERE `date` LIKE '$whereMonthTH%' 
AND `icd10` regexp 'E11' 
GROUP BY `hn` ;";
$db->exec($sql); 

// เตรียมข้อมูล drugrx ยาโค้ด 1EUGL-C
$sql = "CREATE TEMPORARY TABLE `pre_drugrx_in11` 
SELECT `row_id`,`hn`,`drugcode`,`date_hn` 
FROM `drugrx` 
WHERE `date` LIKE '$whereMonthTH%' 
AND `drugcode` LIKE '1EUGL-C%' 
GROUP BY `hn` ;";
$test = $db->exec($sql); 

// เอาสองตัวบนมารวมกัน จะได้ ผู้ป่วยที่ได้รับยา gibenclamide แบบที่ยังไม่ได้แบ่งตามอายุ
$sql = "CREATE TEMPORARY TABLE `tmp_user_in11` 
SELECT a.*,CONCAT( (SUBSTRING(a.`date`, 1, 4) - 543), SUBSTRING(a.`date`,5,6) ) AS `date_en`,b.`drugcode` 
FROM `pre_opday_in11` AS a 
LEFT JOIN `pre_drugrx_in11` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`hn` IS NOT NULL 
GROUP BY a.`hn`;"; 
$db->exec($sql); 

// เตรียมหา A2 จากผลแลปครั้งล่าสุด
$sql = "SELECT COUNT(a.`row_id`) AS `rows` 
FROM (  
    SELECT `row_id`,`hn`,`date_en`,`shortage` 
    FROM `tmp_user_in11` 
    WHERE `shortage` <= 65 
) AS a 
LEFT JOIN ( 
    SELECT * 
    FROM `lab` 
    WHERE ( `orderdate` >= '$last6Month 00:00:00' AND `orderdate` <= '$whereMonth-$lastOfMonth 23:59:59' )
    AND ( `egfr` < 60 AND `egfr` > 0 ) 
    GROUP BY `hn`
) AS b ON b.`hn` = a.`hn` 
WHERE b.`id` IS NOT NULL ; ";
$db->select($sql); 
$pre_a2 = $db->get_item();


// A1
$sql = "SELECT COUNT(`row_id`) AS `rows`  FROM `tmp_user_in11` WHERE `shortage` > 65 ;";
$db->select($sql);
$pre_a1 = $db->get_item();


$in11a = $pre_a1['rows'] + $pre_a2['rows'];

// ตัวหาร
$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_user_in11` ";
$db->select($sql);
$pre_b = $db->get_item();
$in11b = $pre_b['rows'];

$in11_result  = ( $in11a / $in11b ) * 100 ;

$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_opday_in11`;");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_drugrx_in11`;");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_user_in11`;");