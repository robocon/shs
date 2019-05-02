<?php 

include 'bootstrap.php';

// $shs_configs
$db = Mysql::load();

// r09 - 014
// r36 �͡ࢵ
$sql = "SELECT `row_id`,`idcard`,`hn`,`yot`,`name`,`surname`,`dbirth`,`ptright`,`address`,`tambol`,`ampur`,`changwat`,`sex`, 
TIMESTAMPDIFF( YEAR, thDateToEn(`dbirth`), NOW() ) AS `age` 
FROM `opcard` 
WHERE `name` != '�غ����ѵ�'  
AND `ptright` REGEXP 'R(09|1[0-4]|36)' 
AND ( 
    TIMESTAMPDIFF( YEAR, thDateToEn(`dbirth`), NOW() ) >= 50 
    AND 
    TIMESTAMPDIFF( YEAR, thDateToEn(`dbirth`), NOW() ) <= 70 
) 
ORDER BY `changwat`,`ampur`,`tambol`,`address` ASC ";
$db->select($sql);
$items = $db->get_items();

?>
<style>
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 14pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
    padding: 3px;
}
</style>

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>����-ʡ��</th>
        <th>hn</th>
        <th>�Ţ�ѵ�</th>
        <th>�ѹ�Դ</th>
        <th>����</th>
        <th>�Է��</th>
        <th>�������</th>
        <th>�.</th>
        <th>�.</th>
        <th>�.</th>
    </tr>
<?php 
$i = 1;
foreach ($items as $key => $item) { 

    $ptname = $item['yot'].$item['name'].' '.$item['surname'];
    ?>
    <tr>
        <td><?=$i;?></td>
        <td><?=$ptname;?></td>
        <td><?=$item['hn'];?></td>
        <td><?=$item['idcard'];?></td>
        <td><?=$item['dbirth'];?></td>
        <td><?=$item['age'];?></td>
        <td><?=$item['ptright'];?></td>
        <td><?=$item['address'];?></td>
        <td><?=$item['tambol'];?></td>
        <td><?=$item['ampur'];?></td>
        <td><?=$item['changwat'];?></td>
    </tr>
    <?php
    $i++;
}
?>
</table>