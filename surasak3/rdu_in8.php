<?php 
if ( !defined('RDU_TEST') ) {
    echo '404 :( invalid Please try again later';
    exit;
}

$sqlTmpTraumaDiagIn8 = "CREATE TEMPORARY TABLE `tmp_trauma_diag_in8` 
SELECT a.`row_id`,a.`hn`,a.`organ`,a.`maintenance`,a.`thdatehn`,
b.`svdate`,b.`icd10`,b.`diag`,b.`doctor` 
FROM ( 
    SELECT * 
    FROM `tmp_base_trauma` 
    WHERE ( `organ` REGEXP 'มีด|mc|แผล|ทิ่ม|แทง|บาด' )
    AND 
    ( `organ` NOT REGEXP 'ไม่มีบาดแผล|ไม่มีแผล|ทำแผล|ล้างแผล|แผลเย็บ|กัด|ข่วน|เขี้ยว|วัน|สัปดาห์|เดือน|ผ่าตัด|นัด|ตาย|day|bed' ) 
) AS a 
LEFT JOIN ( 
    SELECT * 
    FROM `tmp_base_diag` 
    WHERE ( 
        `icd10` IN ( 'S00', 'S01', 'S05', 'S07', 'S08', 'S09', 'S10', 'S11' ) 
        OR `icd10` REGEXP 'S(1[6-9]|2[0-1])' 
        OR `icd10` REGEXP 'S(2[8-9]|3[0-1])' 
        OR `icd10` REGEXP 'S(3[8-9]|4[0-1])' 
        OR `icd10` REGEXP 'S(4[6-9]|5[0-1])' 
        OR `icd10` REGEXP 'S(5[6-9]|6[0-1])' 
        OR `icd10` REGEXP 'S(6[6-9]|7[0-1])' 
        OR `icd10` REGEXP 'S(7[6-9]|8[0-1])' 
        OR `icd10` REGEXP 'S(8[6-9]|9[0-1])' 
        OR `icd10` REGEXP 'S(9[6-9])' 
        OR `icd10` REGEXP 'X([0-1][0-9])' 
        OR `icd10` REGEXP 'X([2-3][0-9])' 
    ) 
    GROUP BY `hn`
) AS b ON b.`thdatehn` = a.`thdatehn` 
WHERE b.`row_id` IS NOT NULL ";
echo "<hr>";
dump($sqlTmpTraumaDiagIn8);
$e = $db->exec($sqlTmpTraumaDiagIn8);

$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in8` 
SELECT * 
FROM `tmp_base_drugrx` 
WHERE `drugcode` IN ( '1DIC250','1RUL150-C','5ERY','5ZITH*$','1CIPR-C*?','1CLIN300','1DIC500','1AMOX500-D','1AMOX625','5AMOX','5AUG35-C','1AUGM1-N','1DOXY','1COTR4','1METR' ) 
GROUP BY `thdatehn`"; 
echo "<hr>";
dump($sql);
$e = $db->exec($sql); 

$items_in8_a = $items_in8_b = $in8a = $in8b = $in8_result = 0;

// ตั้ง
$sql = "SELECT a.*,b.* 
FROM `tmp_trauma_diag_in8` AS a 
LEFT JOIN `tmp_drugrx_in8` AS b ON b.`thdatehn` = a.`thdatehn` 
WHERE b.`row_id` IS NOT NULL";
$db->select($sql);
$items_in8_a = $db->get_items();
// $in8a = $items_in8_a['rows'];
$items_in8_a = $db->get_rows();
echo "<hr>";
dump($sql);
dump($items_in8_a);

// หาร
$sql = "SELECT * FROM `tmp_trauma_diag_in8`";
$db->select($sql);
$items_in8_b = $db->get_items();
// $in8b = $items_in8_b['rows'];
$in8b = $db->get_rows();
echo "<hr>";
dump($sql);
dump($in8b);

$in8_result = ( $in8a / $in8b ) * 100 ;
