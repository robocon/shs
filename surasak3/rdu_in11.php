<?php 
if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator (2^3)+3 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

// เตรียมข้อมูล opday icd10 E11
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `pre_opday_in11` 
SELECT *,TRIM(SUBSTRING(`age`, 1, 2)) AS `shortage`
FROM `tmp_base_opday` 
WHERE `icd10` regexp 'E11' ;";
$db->exec($sql); 

// เตรียมข้อมูล drugrx ยาโค้ด 1EUGL-C
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `pre_drugrx_in11` 
SELECT * 
FROM `tmp_base_drugrx` 
WHERE `drugcode` LIKE '1EUGL-C%' ;";
$db->exec($sql);

// เอาสองตัวบนมารวมกัน จะได้ ผู้ป่วยที่ได้รับยา gibenclamide แบบที่ยังไม่ได้แบ่งตามอายุ
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_user_in11` 
SELECT a.*,b.`drugcode` 
FROM `pre_opday_in11` AS a 
LEFT JOIN `pre_drugrx_in11` AS b ON b.`thdatehn` = a.`thdatehn` 
WHERE b.`hn` IS NOT NULL 
GROUP BY a.`hn`;";
$db->exec($sql);

// เตรียมหา A2 จากผลแลปครั้งล่าสุด
$sql = "SELECT a.*,b.* 
FROM (  
    SELECT * FROM `tmp_user_in11` WHERE `shortage` <= 65 
) AS a 
LEFT JOIN ( 
    SELECT * FROM `tmp_base_crea` WHERE ( `egfr` > 0 AND `egfr` < 60 ) 
) AS b ON b.`thdatehn` = a.`thdatehn` 
WHERE b.`id` IS NOT NULL ; ";
$db->select($sql); 
$pre_a2 = $db->get_items();
$a2Rows = $db->get_rows();

// A1
$sql = "SELECT *  FROM `tmp_user_in11` WHERE `shortage` > 65 ;";
$db->select($sql);
$pre_a1 = $db->get_items();
$a1Rows = $db->get_rows();

// $in11a = $pre_a1['rows'] + $pre_a2['rows'];
$in11a = $a1Rows + $a2Rows;

// ตัวหาร
$sql = "SELECT * FROM `tmp_user_in11` ";
$db->select($sql);
$pre_b = $db->get_items();
$in11b = $db->get_rows();

$in11_result  = ( $in11a / $in11b ) * 100 ;