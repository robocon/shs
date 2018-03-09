<?php

include 'bootstrap.php';

$def_date = input('date', date('Y-m-d'));
$action = input('action');
?>
<style type="text/css">
*{
    font-family: 'TH SarabunPSK';
}
@media print{
    .no-print{
        display: none;
    }
}

</style>

<div class="no-print">
    <a href="../nindex.htm">&lt;&lt;&nbsp;กลับไปหน้าโปรแกรม รพ.</a>
</div>
<br>
<form action="dx_ofyear_out_sso.php" method="post" class="no-print">

    <div>
        เลือกวันที่ <input type="text" name="date" id="" value="<?=$def_date;?>">
    </div>

    <div>
        <button type="submit">แสดงข้อมูล</button>
        <input type="hidden" name="action" value="show">
    </div>

</form>

<?php
if( $action === 'show' ){

    $match = preg_match('/\d{4,4}\-\d{2,2}\-\d{2,2}/', $def_date);
    if( $match == 0 ){
        echo "กรุณาเลือกรูปแบบวันที่เป็น ปี-เดือน-วัน เช่น 2017-12-25 เป็นต้น";
        exit;
    }

    $db = Mysql::load();

    $sql = "SELECT * FROM `dxofyear_out` WHERE `thidate` LIKE '$def_date%' ";
    $db->select($sql);
    $items = $db->get_items();
    if( count($items) > 0 ){
        
        ?>
        <h3>รายชื่อผู้ตรวจสุขภาพ Walk-in วันที่ <?=$def_date;?></h3>
        <table border="1" cellpadding="3" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff">
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
                <th>CBC</th>
                <th>UA</th>
                <th>น้ำตาลในเลือด FBS</th>
                <th>ไต(CREA)</th>
                <th>Total Cholesterol</th>
                <th>HDL Cholesterol</th>
                <th>HBsAg</th>
            </tr>
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
            END AS `res_hbsag` 
            FROM `chk_doctor` 
            WHERE `hn` = '".$item['hn']."' 
            AND `vn` = '".$item['vn']."' ";

            $db->select($sql);
            $user = $db->get_item();

            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['thidate'];?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['vn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td align="right"><?=$item['height'];?></td>
                <td align="right"><?=$item['weight'];?></td>
                <td align="right"><?=$item['temperature'];?></td>
                <td align="right"><?=$item['pause'];?></td>
                <td align="right"><?=$item['rate'];?></td>
                <td align="right"><?=$item['bmi'];?></td>
                <td align="right"><?=$item['bp1'];?></td>
                <td align="right"><?=$item['bp2'];?></td>
                <td><?=$user['res_cbc'];?></td>
                <td><?=$user['res_ua'];?></td>
                <td><?=$user['res_glu'];?></td>
                <td><?=$user['res_crea'];?></td>
                <td><?=$user['res_chol'];?></td>
                <td><?=$user['res_hdl'];?></td>
                <td><?=$user['res_hbsag'];?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </table>
        <?php
    }else{
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
}