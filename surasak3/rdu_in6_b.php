<?php 

include 'bootstrap.php';

$year = input_get('year');
$quarter = input_get('quarter');

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_diag_in6_a`");
$sql = "CREATE TEMPORARY TABLE `tmp_diag_in6_a` 
SELECT `diag_id` AS `row_id` ,`svdate`,`hn`,`icd10`,`diag`,`doctor`,`date_hn` 
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

$sql = "SELECT * FROM `tmp_diag_in6_a`";
$db->select($sql);
$items = $db->get_items();
?> 

<style>
/* ���ҧ */
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

<h3><u>��Ǫ���Ѵ��� 6 ����� <?=$quarter;?></u> ������ �ӹǹ���駷�����Ѻ��ԡ�âͧ�����¹͡�ä�Դ���ͷ���к�������㨪�ǧ�������ʹ���ѡ�ʺ��º��ѹ������</h3> 

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

<?php 
$sql = "SELECT `doctor`,COUNT(`doctor`) AS `count_dr` FROM `tmp_diag_in6_a` GROUP BY `doctor` ORDER BY COUNT(`doctor`) DESC";
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