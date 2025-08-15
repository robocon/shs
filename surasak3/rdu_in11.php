<?php 
if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator (2^3)+3 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}


/**
 * !important ต้องหาให้ได้ก่อนว่าครั้งสุดท้าย ที่จ่ายยา 1EUGL-C ไป คือช่วงเวลาไหน
 * !improtant แล้วดึงข้อมูลออกมาทดสอบรายงานดูก่อน เพราะในปัจจุบัน่ ไม่ได้ใช้งานยาตัวนี้แล้ว
 * 
 * 
วิธีการเก็บข้อมูล: ให้เก็บข้อมูลแยกเป็น 2 ตัวชี้วัดย่อย เนื่องจากมีข้อควรระวังในการใช้ 2 ประเด็น 
1. ผู้ป่วยเบาหวานชนิดที่ 2 ที่มีอายุมากกว่า 65 ปี ณ วันที่เริ่มใช้ยา glibenclamide
opday ที่ฟิลด์ icd10 เป็น E11 และอายุมากกว่า 65ปี ณ วันที่ใช้ 1EUGL-C

2. ผู้ป่วยเบาหวานชนิดที่ 2 ที่อายุไม่เกิน 65 ปี ที่มี eGFR < 60 มล./นาที/1.73 ตารางเมตร ผลทางห้องปฏิบัติการ ณ วันที่เริ่มสั่งยาหรือภายใน 6 เดือนก่อนเริ่มยา 

วิธีดึงข้อมูล:  
1. ดึงค่า lab ย้อนหลังภายใน 6 เดือนที่เป็นค่าล่าสุด ระบุชื่อ lab “Serum creatinine” 
2. ถ้าอายุไม่เกิน 65 ปี และไม่มีผล lab 6 เดือนย้อนหลัง ให้ตัดข้อมูลออก

A = จำนวนผู้ป่วย (HN) ที่ได้รับ glibenclamide และ  
1. มีอายุมากกว่า 65 ปี ทั้งหมด ณ วันที่รับบริการ หรือ 
2. อายุไม่เกิน 65 ปี และมี eGFR <60 มล./นาที/1.73 ตารางเมตร

B = จำนวนผู้ป่วย (HN) ทั้งหมดที่ได้รับ  glibenclamide ในช่วงเวลาที่เก็บข้อมูล

(A/B)*100
 */

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