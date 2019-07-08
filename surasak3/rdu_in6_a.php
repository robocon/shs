<?php 

include 'bootstrap.php';

$year = input_get('year');
$quarter = input_get('quarter');

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in6`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in6` 
SELECT `diag_id` AS `row_id` ,`regisdate`,`hn`,`icd10`,`date_hn` 
FROM `diag` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND ( 
    `icd10` IN ( 'J00', 'J010', 'J011', 'J012', 'J013', 'J014', 'J018', 'J019' ) 
    OR `icd10` IN ( 'J020', 'J029' ) 
    OR `icd10` IN ( 'J030', 'J038', 'J039' ) 
    OR `icd10` IN ( 'J040', 'J041', 'J042' ) 
    OR `icd10` IN ( 'J050', 'J051' ) 
    OR `icd10` IN ( 'J060', 'J068', 'J069' ) 
    OR `icd10` IN ( 'J101', 'J111' ) 
    OR `icd10` LIKE 'J20%' 
    OR `icd10` IN ( 'J210', 'J218', 'J219' ) 
    OR `icd10` IN ( 'H650','H651','H659','H660','H664','H669','H670','H671','H678','H720','H721','H722','H728','H729' )
) 
GROUP BY `date_hn`";
$db->exec($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in6`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in6` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`amount`,`date_hn` 
FROM `drugrx` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` IN ( 

    '1AMOX250',
    '1AMOX500',
    '1AMOX625',
    '5AMOX',
    '1DIC250',
    '5AMOX250',
    '1AUGM',
    '5AUG35',
    '1AUGM1-C',
    '5AUG35-C',
    '1OMNI*$',
    '1DISMR',
    '1MEIA',
    '2INVA',
    '5CEFS',
    '5DIST',
    '5MEIA',
    '1CEFS',
    '1ERYT',
    '1KLA500-C*',
    '1RUL150-C',
    '1ZITH*',
    '5ERY',
    '5ZITH*$',
    '5ZMAX',
    '1ZITH-C',
    '1KLA500-N',
    '2ZITH',
    '1DOXY',
    '1DALA300-N',
    '1CRAV-NN'

 ) 
GROUP BY `date_hn`"; 
$db->exec($sql);

$sql = "SELECT a.`date`,a.`hn`,a.`ptname`,a.`age`,a.`diag`,a.`icd10`,a.`doctor`,b.`drugcode`,b.`amount`
FROM `tmp_opday_in6` AS a 
LEFT JOIN `tmp_drugrx_in6` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL ";
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

<h3><u>ตัวชี้วัดที่ 6 ไตรมาส <?=$quarter;?></u> ตัวตั้ง จำนวนครั้งที่มารับบริการของผู้ป่วยนอกโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลัน ที่ได้รับยาปฏิชีวนะ</h3> 

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