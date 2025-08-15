<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 12 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

/**
 * เบาหวานชนิดที่2 E11 เป็นแบบที่แพทย์ยังไม่ได้ระบุชนิดของเบาหวาน เป็นการพูดถึงภาพรวม
 * 
 * E119 เบาหวานชนิดที่2 ที่ไม่มีภาวะแทรกซ้อน
 * E112 โรคไตจากเบาหวาน
 * E113 ประสาทตาจากเบาหวาน
 * ฯลฯ
 */
/*
นิยาม

1.) ผู้ป่วยนอกโรคเบาหวานชนิดที่ 2 หมายถึง ผู้ป่วยนอก ตามรหัส ICD-10  E11   
2.) ไม่มีข้อห้ามใช้ยา หมายถึง ผู้ป่วยที่มี  eGFR > 30 ml/min/1.73 m2 ล่าสุด ย้อนหลังไป 6 เดือน (หรือ ไม่มี ICD-10 N18.4 N18.5)
3.) รหัสยา metformin หมายถึง ATC Code A10BA02 Metformin และ 
A10BD02, 03, 05, 07, 08, 10, 11, 13-17 METFORMIN COMBINATIONS 

N18.4 N18.5 คือไม่เป็นไตระดับ 4 และระดับ 5

วิธีการดึงข้อมูล:  
1. ให้ดึงข้อมูลจ านวน (HN) ผู้ป่วยที่ได้รับการวินิจฉัยโรคเบาหวานชนิดที่ 2 Icd – 10 รหัส E11 และไม่มีโรคไต (eGFR > 30 ml/min/1.73 m2
หรืออาจดึงข้อมูลโดยใช้  ICD-10 ที่ไม่มีการวินิจฉัยโรคตามรหัส N18.4 N18.5 
2. ดึงข้อมูลจ านวน HN ผู้ป่วยในข้อ 1 ที่ได้รับ metformin

ตัวตั้ง
A = จ านวนผู้ป่วยนอกโรคเบาหวานชนิดที่ 2 (HN) ที่ใช้ยา metformin เป็นยา
 ชนิดเดียวหรือร่วมกับยาอื่นเพื่อควบคุมระดับน้ าตาล และมีผล  lab ล่าสุด ย้อนหลัง 6 เดือน  eGFR > 30 ml/min/1.73 m2

ตัวหาร
ิB = จ านวนผู้ป่วยนอกโรคเบาหวานชนิดที่ 2 ทั้งหมดและมีผล  lab ล่าสุด ย้อนหลัง 6 เดือน  eGFR > 30 ml/min/1.73 m2
*/

dump($sqlTmpBaseOpday);
$sql = "SELECT * FROM `tmp_base_opday` WHERE `icd10` = 'E11' ";

/*
$sql = "CREATE TEMPORARY TABLE `tmp_in12` 
SELECT a.`row_id`,a.`hn`,a.`date_hn`,a.`icd10`,b.`egfr` 
FROM ( 
	SELECT * 
    FROM `rdu_opday` 
    WHERE `date` LIKE '$whereMonthTH%' 
    AND ( `icd10` regexp 'E11' OR `icd10` regexp 'N18[4|5]' ) GROUP BY `hn`
) AS a 
LEFT JOIN ( 
	SELECT * 
    FROM `rdu_lab` 
    WHERE ( `orderdate` <= '$whereMonth-01' AND `orderdate` >= '$last6Month' ) 
    AND `egfr` > 30 GROUP BY `hn`
) AS b ON b.`hn` = a.`hn` 
WHERE b.`autonumber` IS NOT NULL ";
*/
$sql = "SELECT";
$db->exec($sql);

$pre_in12a = $in12a = $pre_in12b = $in12b = $in12_result = 0;

// Table A
$sql = "SELECT COUNT(a.`row_id`) AS `rows` 
FROM tmp_in12 AS a 
LEFT JOIN ( 
    SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`
    FROM `rdu_drugrx` 
    WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
    AND `drugcode` IN ( 
        '1MET500-C', 
        '1METF', 
        '1GLUX1000', 
        '1METF500-N', 
        '1VILMET',
        '1XIGDU'
    ) 
    GROUP BY `hn` 
) AS b  ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL ";
$db->select($sql);
$pre_in12a = $db->get_item();
$in12a = $pre_in12a['rows']; 

// Table B
$sql = "SELECT COUNT(a.`row_id`) AS `rows` 
FROM `tmp_in12` AS a 
LEFT JOIN ( 
    SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`
    FROM `rdu_drugrx` 
    WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
    AND `drugcode` IN ( 

'1ACTOS*',
'1AMAR',
'1AVAN*',
'1DIAM-MR',
'1EUGL-C',
'1MET500-C
'1METF',
'1MINID',
'2HUMUN',
'2HUMUR',
'2HUMUR1',
'1JANU',
'1UTMO',
'2LANTP',
'2GENN',
'2GENR',
'2GENM30',
'2HN70_30',
'1GALV',
'1MINID-C',
'2HRPE',
'1DIAMR_60',
'1GLUB',
'1AMAR-C',
'1DIAM30-C',
'1AMAR-N',
'1TRAJ',
'1AMAR-NN',
'1AMAR-NNN',
'1FORX',
'1OSEN',
'1GLUX1000',
'2WIN30_70',
'1JARD',
'2WIN_N',
'2WIN_R',
'1MINID-N',
'2WIN_N_1iu',
'2WIN_R_1iu',
'1METF500-N',
'1NOVO',
'2TOUJEO',
'1CANA300',
'1ZEMI',
'2VICTO',
'1GLYX',
'2INSU_R',
'2INSU_N',
'1VILMET',
'2DULA',
'1XIGDU'
) 
    GROUP BY `hn` 
) AS b ON b.`hn`=a.`hn`
WHERE b.`row_id` IS NOT NULL ";
$db->select($sql);
$pre_in12b = $db->get_item();
$in12b = $pre_in12b['rows'];

$in12_result = ( $in12a / $in12b ) * 100 ; 

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_in12`");