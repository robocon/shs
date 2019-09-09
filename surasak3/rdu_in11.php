<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator (2^3)+3 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

// $en_date_min = bc_to_ad($date_min);
// $en_date_max = bc_to_ad($date_max);

// เตรียมข้อมูล opday
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_opday_in11`;");
$sql = "CREATE TEMPORARY TABLE `pre_opday_in11` 
SELECT `row_id`,`date`,`hn`,`age`,`icd10`,`date_hn`,TRIM(SUBSTRING(`age`, 1, 2)) AS `shortage`
FROM `tmp_opday_main` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `icd10` regexp 'E11' 
GROUP BY `hn` ";
// dump($sql);
$db->exec($sql); 

// เตรียมข้อมูล drugrx
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_drugrx_in11`;");
$sql = "CREATE TEMPORARY TABLE `pre_drugrx_in11` 
SELECT `row_id`,`hn`,`drugcode`,`date_hn` 
FROM `tmp_drugrx_main` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` LIKE '1EUGL-C%' 
GROUP BY `hn` ";
// dump($sql);
$test = $db->exec($sql); 

// เอาสองตัวบนมารวมกัน จะได้ ผู้ป่วยที่ได้รับยา gibenclamide แบบที่ยังไม่ได้แบ่งตามอายุ
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_user_in11`;");
$sql = "CREATE TEMPORARY TABLE `tmp_user_in11` 
SELECT a.*,CONCAT( (SUBSTRING(a.`date`, 1, 4) - 543), SUBSTRING(a.`date`,5,6) ) AS `date_en`,b.`drugcode` 
FROM `pre_opday_in11` AS a 
LEFT JOIN `pre_drugrx_in11` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`hn` IS NOT NULL "; 
// dump($sql);
$db->exec($sql); 

// เตรียมหา A2 จากผลแลปครั้งล่าสุด
// $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_prelab_in11`");
$sql = "SELECT COUNT(a.`row_id`) AS `rows` 
FROM (  
    SELECT `row_id`,`hn`,`date_en`,`shortage` 
    FROM `tmp_user_in11` 
    WHERE `shortage` <= 65 
) AS a 
LEFT JOIN ( 
    SELECT * 
    FROM `tmp_lab_main` 
    WHERE `year` = '$year' AND `quarter` = '$quarter' 
    AND ( `egfr` < 60 AND `egfr` > 0 ) 
) AS b ON b.`hn` = a.`hn` 
WHERE b.`id` IS NOT NULL 
AND ( 
	TIMESTAMPDIFF(MONTH,SUBSTRING(b.`orderdate`,1,10),a.`date_en`) >= 0 
	AND TIMESTAMPDIFF(MONTH,SUBSTRING(b.`orderdate`,1,10),a.`date_en`) <= 6 
)";
// dump($sql);
// $db->exec($sql); 
$db->select($sql); 
$pre_a2 = $db->get_item();



// A1
$sql = "SELECT COUNT(`row_id`) AS `rows`  
FROM `tmp_user_in11` 
WHERE `shortage` > 65 ;";
// dump($sql);
$db->select($sql);
$pre_a1 = $db->get_item();


$in11a = $pre_a1['rows'] + $pre_a2['rows'];

// ตัวหาร
$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_user_in11` ";
$db->select($sql);
$pre_b = $db->get_item();
$in11b = $pre_b['rows'];

$in11_result  = ( $in11a / $in11b ) * 100 ;

