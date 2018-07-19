<?php 

if ( !defined('RDU_TEST') ) {
    echo '404 :( invalid Please try again later';
    exit;
}

$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_opday`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday` 
SELECT `row_id`,`thidate`,`hn`,`icd10` 
FROM `opday` 
WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
AND ( 
    `icd10` IN ( 'S00', 'S01', 'S05', 'S07', 'S08', 'S09', 'S10', 'S11' ) 
    OR `icd10` IN ( 'S16', 'S17', 'S18', 'S19', 'S20', 'S21' ) 
    OR `icd10` regexp 'S(2[8-9]|3[0-1])' 
    OR `icd10` regexp 'S(3[8-9]|4[0-1])' 
    OR `icd10` regexp 'S{1}([4-8]([6-9]|[0-1]))' 
    OR `icd10` regexp 'S(8[6-9]|9[0-1]|9[6-9])' 
    OR `icd10` regexp 'T(0[0-1]|[4-7])' 
    OR `icd10` regexp 'T([09|11|13|14][0-1])' 
    OR `icd10` regexp 'T(14[6-9])' 
    OR `icd10` regexp 'T(2[0-5])' 
    OR `icd10` regexp 'T(29|3[0-2])' 
    OR `icd10` regexp 'X([0-1][0-9])' 
    OR `icd10` regexp 'X([2-3][0-9])' 
)";
$db->select($sql);

$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx` 
SELECT `row_id`,`date`,`hn`,`drugcode`  
FROM `drugrx` 
WHERE ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
AND `status` = 'Y' 
AND `an` IS NULL 
AND `drugcode` IN ( 
    '1DIC250', 
    '1DOXY', 
    '1DALA300-N', 
    '1CRAV-NN', 
    '1ERYT', 
    '1KLA500-C*', 
    '1RUL150-C', 
    '1ZITH*', 
    '5ERY', 
    '5ZITH*$', 
    '5ZMAX', 
    '1ZITH-C', 
    '1KLA500-N', 
    '2ZITH'  
); "; 
$db->select($sql); 

$in8a = $in8b = $in8_result = 0;

$sql = "SELECT COUNT(b.`row_id`) AS `rows`
FROM `tmp_opday` AS a 
LEFT JOIN `tmp_drugrx` AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL";
$db->select($sql);
$items_in8_a = $db->get_item();
$in8a = $items_in8_a['rows'];

$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_opday`";
$db->select($sql);
$items_in8_b = $db->get_item();
$in8b = $items_in8_b['rows'];

$in8_result = ( $in8a / $in8b ) * 100 ;