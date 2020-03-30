<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator 12 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

$sql = "CREATE TEMPORARY TABLE `tmp_in12` 
SELECT a.`row_id`,a.`hn`,a.`date_hn`,a.`icd10`,b.`egfr` 
FROM ( 
	SELECT * 
    FROM `opday` 
    WHERE `date` LIKE '$whereMonthTH%' 
    # `year` = '$year' AND `quarter` = '$quarter' 
    AND ( `icd10` regexp 'E11' OR `icd10` regexp 'N18[4|5]' ) GROUP BY `hn`
) AS a 
LEFT JOIN ( 
	SELECT * 
    FROM `lab` 
    WHERE ( `orderdate` <= '$whereMonth-01' AND `orderdate` >= '$last6Month' ) 
    # `year` = '$year' 
    AND `egfr` > 30 GROUP BY `hn`
) AS b ON b.`hn` = a.`hn` 
WHERE b.`autonumber` IS NOT NULL ";
$db->exec($sql);

$pre_in12a = $in12a = $pre_in12b = $in12b = $in12_result = 0;

// Table A
$sql = "SELECT COUNT(a.`row_id`) AS `rows` 
FROM tmp_in12 AS a 
LEFT JOIN ( 
    SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`
    FROM `drugrx` 
    WHERE `date` LIKE '$whereMonthTH%' 
    #`year` = '$year' 
    AND `drugcode` IN ( 
        '1MET500-C', 
        '1METF', 
        '1MET850-C', 
        '1GLUXR', 
        '1GLUX1000', 
        '1MET750', 
        '1METF500-N', 
        '1VILMET'
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
    FROM `drugrx` 
    WHERE `date` LIKE '$whereMonthTH%' 
    #`year` = '$year' 
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
'1MET850-C',
'1JANU',
'1UTMO',
'2LANTP',
'2GENN',
'2GENR',
'2GENM30',
'1GLUXR',
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
'1MET750',
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
'2DULA'

    ) 
    GROUP BY `hn` 
) AS b ON b.`hn`=a.`hn`
WHERE b.`row_id` IS NOT NULL ";
$db->select($sql);
$pre_in12b = $db->get_item();
$in12b = $pre_in12b['rows'];

$in12_result = ( $in12a / $in12b ) * 100 ; 

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_in12`");