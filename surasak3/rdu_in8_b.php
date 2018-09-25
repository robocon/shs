<?php 

include 'bootstrap.php';

// 仴֧�����Ũҡ�Կ����� .13 ����Ŵ�����Կ�������ѡ 
$configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottwo',
    'pass' => ''
);

$db = Mysql::load($configs);

// $db->exec("SET NAMES UTF8");

$date_max = input_get('date_max');
$date_min = input_get('date_min');
$quarter = input_get('quarter');


$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in8`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in8` 
SELECT `row_id`,`thidate`,`hn`,`ptname`,`icd10`,`doctor`,`diag`,
SUBSTRING(`age`,1,2) AS `age`,
CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `date_hn` 
FROM `opday` 
WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
AND `an` IS NULL 
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

<h3><u>��Ǫ���Ѵ��� 8 (����� <?=$quarter;?>)</u> ������ �ӹǹ���駢ͧ�����¹͡�Ҵ��ʴ�ҡ�غѵ��˵ط�����</h3> 

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>���ͼ�����</th>
        <th>����</th>
        <th>Diag1</th>
        <th>Diag2</th>
        <th>Diag3</th>
        <th>Diag4</th>
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
            <td><?=$item['thidate'];?></td>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['age'];?></td>
            <td><?=$item['diag'];?></td>
            <td></td>
            <td></td>
            <td></td>
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