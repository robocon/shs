<?php 
if ( !defined('RDU_TEST') ) {
    echo '404 C..A..N..N..O..T..F..I..N..D..A..N..Y..T..H..I..N..G';
    exit;
}

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in16` 
SELECT `row_id`,`hn`,`age`,`date_hn` 
FROM `opday` 
WHERE `date` LIKE '$whereMonthTH%' 
AND TRIM(SUBSTRING(`age`,1,2)) > 65 
GROUP BY `date_hn` ";
$db->exec($sql);

# CREATE TEMPORARY TABLE `tmp_drug_in16` 
$sql = "SELECT a.*, b.`drugcode`,'1' AS `test_hn` 
FROM ( 
    SELECT `row_id`,`hn`,`age`,`date_hn` 
    FROM `opday` 
    WHERE `date` LIKE '$whereMonthTH%' 
    AND TRIM(SUBSTRING(`age`,1,2)) > 65 
    GROUP BY `date_hn`
) AS a 
LEFT JOIN ( 
    SELECT `row_id`,`drugcode`,`part`,`amount`,`date_hn` 
    FROM `drugrx` 
    WHERE `date` LIKE '$whereMonthTH%' 
    AND `drugcode` IN (
        '1D2',
        '1RIV2',
        '1T5-C',
        '1RIV0.5-N',
        '1RIV0.5-C',
        '1D5', 
        '1LIBR-N', 
        '1LIBR-C' 
    )
    GROUP BY `date_hn` 
) AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL 
GROUP BY a.`date_hn`;";
$db->select($sql);
$in16a = $db->get_rows();

$items_in16_a = $items_in16_b = $in16b = $in16_result = 0;

// A
// $sql = "SELECT COUNT(`test_hn`) AS `rows` FROM `tmp_drug_in16` ";
// dump($sql);
// $db->select($sql);
// $items_in16_a = $db->get_item();
// dump($items_in16_a);
// $in16a = $items_in16_a['rows'];

// B
$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_opday_in16` ";
$db->select($sql);
$items_in16_b = $db->get_item();
$in16b = $items_in16_b['rows'];

$in16_result = ( $in16a / $in16b ) * 100 ;

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in16`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drug_in16`");