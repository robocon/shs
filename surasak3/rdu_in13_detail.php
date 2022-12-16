<?php 

include 'bootstrap.php';

$db = Mysql::load();
$db->exec("SET NAMES UTF8");

// $year = input_get('year');
// $quarter = input_get('quarter');
$table = input_get('table');
$date = input_get('date');

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_rdu_in13`");
$sql = "CREATE TEMPORARY TABLE `tmp_rdu_in13` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`amount`,COUNT(`hn`) AS `rows` ,`date_hn` 
FROM `rdu_drugrx` 
WHERE `date` LIKE '$date%' 
AND `drugcode` IN ( 
    '1CELE200*',
    '1ARCO',
    '1MOBI-C',
    '1ACEO',
    '1ARCO_60',
    '1LOXO-N',
    '1NAPRO',
    '1VOL-N',
    '1INDO-N',
    '1VOLT-C',
    '1VOL100'
) 
GROUP BY `date_hn`";
$db->exec($sql);

if( $table == 'a' ){
    $sql = "SELECT * FROM `tmp_rdu_in13` WHERE `rows` >= 2 ";
    $db->select($sql);
    $items = $db->get_items();

}elseif( $table == 'b' ){
    $sql = "SELECT * FROM `tmp_rdu_in13` WHERE `rows` >= 1 ";
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