<?php 

if ( !defined('RDU_TEST') ) {
    echo '404 :( invalid Please try again later';
    exit;
}


$sql = "CREATE TEMPORARY TABLE `tmp_opday_in8` 
SELECT a.`hn`,a.`organ`,a.`maintenance`,
a.`row_id`,b.`svdate`,b.`icd10`,a.`date_hn`,b.`diag`,b.`doctor` 
FROM ( 
    SELECT `trauma_id` AS `row_id`,`hn`,`organ`,`maintenance`,`date_hn`
    FROM `rdu_trauma` 
    WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
    AND ( 
        `organ` REGEXP 'มีด|mc|แผล|ทิ่ม|แทง|บาด' 
    )
    AND ( `organ` NOT REGEXP 'ไม่มีบาดแผล|ไม่มีแผล|ทำแผล|ล้างแผล|แผลเย็บ|กัด|ข่วน|เขี้ยว|วัน|สัปดาห์|เดือน|ผ่าตัด|นัด|ตาย|day|bed' ) 
) AS a 
LEFT JOIN ( 
    SELECT `diag_id` AS `row_id`,`svdate`,`icd10`,`date_hn`,`diag`,`doctor` 
    FROM `rdu_diag` 
    WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
    AND ( 
        `icd10` IN ( 'S00', 'S01', 'S05', 'S07', 'S08', 'S09', 'S10', 'S11' ) 
        OR `icd10` IN ( 'S16', 'S17', 'S18', 'S19', 'S20', 'S21' ) 
        OR `icd10` REGEXP 'S(2[8-9]|3[0-1])' 
        OR `icd10` REGEXP 'S(3[8-9]|4[0-1])' 
        OR `icd10` REGEXP 'S{1}([4-8]([6-9]|[0-1]))' 
        OR `icd10` REGEXP 'S(8[6-9]|9[0-1]|9[6-9])' 
        OR `icd10` REGEXP 'X([0-1][0-9])' 
        OR `icd10` REGEXP 'X([2-3][0-9])' 
    ) 
    GROUP BY `hn`
) AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL ";
$db->exec($sql);

$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in8` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`  
FROM `rdu_drugrx` 
WHERE ( `date_en` >= '$date_start' AND `date_en` <= '$date_end' ) 
AND `drugcode` IN ( 
'1DIC250',
'1RUL150-C',
'5ERY',
'5ZITH*$',
'1CIPR-C*?',
'1CLIN300',
'1DIC500',
'1AMOX500-D',
'1AMOX625',
'5AMOX',
'5AUG35-C',
'1AUGM1-N',
'1DOXY',
'1COTR4',
'1METR' 
) 
GROUP BY `date_hn`"; 
$db->exec($sql); 

$items_in8_a = $items_in8_b = $in8a = $in8b = $in8_result = 0;

// ตั้ง
$sql = "SELECT COUNT(a.`row_id`) AS `rows`
FROM `tmp_opday_in8` AS a 
LEFT JOIN `tmp_drugrx_in8` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL";
$db->select($sql);
$items_in8_a = $db->get_item();
$in8a = $items_in8_a['rows'];

// หาร
$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_opday_in8`";
$db->select($sql);
$items_in8_b = $db->get_item();
$in8b = $items_in8_b['rows'];

$in8_result = ( $in8a / $in8b ) * 100 ;

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in8`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in8`");