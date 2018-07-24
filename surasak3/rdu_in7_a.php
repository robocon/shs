<?php

include 'bootstrap.php';

// 仴֧�����Ũҡ�Կ����� .13 ����Ŵ�����Կ�������ѡ 
$configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottwo',
    'pass' => '12345678'
);

$db = Mysql::load($configs);

// $db->exec("SET NAMES UTF8");

$date_max = input_get('date_max');
$date_min = input_get('date_min');
$quarter = input_get('quarter');

$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in7`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in7` 
SELECT `row_id`,`thidate`,`hn`,`icd10` 
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
$db->select($sql);

$db->select("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in7`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in7` 
SELECT `row_id`,`date`,`hn`,`drugcode`  
FROM `drugrx` 
WHERE ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
AND `status` = 'Y' 
AND `an` IS NULL 
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
$db->select($sql); 

$in7a = $in7b = $in7_result = 0;

$sql = "SELECT a.*,b.*,CONCAT(c.`yot`,c.`name`,' ',c.`surname`) AS `ptname` 
FROM `tmp_opday_in7` AS a 
LEFT JOIN `tmp_drugrx_in7` AS b ON b.`hn` = a.`hn` 
LEFT JOIN `opcard` AS c ON c.`hn` = a.`hn`
WHERE b.`row_id` IS NOT NULL 
ORDER BY a.`thidate` ASC";
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

<h3><u>��Ǫ���Ѵ��� 7 (����� <?=$quarter;?>)</u> ��ǵ�� �ӹǹ���駢ͧ�����¹͡�ä�ب������ǧ��º��ѹ������Ѻ�һ�Ԫ�ǹ�</h3> 

<table class="chk_table">
    <tr>
        <th>�ӴѺ</th>
        <th>�ѹ���</th>
        <th>HN</th>
        <th>����ʡ��</th>
        <th>ICD10</th>
        <th>����</th>
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
        <td><?=$item['icd10'];?></td>
        <td><?=$item['drugcode'];?></td>
    </tr>
    <?php
    $i++;
}
?>
</table>