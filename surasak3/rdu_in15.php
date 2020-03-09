<?php 

$where_toborow = "AND `toborow` != 'EX02'";
if ( $year <= '2562' ) {
    if( $quarter < 4 ){
        $where_toborow = "";
    }
}

// B จำนวนผู้ป่วยนอกโรคหืดทั้งหมด นับตามhn
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in15` 
SELECT b.*  
FROM ( 
	SELECT *  
	FROM `opday` 
	WHERE `date` LIKE '$whereMonthTH%' 
    #`year` = '$year' AND `quarter` = '$quarter' 
	$where_toborow
	GROUP BY `hn` 
) AS a 
LEFT JOIN 
( 
	SELECT * 
    FROM `diag` 
    WHERE `date` LIKE '$whereMonthTH%' 
    #`year` = '$year' AND `quarter` = '$quarter' 
    AND icd10 LIKE 'J45%' GROUP BY `hn` 
) AS b ON b.`hn` = a.`hn` 
WHERE b.`id` IS NOT NULL 
GROUP BY a.`hn` ";
$db->exec($sql);

// A จำนวนผู้ป่วยนอกดรคหืดที่ได้รับยา inhaled corticosteroid นับตามhn อย่างน้อย1ครั้งใน 12เดือน
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in15` 
SELECT `id`,`row_id`,`date`,`hn`,`drugcode`  
FROM `drugrx` 
WHERE ( `date` >= '$last1YearTH' AND `date` <= '$whereMonthTH-$lastOfMonth' )
#`year` = '$year' 
AND `drugcode` IN ( 
    '7PULR', 
    '7PULT', 
    '7SERE50', 
    '7SYMB', 
    '7BESO', 
    '7BUDE', 
    '7BUDE-N', 
    '7BUDE-NN', 
    '7SER_EVO' 
) 
GROUP BY `hn`";
$db->exec($sql);

$pre_in15a = $in15a = $pre_in15b = $in15b = $in15_result = 0;

$sql = "SELECT COUNT(`diag_id`) AS `rows` 
FROM `tmp_opday_in15` AS a 
LEFT JOIN `tmp_drugrx_in15` AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL 
ORDER BY b.`row_id`";
$db->select($sql);
$pre_in15a = $db->get_item();
$in15a = $pre_in15a['rows'];

$db->select("SELECT COUNT(`hn`) AS `rows` FROM `tmp_opday_in15`");
$pre_in15b = $db->get_item();
$in15b = $pre_in15b['rows'];

$in15_result = ( $in15a / $in15b ) * 100 ;

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in15`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in15`");