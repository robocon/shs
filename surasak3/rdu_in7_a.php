<?php

include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

$year = input_get('year');
$quarter = input_get('quarter');

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_diag_in7a`");
$sql = "CREATE TEMPORARY TABLE `tmp_diag_in7a` 
SELECT `diag_id` AS `row_id`,`svdate`,`hn`,`icd10`,`type`,`diag`,`doctor`,`date_hn` 
FROM `diag` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
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

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in7b`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in7b` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`amount`,`date_hn` 
FROM `drugrx` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` IN ( 
    '1CIPR-C*?', 
    '1CRAV*', 
    '1TARI-C', 
    '1LEX400-C', 
    '1CRAV-NN', 
    '1TAR300', 
    '1CRAV-C', 
    '1CRAV-N', 
    '1LEX400-N', 
    '1OMNI*$', 
    '1MEIA', 
    '5CEFS', 
    '5DIST', 
    '5MEIA', 
    '1CEFS' 
); "; 
$db->exec($sql); 

$sql = "SELECT b.`date`,a.`hn`,a.`diag`,a.`icd10`,a.`doctor`,b.`drugcode`,b.`amount` 
FROM `tmp_diag_in7a` AS a 
LEFT JOIN `tmp_drugrx_in7b` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL 
AND a.`type` = 'PRINCIPLE'";
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

<h3><u>ตัวชี้วัดที่ 7 (ไตรมาส <?=$quarter;?>)</u> ตัวตั้ง จำนวนครั้งของผู้ป่วยนอกโรคอุจจาระร่วงเฉียบพลันที่ได้รับยาปฏิชีวนะ</h3> 

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