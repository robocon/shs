<?php 
include 'bootstrap.php';

$db = Mysql::load($rdu_configs);

// $year = input_get('year');
// $quarter = input_get('quarter');
$table = input_get('table');
$date = input_get('date');
$minDate = input_get('minDate');
$maxDate = input_get('maxDate');

$where_toborow = "AND `toborow` != 'EX02'";
// if ( $year <= '2562' ) {
//     if( $quarter < 4 ){
//         $where_toborow = "";
//     }
// }

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in15` 
SELECT b.*, a.`doctor` AS `doctor2`, a.`ptname` AS `ptname2` ,a.`age` AS `age2`
FROM ( 
	SELECT *  
	FROM `opday` 
	WHERE `date` LIKE '$date%' 
	$where_toborow 
	GROUP BY `hn` 
) AS a 
LEFT JOIN 
( 
	SELECT * 
    FROM `diag` 
    WHERE `svdate` LIKE '$date%' 
    AND icd10 LIKE 'J45%' GROUP BY `hn` 
) AS b ON b.`hn` = a.`hn` 
WHERE b.`id` IS NOT NULL 
GROUP BY a.`hn`";
$test = $db->exec($sql);


$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in15` 
SELECT `id`,`row_id`,`date`,`hn`,`drugcode`,`amount`
FROM `drugrx` 
WHERE ( `date` >= '$minDate' AND `date` <= '$maxDate' )
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

if( $table == 'a' ){

    $sql = "SELECT a.*,b.* 
    FROM `tmp_opday_in15` AS a 
    LEFT JOIN `tmp_drugrx_in15` AS b ON b.`hn` = a.`hn` 
    WHERE b.`row_id` IS NOT NULL 
    ORDER BY b.`row_id`";
    $db->select($sql);
    $items = $db->get_items();

}elseif( $table == 'b' ){
    
    $db->select("SELECT *,`svdate` AS `date`,`doctor` AS `doctor2`,`ptname` AS `ptname2` FROM `tmp_opday_in15`");
    $items = $db->get_items();

}

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in15`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in15`");

?>

<style>
/* ตาราง */
body, button{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>ชื่อผู้ป่วย</th>
        <th>อายุ</th>
        <th>Diag</th>
        <th>ICD-10</th>
        <th>Drug code</th>
        <th>จำนวน</th>
        <th>แพทย์</th>
    </tr>
    <?php 
$i = 1;
foreach ($items as $key => $item) {
    ?>
    <tr>
        <td><?=$i;?></td>
        <td><?=$item['date'];?></td>
        <td><?=$item['hn'];?></td>
        <td><?=$item['ptname2'];?></td>
        <td><?=$item['age'];?></td>
        <td><?=$item['diag'];?></td>
        <td><?=$item['icd10'];?></td>
        <td><?=$item['drugcode'];?></td>
        <td><?=$item['amount'];?></td>
        <td><?=$item['doctor2'];?></td>
    </tr>
    <?php
    $i++;
}
?>
</table>
