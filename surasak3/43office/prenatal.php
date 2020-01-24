<?php 
include '../bootstrap.php';
include 'lib/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){


    // INSERT INTO `43prenatal` (`id`, `HOSPCODE`, `PID`, `GRAVIDA`, `LMP`, `EDC`, `VDRL_RESULT`, `HB_RESULT`, `HIV_RESULT`, `DATE_HCT`, `HCT_RESULT`, `THALASSEMIA`, `D_UPDATE`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    // UPDATE `43prenatal` SET `id`=NULL, `HOSPCODE`=NULL, `PID`=NULL, `GRAVIDA`=NULL, `LMP`=NULL, `EDC`=NULL, `VDRL_RESULT`=NULL, `HB_RESULT`=NULL, `HIV_RESULT`=NULL, `DATE_HCT`=NULL, `HCT_RESULT`=NULL, `THALASSEMIA`=NULL, `D_UPDATE`=NULL WHERE (ISNULL(`id`));
    dump($_POST);
    exit;
}

include 'head.php';
?>
<!-- <div>
    <h1>แบบบันทึกข้อมูลประวัติตั้งครรภ์ PRENATAL</h1>
</div> -->
<fieldset>
    <legend>แฟ้ม : PRENATAL</legend>
    <form action="prenatal.php" method="post">
        <table>
            <tr>
                <td>ค้นหาตาม HN : </td>
                <td><input type="text" name="hn" id=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">ค้นหา</button>
                    <input type="hidden" name="page" value="search">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?php
$page = input('page');
if ( $page === 'search' ) {
    $hn = input_post('hn');

    $sql = "SELECT * FROM `opday` WHERE `hn` = '$hn' AND `thidate` >= '2561-10-01 00:00:00' ORDER BY `row_id` DESC";
    $db->select($sql);
    $itemPop = $items = $db->get_items();

    $user = array_pop($itemPop);
    ?>
    <div>HN : <?=$user['ptname'];?></div>
    <table class="chk_table">
        <tr>
            <th>วันที่มารับบริการ</th>
            <th>Diag</th>
            <th>แพทย์</th>
            <th>จัดการข้อมูล</th>
        </tr>
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['doctor'];?></td>
            <td><a href="prenatal.php?page=form&id=<?=$item['row_id'];?>">บันทึก</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    
    <?php
}elseif ($page === 'form') {
    
    $row_id = input_get('id');
    $sql = "SELECT * FROM `opday` WHERE `row_id` = '$row_id' LIMIT 1";
    $db->select($sql);
    $item = $db->get_item();

    ?>
    <style type="text/css">
    table td{
        vertical-align: top;
    }
    </style>
    <fieldset>
        <legend>ฟอร์มบันทึก PRENATAL</legend>
        <form action="prenatal.php" method="post">
            <table>
                <tr>
                    <td style="text-align: right;">รหัสสถานบริการ : </td>
                    <td><input type="text" name="HOSPCODE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td style="text-align: right;">ทะเบียนบุคคล : </td>
                    <td><input type="text" name="PID" value="<?=$item['hn'];?>" readonly></td>
                </tr>
                <tr>
                    <td style="text-align: right;">ครรภ์ที่ : </td>
                    <td><input type="text" name="GRAVIDA" id="">(ไม่ใส่ 0 นำหน้าเช่น 1,2,10)</td>
                </tr>
                <tr>
                    <td style="text-align: right;">วันแรกของการมีประจำเดือนครั้งสุดท้าย : </td>
                    <td><input type="text" name="LMP" id="LMP"></td>
                </tr>
                <tr>
                    <td style="text-align: right;">วันที่กำหนดคลอด : </td>
                    <td><input type="text" name="EDC" id="EDC"></td>
                </tr>
                <tr>
                    <td style="text-align: right;">ผลการตรวจ VDRL_RS : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_prenatal_174`");
                        $vdrlLists = $db->get_items();
                        $i = 1;
                        foreach ($vdrlLists as $key => $item) {
                            ?>
                            <input type="radio" name="VDRL_RESULT" id="vdrl<?=$i;?>" value="<?=$item['code'];?>"><label for="vdrl<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">ผลการตรวจ HB_RS : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_prenatal_174`");
                        $hbLists = $db->get_items();
                        $i = 1;
                        foreach ($hbLists as $key => $item) {
                            ?>
                            <input type="radio" name="HB_RESULT" id="hb<?=$i;?>" value="<?=$item['code'];?>"><label for="hb<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">ผลการตรวจ HIV_RS : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_prenatal_176`");
                        $hivLists = $db->get_items();
                        $i = 1;
                        foreach ($hivLists as $key => $item) {
                            ?>
                            <input type="radio" name="HIV_RESULT" id="hiv<?=$i;?>" value="<?=$item['code'];?>"><label for="hiv<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">วันที่ตรวจ HCT</td>
                    <td><input type="text" name="DATE_HCT" id="DATE_HCT"></td>
                </tr>
                <tr>
                    <td style="text-align: right;">ผลการตรวจ HCT</td>
                    <td><input type="text" name="HCT_RESULT" id=""></td>
                </tr>
                <tr>
                    <td style="text-align: right;">ผลการตรวจ THALASSAEMIA</td>
                    <td><input type="text" name="THALASSAEMIA" id=""></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">บันทึกข้อมูล</button>
                        <input type="hidden" name="D_UPDATE">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <script type="text/javascript">
        var popup1, popup2, popup3;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('LMP'),false);
            popup2 = new Epoch('popup2','popup',document.getElementById('EDC'),false);
            popup3 = new Epoch('popup2','popup',document.getElementById('DATE_HCT'),false);
        };
    </script>
    <?php

}

include 'footer.php';