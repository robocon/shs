<?php 

include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

$year = input_get('year');
$quarter = input_get('quarter');

$sql = "SELECT `row_id`,`date`,`hn`,`ptname`,`age`,`diag`,`icd10`,`doctor`,`date_hn`
FROM `opday` 
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
$db->select($sql);
$items = $db->get_items();


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

<h3><u>��Ǫ���Ѵ��� 7 (����� <?=$quarter;?>)</u> ������ �ӹǹ���駢ͧ�����¹͡�ä�ب������ǧ��º��ѹ������</h3> 

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