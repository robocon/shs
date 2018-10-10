<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator (2^3)+3 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

// $en_date_min = bc_to_ad($date_min);
// $en_date_max = bc_to_ad($date_max);

// เตรียมข้อมูล opday
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_opday_in11`");
$sql = "CREATE TEMPORARY TABLE `pre_opday_in11` 
SELECT `row_id`,`date`,`hn`,`age`,`icd10`,`date_hn`,TRIM(SUBSTRING(`age`, 1, 2)) AS `shortage`
FROM `opday` 
WHERE `quarter` = '$quarter' 
AND `icd10` regexp 'E11' 
GROUP BY `hn` ";
// dump($sql);
$db->exec($sql); 

// เตรียมข้อมูล drugrx
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_drugrx_in11`");
$sql = "CREATE TEMPORARY TABLE `pre_drugrx_in11` 
SELECT `row_id`,`hn`,`drugcode`,`date_hn` 
FROM `drugrx` 
WHERE `quarter` = '$quarter' 
AND `drugcode` LIKE '1EUGL-C%' 
GROUP BY `hn` ";
// dump($sql);
$test = $db->exec($sql); 

// เอาสองตัวบนมารวมกัน จะได้ ผู้ป่วยที่ได้รับยา gibenclamide แบบที่ยังไม่ได้แบ่งตามอายุ
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_user_in11`");
$sql = "CREATE TEMPORARY TABLE `tmp_user_in11` 
SELECT a.*,CONCAT( (SUBSTRING(a.`date`, 1, 4) - 543), SUBSTRING(a.`date`,5,6), a.`hn` ) AS `date_hn2`,b.`drugcode` 
FROM `pre_opday_in11` AS a 
LEFT JOIN `pre_drugrx_in11` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`hn` IS NOT NULL "; 
// dump($sql);
$db->exec($sql); 

// เตรียมหา A2 จากผลแลปครั้งล่าสุด
// $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_prelab_in11`");
$sql = "CREATE TEMPORARY TABLE `tmp_prelab_in11` 
SELECT *,COUNT(b.`autonumer`) AS `rows`, TIMESTAMPDIFF(MONTH,a.`date_en`,SUBSTRING(b.`orderdate`,1,10)) AS `month_diff`
FROM (  
    SELECT `hn`,`date_en`,`shortage` 
    FROM `tmp_user_in11` 
    WHERE `shortage` <= 65 
) AS a 
LEFT JOIN ( 
    SELECT * 
    FROM `lab` 
    WHERE `quarter` = '1' 
    AND `egfr` < 60 
) AS b ON b.`hn` = a.`hn` 
WHERE b.`id` IS NOT NULL 
AND TIMESTAMPDIFF(MONTH,a.`date_en`,SUBSTRING(b.`orderdate`,1,10)) <= 6 
";
// dump($sql);
// $db->exec($sql); 
$db->select($sql); 
$pre_a2 = $db->get_item();



// A2 คำนวณ eGFR ที่น้อยกว่า 60 และย้อนหลังไม่เกิน 6เดือน
// $sql = "SELECT COUNT(d.`hn`) AS `rows` 
// FROM tmp_prelab_in11 AS c 
// LEFT JOIN `resulthead` AS d ON d.`autonumber` = c.`latest_id` 
// LEFT JOIN `resultdetail` AS e ON e.`autonumber` = c.`latest_id`
// WHERE e.`labname` = 'Creatinine' 
// AND eGFR(c.`shortage`,d.`sex`,e.`result`) < 60 
// AND TIMESTAMPDIFF(MONTH,d.`orderdate`,c.`opd_date`) <= 6 ";
// $db->select($sql); 
// $pre_a2 = $db->get_item();


// A1
$sql = "SELECT `hn`,`date_en`,`shortage`,COUNT(`row_id`)
FROM `tmp_user_in11` 
WHERE `shortage` > 65 ;";
$db->select($sql);
$pre_a1 = $db->get_item();

$in11a = $pre_a1['rows'] + $pre_a2['rows'];

// ตัวหาร
$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_user_in11` ";
$db->select($sql);
$pre_b = $db->get_item();
$in11b = $pre_b['rows'];

$in11_result  = ( $in11a / $in11b ) * 100 ;

