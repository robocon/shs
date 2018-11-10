<?php 

include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
$db->exec("SET NAMES TIS620");

$year = input_get('year');
$quarter = input_get('quarter');

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in8`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in8` 
SELECT `row_id`,`date`,`hn`,`ptname`,`age`,`diag`,`icd10`,`doctor`,`date_hn` 
FROM `opday` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND ( 
    `icd10` IN ( 'S00', 'S01', 'S05', 'S07', 'S08', 'S09', 'S10', 'S11' ) 
    OR `icd10` IN ( 'S16', 'S17', 'S18', 'S19', 'S20', 'S21' ) 
    OR `icd10` regexp 'S(2[8-9]|3[0-1])' 
    OR `icd10` regexp 'S(3[8-9]|4[0-1])' 
    OR `icd10` regexp 'S{1}([4-8]([6-9]|[0-1]))' 
    OR `icd10` regexp 'S(8[6-9]|9[0-1]|9[6-9])' 
    OR `icd10` regexp 'T(0[0-1]|[4-7])' 
    OR `icd10` regexp 'T([09|11|13|14][0-1])' 
    OR `icd10` regexp 'T(14[6-9])' 
    OR `icd10` regexp 'T(2[0-5])' 
    OR `icd10` regexp 'T(29|3[0-2])' 
    OR `icd10` regexp 'X([0-1][0-9])' 
    OR `icd10` regexp 'X([2-3][0-9])' 
)";
$db->exec($sql);

$sql = "SELECT * FROM `tmp_opday_in8`";
$db->select($sql);
$items = $db->get_items();

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

<h3><u>ตัวชี้วัดที่ 8 (ไตรมาส <?=$quarter;?>)</u> ตัวหาร จำนวนครั้งของผู้ป่วยนอกบาดแผลสดจากอุบัติเหตุทั้งหมด</h3> 

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