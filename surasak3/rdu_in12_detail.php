<?php 
include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

$year = input_get('year');
$quarter = input_get('quarter');
$table = input_get('table');

$db->exec("DROP TEMPORARY TABLE IF EXISTS `test_in12`");
$sql = "CREATE TEMPORARY TABLE `test_in12` 
SELECT a.*,b.`egfr` 
FROM ( 
	SELECT * FROM `opday` WHERE `year` = '$year' AND `quarter` = '$quarter' AND `icd10` regexp 'E11' GROUP BY `hn`
) AS a 
LEFT JOIN ( 
	SELECT * FROM `lab` WHERE `year` = '$year' AND `quarter` = '$quarter' AND `egfr` > 30 
) AS b ON b.`hn` = a.`hn` 
WHERE b.`autonumber` IS NOT NULL  ";
$db->exec($sql);

if( $table == 'b' ){
    // Table B
    $sql = "SELECT * FROM `test_in12`";
    $db->select($sql);
    $items = $db->get_items();

}elseif( $table == 'a' ){

    // Table A
    $sql = "SELECT b.*,a.`drugcode`,a.`amount`   
    FROM ( 
        SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`,`amount` 
        FROM `drugrx` 
        WHERE `year` = '$year' AND `quarter` = '$quarter' 
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
    ) AS a 
    RIGHT JOIN test_in12 AS b ON b.`date_hn` = a.`date_hn` 
    WHERE a.`row_id` IS NOT NULL ";
    $db->select($sql);
    $items = $db->get_items();

}

?>

<style>
/* ตาราง */
body, button{
    font-family: TH SarabunPSK, TH Sarabun NEW;
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
        <th>eGFR</th>
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
        <td><?=$item['ptname'];?></td>
        <td><?=$item['age'];?></td>
        <td><?=$item['egfr'];?></td>
        <td><?=$item['diag'];?></td>
        <td><?=$item['icd10'];?></td>
        <td><?=$item['drugcode'];?></td>
        <td><?=$item['amount'];?></td>
        <td><?=$item['doctor'];?></td>
    </tr>
    <?php
    $i++;
}
?>
</table>