<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 12 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_in12`");
$sql = "CREATE TEMPORARY TABLE `tmp_in12` 
SELECT a.`row_id`,a.`hn`,a.`date_hn`,a.`icd10`,b.`egfr` 
FROM ( 
	SELECT * FROM `opday` WHERE `year` = '$year' AND `quarter` = '$quarter' AND ( `icd10` regexp 'E11' OR `icd10` regexp 'N18[4|5]' ) GROUP BY `hn`
) AS a 
LEFT JOIN ( 
	SELECT * FROM `lab` WHERE `year` = '$year' AND `egfr` > 30 GROUP BY `hn`
) AS b ON b.`hn` = a.`hn` 
WHERE b.`autonumber` IS NOT NULL ";
$db->exec($sql);

// Table A
$sql = "SELECT COUNT(a.`row_id`) AS `rows` 
FROM tmp_in12 AS a 
LEFT JOIN ( 
    SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`
    FROM `drugrx` 
    WHERE `year` = '$year' 
    AND `drugcode` IN ( 
        '1MET500-C', 
        '1METF', 
        '1MET850-C', 
        '1GLUXR', 
        '1GLUX1000', 
        '1MET750', 
        '1METF500-N'  
    ) 
    GROUP BY `hn` 
) AS b  ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL ";
$db->select($sql);
$pre_in12a = $db->get_item();
$in12a = $pre_in12a['rows']; 

// Table B
$sql = "SELECT COUNT(`row_id`) AS `rows` FROM `tmp_in12`";
$db->select($sql);
$pre_in12b = $db->get_item();
$in12b = $pre_in12b['rows'];

$in12_result = ( $in12a / $in12b ) * 100 ;