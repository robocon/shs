<?php 
include 'bootstrap.php';

$db = Mysql::load($rdu_configs);

$table = input_get('table');
$date = input_get('date');

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in16` 
SELECT *  
FROM `opday` 
WHERE `date` LIKE '$date%' 
AND TRIM(SUBSTRING(`age`,1,2)) > 65 
GROUP BY `date_hn` ";
$db->exec($sql);

$sql = "CREATE TEMPORARY TABLE `tmp_drug_in16` 
SELECT a.*,b.`drugcode`,`amount`,'1' AS `test_hn` 
FROM `tmp_opday_in16` AS a 
LEFT JOIN ( 
    SELECT `row_id`,`drugcode`,`part`,`amount`,`date_hn` 
    FROM `drugrx` 
    WHERE `date` LIKE '$date%' 
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
$db->exec($sql);

if( $table == 'a' ){

    // A
    $sql = "SELECT * FROM `tmp_drug_in16` ";
    $db->select($sql);
    $items = $db->get_items();

}elseif( $table == 'b' ){

    // B
    $sql = "SELECT * FROM `tmp_opday_in16` ";
    $db->select($sql);
    $items = $db->get_items();

}

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in16`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drug_in16`");

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