<?php 

include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

// $year = input_get('year');
// $quarter = input_get('quarter');
$date = input_get('date');

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in8` 
SELECT a.`hn`,a.`organ`,a.`maintenance`,
b.`row_id`,b.`svdate`,b.`icd10`,a.`date_hn`,b.`diag`,b.`doctor` 
FROM ( 
    SELECT `trauma_id` AS `row_id`,`hn`,`organ`,`maintenance`,`date_hn`
    FROM trauma 
    WHERE `date` LIKE '$date%' 
    #`year` = '$year' AND `quarter` = '$quarter' 
    AND ( 
        `organ` REGEXP 'มีด|mc|แผล|ทิ่ม|แทง|บาด' 
    )
    AND ( `organ` NOT REGEXP 'ไม่มีบาดแผล|ไม่มีแผล|ทำแผล|ล้างแผล|แผลเย็บ|กัด|ข่วน|เขี้ยว|วัน|สัปดาห์|เดือน|ผ่าตัด|นัด|ตาย|day|bed' ) 
) AS a 
LEFT JOIN ( 
    SELECT `diag_id` AS `row_id`,`svdate`,`icd10`,`date_hn`,`diag`,`doctor`,`ptname` 
    FROM `diag` 
    WHERE `svdate` LIKE '$date%' 
    #`year` = '$year' AND `quarter` = '$quarter' 
    AND ( 
        `icd10` IN ( 'S00', 'S01', 'S05', 'S07', 'S08', 'S09', 'S10', 'S11' ) 
        OR `icd10` IN ( 'S16', 'S17', 'S18', 'S19', 'S20', 'S21' ) 
        OR `icd10` REGEXP 'S(2[8-9]|3[0-1])' 
        OR `icd10` REGEXP 'S(3[8-9]|4[0-1])' 
        OR `icd10` REGEXP 'S{1}([4-8]([6-9]|[0-1]))' 
        OR `icd10` REGEXP 'S(8[6-9]|9[0-1]|9[6-9])' 
        OR `icd10` REGEXP 'X([0-1][0-9])' 
        OR `icd10` REGEXP 'X([2-3][0-9])' 
    ) 
    GROUP BY `hn`
) AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL ";
$db->exec($sql);

$sql = "SELECT * FROM `tmp_opday_in8`";
$db->select($sql);
$items = $db->get_items();
?>

<style>
/* ตาราง */
body, button{
    font-family: "TH Sarabun New", "TH SarabunPSK";
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

<div>&nbsp;</div>
<?php 
$sql = "SELECT a.`doctor`,a.`doctor`,COUNT(a.`doctor`) AS `count_dr` 
FROM `tmp_opday_in8` AS a 
GROUP BY a.`doctor` 
ORDER BY COUNT(a.`doctor`) DESC";
$db->select($sql);
$items = $db->get_items();
?>
<table class="chk_table">
    <tr>
        <th>ชื่อแพทย์</th>
        <th>จำนวน</th>
    </tr>
    <?php 
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['doctor'];?></td>
            <td><?=$item['count_dr'];?></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php 
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in8`");