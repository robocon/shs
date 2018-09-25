<?php 

include 'bootstrap.php';

// ไปดึงข้อมูลจากเซิฟเวอร์ .13 เพื่อลดภาระเซิฟเวอร์หลัก 
$configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottwo',
    'pass' => ''
);

$db = Mysql::load($configs);

$date_max = input_get('date_max');
$date_min = input_get('date_min');
$quarter = input_get('quarter');

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in7`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in7` 
SELECT `row_id`,`thidate`,`hn`,`ptname`,`icd10`,`doctor`,`diag`,
SUBSTRING(`age`,1,2) AS `age`,
CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `date_hn` 
FROM `opday` 
WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
AND ( 
    `icd10` IN ( 'A000', 'A001', 'A009' ) 
    OR `icd10` IN ( 'A020' ) 
    OR `icd10` IN ( 'A030', 'A031', 'A032', 'A033', 'A038', 'A039' ) 
    OR `icd10` LIKE 'A04%' 
    OR `icd10` IN ( 'A050', 'A053', 'A054', 'A059' ) 
    OR `icd10` IN ( 'A080', 'A081', 'A082', 'A083', 'A084', 'A085' ) 
    OR `icd10` IN ( 'A09', 'A090', 'A099' ) 
    OR `icd10` IN ( 'K521', 'K528', 'K529' ) 
)";
$db->exec($sql);

$sql = "SELECT * FROM `tmp_opday_in7`";
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

<h3><u>ตัวชี้วัดที่ 7 ไตรมาส <?=$quarter;?></u> ตัวหาร จำนวนครั้งของผู้ป่วยนอกโรคอุจจาระร่วงเฉียบพลันทั้งหมด</h3> 

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>ชื่อผู้ป่วย</th>
        <th>อายุ</th>
        <th>Diag1</th>
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
            <td><?=$item['thidate'];?></td>
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