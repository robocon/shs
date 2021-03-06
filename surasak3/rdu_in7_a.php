<?php

include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

// $year = input_get('year');
// $quarter = input_get('quarter');
$date = input_get('date');

$sql = "CREATE TEMPORARY TABLE `tmp_opday_in7` 
SELECT `row_id`,`date`,`hn`,`ptname`,`age`,`diag`,`icd10`,`doctor`,`date_hn`
FROM `opday` 
WHERE `date` LIKE '$date%' 
#`year` = '$year' AND `quarter` = '$quarter' 
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

$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in7` 
SELECT `row_id`,`date`,`hn`,`drugcode`,`amount`,`date_hn` 
FROM `drugrx` 
WHERE `date` LIKE '$date%' 
#`year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` IN ( 
    '1CIPR-C*?',
    '1CRAV*',
    '1TARI-C',
    '1LEX400-C',
    '1CRAV-NN',
    '1TAR300',
    '1CRAV-C',
    '1CRAV-N',
    '1TARI-N',
    '1LEX400-N',
    '1GRAC',
    '1ERYT',
    '5ERY',
    '5ZITH*$',
    '5ZMAX',
    '1ZITH-C',
    '1ZITH*',
    '1DOXY',
    '1COTR4' 
); "; 
$db->exec($sql); 

$sql = "SELECT a.`date`,a.`hn`,a.`ptname`,a.`age`,a.`diag`,a.`icd10`,a.`doctor`,b.`drugcode`,b.`amount` 
FROM `tmp_opday_in7` AS a 
LEFT JOIN `tmp_drugrx_in7` AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL";
$db->select($sql);
$items = $db->get_items();

?>

<style>
/* ���ҧ */
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

<h3><u>��Ǫ���Ѵ��� 7</u> ��ǵ�� �ӹǹ���駢ͧ�����¹͡�ä�ب������ǧ��º��ѹ������Ѻ�һ�Ԫ�ǹ�</h3> 

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>���ͼ�����</th>
        <th>����</th>
        <th>Diag1</th>
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
<div>&nbsp;</div>
<?php 
$sql = "SELECT a.`doctor`,a.`doctor`,COUNT(a.`doctor`) AS `count_dr` 
FROM `tmp_opday_in7` AS a 
LEFT JOIN `tmp_drugrx_in7` AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL 
GROUP BY a.`doctor` 
ORDER BY COUNT(a.`doctor`) DESC";
$db->select($sql);
$items = $db->get_items();
?>
<table class="chk_table">
    <tr>
        <th>����ᾷ��</th>
        <th>�ӹǹ</th>
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
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in7`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in7`");