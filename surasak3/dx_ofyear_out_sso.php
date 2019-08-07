<?php

include 'bootstrap.php';

$db = Mysql::load();

$def_date = input('date', date('Y-m-d'));
$hn = input('hn');
$action = input('action');
?>
<style type="text/css">
*{
    font-family: TH SarabunPSK;
    font-size: 18px;
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

<fieldset class="no-print">
    <legend>ค้นหาตามวันที่</legend>
    <form action="dx_ofyear_out_sso.php" method="post">
        <div>
            เลือกวันที่ <input type="text" name="date" id="" value="<?=$def_date;?>">
        </div>
        <div>
            <button type="submit">แสดงข้อมูล</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>
</fieldset>

<fieldset class="no-print">
    <legend>ค้นหาตามHN</legend>
    <form action="dx_ofyear_out_sso.php" method="post">
        <div>
            เลือกHN <input type="text" name="hn" id="" value="<?=$hn;?>">
        </div>
        <div>
            <button type="submit">แสดงข้อมูล</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>
</fieldset>

<fieldset class="no-print">
    <legend>ค้นหาตามบริษัท</legend>
    <form action="dx_ofyear_out_sso.php" method="post">
        <?php 
        $db->select("SELECT `code`,`name` FROM `chk_company_list` ORDER BY `id` DESC");
        $company_list = $db->get_items();
        ?>
        <div>
            เลือกบริษัท: 
            <select name="company_name" id="">
                <?php 
                foreach ($company_list as $key => $item) {
                    ?>
                    <option value="<?=$item['code'];?>"><?=$item['name'];?> (<?=$item['code'];?>)</option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <button type="submit">แสดงข้อมูล</button>
            <input type="hidden" name="action" value="show">
            <input type="hidden" name="type" value="company">
        </div>
    </form>
</fieldset>
<?php
if( $action === 'show' ){

    $test_type = input_post('type');
    if( $test_type == 'company' ){

        $part = input('company_name');

        $sql_com = "SELECT * FROM `chk_company_list` WHERE `code` = '$part' ";
        $db->select($sql_com);
        $company = $db->get_item();

        $sql = "SELECT b.* 
        FROM `opcardchk` AS a 
        LEFT JOIN `dxofyear_out` AS b ON b.`hn` = a.`HN` 
        WHERE a.`part` = '$part' 
        AND b.`camp` LIKE 'ตรวจสุขภาพ%' ";

        $db->select($sql);
        $rows = $db->get_rows();

    }else{

        $where = "AND `thidate` LIKE '$def_date%' ";
        if( !empty($hn) ){
            $where = "AND `hn` = '$hn' ORDER BY `row_id` DESC";
        }

        // อันเก่าเป็น `camp` LIKE 'ตรวจสุขภาพ%'
        $sql = "SELECT *, SUBSTRING(`thidate`, 1, 10) AS `short_date`  
        FROM `dxofyear_out` 
        WHERE `camp` LIKE 'ตรวจสุขภาพ%' 
        $where ";

        $db->select($sql);
        $rows = $db->get_rows();
        
    }
    
    if( $rows > 0 ){
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
        <?php 
        if( $test_type == 'company' ){
            ?>
            <div class="no-print" style="margin: 4px;">
                <button onclick="window.print();">คลิกเพื่อสั่งพิมพ์ผล <?=$company['name'];?></button>
            </div>
            <h3>บริษัท <?=$company['name'];?></h3>
            <?php
        }else{
            ?>
            <h3>รายชื่อผู้ตรวจสุขภาพ Walk-in วันที่ <?=$def_date;?></h3>
            <?php
        }
        ?>
        <table class="chk_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>วันที่</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>สูง(cm.)</th>
                    <th>นน.(kg.)</th>
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
                    <th>Occult(FOBT)</th>
                    <th>สรุปผลตรวจ</th>
                    <th>Diag</th>
                    <th>เลขบัตร ปชช.</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทร</th>
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
                CASE
                    WHEN `res_occult` = 1 THEN 'ปกติ' 
                    WHEN `res_occult` = 2 THEN 'ผิดปกติ' 
                    ELSE ''
                END AS `res_occult`, 
                CASE 
                    WHEN `conclution` = 1 THEN 'ปกติ' 
                    WHEN `conclution` = 2 THEN 'ผิดปกติ' 
                    ELSE '' 
                END AS `conclution`, 
                `diag` 
                FROM `chk_doctor` 
                WHERE `hn` = '".$item['hn']."' 
                AND ( `date_chk` LIKE '".$item['short_date']."%' OR `vn` = '".$item['vn']."' )";
                $db->select($sql);
                $user = $db->get_item();

                $hn = $item['hn'];

                $sql_opcard = "SELECT `idcard`,`address`,`tambol`,`ampur`,`changwat`,`hphone`,`phone` 
                FROM `opcard` 
                WHERE `hn` = '$hn' ";
                $db->select($sql_opcard);
                $opcard = $db->get_item();

                $address = $opcard['address'];
                if( $opcard['tambol'] ){
                    $address .= ' ต.'.$opcard['tambol'];
                }

                if( $opcard['ampur'] ){
                    $address .= ' อ.'.$opcard['ampur'];
                }

                if( $opcard['changwat'] ){
                    $address .= ' จ.'.$opcard['changwat'];
                }

                $phone = $opcard['phone'].' '.$opcard['hphone'];
                ?>
                <tr valign="top">
                    <td><?=$i;?></td>
                    <td><?=$item['thidate'];?></td>
                    <td><?=$hn;?></td>
                    <td><?=$item['ptname'];?></td>
                    <td align="right"><?=$item['height'];?></td>
                    <td align="right"><?=$item['weight'];?></td>
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
                    <td><?=$user['res_occult'];?></td>
                    <td><?=$user['conclution'];?></td>
                    <td><?=$user['diag'];?></td>
                    <td><?=$opcard['idcard'];?></td>
                    <td><?=$address;?></td>
                    <td><?=$phone;?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </tbody>
        </table>
        <?php
    }else{
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
}