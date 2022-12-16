<?php 

include 'bootstrap.php';

$db = Mysql::load();
$db->exec("SET NAMES UTF8");

$date = input_get('date');
$table = input_get('table');

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in14`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in14` 
SELECT *  
FROM `opday` 
WHERE `date` LIKE '$date%' 
AND ( `icd10` = 'N183' 
    OR `icd10` = 'N184' 
    OR `icd10` = 'N185' 
    OR `icd10` = 'N189' ) 
GROUP BY `hn` ";
$db->exec($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in14`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in14` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`amount`,COUNT(`hn`) AS `rows` ,`date_hn` 
FROM `drugrx` 
WHERE `date` LIKE '$date%' 
AND `drugcode` IN ( 
    '1CELE200*', 
    '2CLOF', 
    '2DYNA', 
    '1ARCO', 
    '4PLAI', 
    '4VOLT-C', 
    '2KETO', 
    '1MOBI-C', 
    '1ACEO', 
    '1ARCO_60', 
    '1LOXO-N', 
    '1NAPRO', 
    '1VOL-N', 
    '1INDO-N', 
    '2DICL',
    '1VOLT-C',
    '1VOL100'
) 
GROUP BY `hn`";
$db->exec($sql);

if( $table == 'a' ){

    $sql = "SELECT a.*,b.`drugcode`,b.`amount`  
    FROM `tmp_opday_in14` AS a 
    LEFT JOIN `tmp_drugrx_in14` AS b ON b.`date_hn` = a.`date_hn` 
    WHERE b.`row_id` IS NOT NULL";
    $db->select($sql);
    $items = $db->get_items();

}elseif( $table == 'b' ){

    $sql = "SELECT * FROM `tmp_opday_in14` ";
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