<?php 

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT a.`HN`,a.`row`,a.`ptname2`,b.*  
FROM ( 
    SELECT *,CONCAT(`name`,' ',`surname`) AS `ptname2` FROM `opcardchk` WHERE `part` = 'ลูกจ้าง62' 
) AS a 
LEFT JOIN ( 
    SELECT * FROM `dxofyear_out` WHERE `yearchk` = '62'
) AS b ON b.`hn` = a.`HN`";

$db->select($sql);

$items = $db->get_items();

?>

<style>
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table, th, td{
        border: 1px solid black;
    }

    .chk_table th,
    .chk_table td{
        padding: 3px;
    }
</style>
<h3>ตรวจลูกจ้างให้ห้องประกันสังคม</h3>
<table class="chk_table">
    <thead>
        <tr>
            <th>#</th>
            <th>วันที่</th>
            <th>HN</th>
            <th>VN</th>
            <th>ชื่อ-สกุล</th>
            <th>สูง(cm.)</th>
            <th>นน.(kg.)</th>
            <th>T(&#8451;)</th>
            <th>pause</th>
            <th>rate</th>
            <th>bmi</th>
            <th>bp1</th>
            <th>bp2</th>
            <th>CXR</th>
            <th>CBC</th>
            <th>UA</th>
            <th>น้ำตาลในเลือด FBS</th>
            <th>ไต(CREA)</th>
            <th>Total Cholesterol</th>
            <th>HDL Cholesterol</th>
            <th>HBsAg</th>
            <th>Diag</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    foreach ($items as $key => $item) {
        
        $sql = "SELECT 
        CASE
            WHEN `res_cbc` = 1 THEN 'ปกติ' 
            WHEN `res_cbc` = 2 THEN 'ผิดปกติ' 
            ELSE ''
        END AS `res_cbc`,
        CASE
            WHEN `res_ua` = 1 THEN 'ปกติ' 
            WHEN `res_ua` = 2 THEN 'ผิดปกติ' 
            ELSE ''
        END AS `res_ua`,
        CASE
            WHEN `res_glu` = 1 THEN 'ปกติ' 
            WHEN `res_glu` = 2 THEN 'ผิดปกติ' 
            ELSE ''
        END AS `res_glu`,
        CASE
            WHEN `res_crea` = 1 THEN 'ปกติ' 
            WHEN `res_crea` = 2 THEN 'ผิดปกติ' 
            ELSE ''
        END AS `res_crea`,
        CASE
            WHEN `res_chol` = 1 THEN 'ปกติ' 
            WHEN `res_chol` = 2 THEN 'ผิดปกติ' 
            ELSE ''
        END AS `res_chol`,
        CASE
            WHEN `res_hdl` = 1 THEN 'ปกติ' 
            WHEN `res_hdl` = 2 THEN 'ผิดปกติ' 
            ELSE ''
        END AS `res_hdl`,
        CASE
            WHEN `res_hbsag` = 1 THEN 'ปกติ' 
            WHEN `res_hbsag` = 2 THEN 'ผิดปกติ' 
            ELSE ''
        END AS `res_hbsag`, 
        CASE
            WHEN `cxr` = 1 THEN 'ปกติ' 
            WHEN `cxr` = 2 THEN 'ผิดปกติ' 
            ELSE ''
        END AS `cxr`, 
        `diag` 
        FROM `chk_doctor` 
        WHERE `hn` = '".$item['hn']."' 
        AND ( `date_chk` LIKE '".$item['short_date']."%' OR `vn` = '".$item['vn']."' )";

        $db->select($sql);
        $user = $db->get_item();
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['HN'];?></td>
            <td><?=$item['vn'];?></td>
            <td><?=$item['ptname2'];?></td>
            <td align="right"><?=$item['height'];?></td>
            <td align="right"><?=$item['weight'];?></td>
            <td align="right"><?=$item['temperature'];?></td>
            <td align="right"><?=$item['pause'];?></td>
            <td align="right"><?=$item['rate'];?></td>
            <td align="right"><?=$item['bmi'];?></td>
            <td align="right"><?=$item['bp1'];?></td>
            <td align="right"><?=$item['bp2'];?></td>
            <td><?=$user['cxr'];?></td>
            <td><?=$user['res_cbc'];?></td>
            <td><?=$user['res_ua'];?></td>
            <td><?=$user['res_glu'];?></td>
            <td><?=$user['res_crea'];?></td>
            <td><?=$user['res_chol'];?></td>
            <td><?=$user['res_hdl'];?></td>
            <td><?=$user['res_hbsag'];?></td>
            <td><?=$user['diag'];?></td>
        </tr>
        <?php
        $i++;
    }
    ?>
    </tbody>
</table>
