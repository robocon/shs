<?php 
include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
$db->exec("SET NAMES TIS620");

$year = input_get('year');
$quarter = input_get('quarter');
$table = input_get('table');



$sql = "CREATE TEMPORARY TABLE `tmp_opday_in15` 
SELECT * 
FROM `opday` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `icd10` LIKE 'J45%' 
GROUP BY `hn`";
$test = $db->exec($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in15`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in15` 
SELECT `row_id`,`date`,`hn` AS `hn_drug`,`drugcode`,`amount`,COUNT(`hn`) AS `rows` ,`date_hn` 
FROM `drugrx` 
WHERE `year` = '$year' AND `quarter` = '$quarter'  
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

    $sql = "SELECT a.*,b.`drugcode`,b.`amount` 
    FROM `tmp_opday_in15` AS a 
    LEFT JOIN `tmp_drugrx_in15` AS b ON b.`date_hn` = a.`date_hn` 
    WHERE b.`row_id` IS NOT NULL 
    ORDER BY b.`row_id`";
    $db->select($sql);
    $items = $db->get_items();

}elseif( $table == 'b' ){
    
    $db->select("SELECT * FROM `tmp_opday_in15`");
    $items = $db->get_items();

}

?>

<style>
/* ���ҧ */
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
        <th>���ͼ�����</th>
        <th>����</th>
        <th>Diag</th>
        <th>ICD-10</th>
        <th>Drug code</th>
        <th>�ӹǹ</th>
        <th>ᾷ��</th>
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
