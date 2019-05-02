<?php 

include 'bootstrap.php';

// $shs_configs
$db = Mysql::load();

// r09 - 014
// r36 นอกเขต
$sql = "SELECT `row_id`,`idcard`,`hn`,`yot`,`name`,`surname`,`dbirth`,`ptright`,`address`,`tambol`,`ampur`,`changwat`,`sex`, 
TIMESTAMPDIFF( YEAR, thDateToEn(`dbirth`), NOW() ) AS `age` 
FROM `opcard` 
WHERE `name` != 'ยุบประวัติ'  
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
        <th>ชื่อ-สกุล</th>
        <th>hn</th>
        <th>เลขบัตร</th>
        <th>วันเกิด</th>
        <th>อายุ</th>
        <th>สิทธิ</th>
        <th>ที่อยู่</th>
        <th>ต.</th>
        <th>อ.</th>
        <th>จ.</th>
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