<?php 

include 'bootstrap.php';

// $year = input_get('year');
// $quarter = input_get('quarter');

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

$date = input_get('date');

$sql = "CREATE TEMPORARY TABLE `tmp_diag_in6_a` 
SELECT `diag_id` AS `row_id` ,`svdate`,`hn`,`icd10`,`diag`,`doctor`,`date_hn`,`ptname`
FROM `diag` 
WHERE `svdate` LIKE '$date%' 
#`year` = '$year' AND `quarter` = '$quarter' 
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
GROUP BY `date_hn` 
ORDER BY `svdate`";
$db->exec($sql);


$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in6_a` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`amount`,`date_hn` 
FROM `drugrx` 
WHERE `date` LIKE '$date%' 
#`year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` IN ( 
    '1AMOX250',
    '1AMOX500',
    '1AMOX500-D',
    '1AMOX500-N',
    '1AMOX625',
    '1AUGM1',
    '1AUGM1-C',
    '1AUGM1-N',
    '1CEFS',
    '1CEFT200',
    '1CRAV-NN',
    '1DALA300-N',
    '1DISMR',
    '1DOXY',
    '1ERYT',
    '1FARM',
    '1KLA500-C*',
    '1KLA500-N',
    '1MEIA',
    '1OMNI*$',
    '1RUL150-C',
    '1ZITH*',
    '1ZITH-C',
    '5AMOX',
    '5AMOX250',
    '5AUG35',
    '5AUG35-C',
    '5CEFA',
    '5CEFS',
    '5CEFU',
    '5DIST',
    '5ERY',
    '5MEIA',
    '5ZITH*$',
    '5ZMAX' 
 ) 
GROUP BY `date_hn`"; 
$db->exec($sql);

$sql = "SELECT a.*,b.* 
FROM `tmp_diag_in6_a` AS a 
LEFT JOIN `tmp_drugrx_in6_a` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL ";
$db->select($sql);
$items = $db->get_items();

?> 

<style>
/* ตาราง */
body, button{
    font-family: "TH Sarabun New","TH SarabunPSK";
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

<h3><u>ตัวชี้วัดที่ 6 </u> ตัวตั้ง จำนวนครั้งที่มารับบริการของผู้ป่วยนอกโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลัน ที่ได้รับยาปฏิชีวนะ</h3> 

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

<?php 
$sql = "SELECT a.`doctor`,COUNT(a.`doctor`) AS `count_dr` 
FROM `tmp_diag_in6_a` AS a 
LEFT JOIN `tmp_drugrx_in6_a` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`row_id` IS NOT NULL 
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

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in6_a`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_diag_in6_a`");
