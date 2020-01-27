<?php 
include '../bootstrap.php';
include 'lib/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $GRAVIDA = input_post('GRAVIDA');
    $LMP = input_post('LMP');
    $LMP = bc_to_ad($LMP);

    $EDC = input_post('EDC');
    $EDC = bc_to_ad($EDC);

    $VDRL_RESULT = input_post('VDRL_RESULT');
    $HB_RESULT = input_post('HB_RESULT');
    $HIV_RESULT = input_post('HIV_RESULT');
    $DATE_HCT = input_post('DATE_HCT');
    $DATE_HCT = bc_to_ad($DATE_HCT);

    $HCT_RESULT = input_post('HCT_RESULT');
    $THALASSAEMIA = input_post('THALASSAEMIA');
    $D_UPDATE = input_post('D_UPDATE');
    $PROVIDER = input_post('PROVIDER');
    $CID = input_post('CID');

    $opday_id = input_post('opday_id');

    $sql = "INSERT INTO `43prenatal` ( 
        `id`, `HOSPCODE`, `PID`, `GRAVIDA`, `LMP`, `EDC`, 
        `VDRL_RESULT`, `HB_RESULT`, `HIV_RESULT`, `DATE_HCT`, `HCT_RESULT`, `THALASSEMIA`, 
        `D_UPDATE`,`PROVIDER`,`CID`,`opday_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$GRAVIDA', '$LMP', '$EDC', 
        '$VDRL_RESULT', '$HB_RESULT', '$HIV_RESULT', '$DATE_HCT', '$HCT_RESULT', '$THALASSAEMIA', 
        '$D_UPDATE','$PROVIDER','$CID', '$opday_id' 
    );";
    $save = $db->insert($sql);

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    // UPDATE `43prenatal` SET `id`=NULL, `HOSPCODE`=NULL, `PID`=NULL, `GRAVIDA`=NULL, `LMP`=NULL, `EDC`=NULL, `VDRL_RESULT`=NULL, `HB_RESULT`=NULL, `HIV_RESULT`=NULL, `DATE_HCT`=NULL, `HCT_RESULT`=NULL, `THALASSEMIA`=NULL, `D_UPDATE`=NULL WHERE (ISNULL(`id`));
    // dump($_POST);

    redirect('prenatal.php', $msg);
    exit;
}

include 'head.php';
?>
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
    $user = $db->get_item();

    if( preg_match('/MD\d+/', $user['doctor']) > 0 ){
        $prefixMd = substr($user['doctor'],0,5);
        $where = "`name` LIKE '$prefixMd%'";

    }elseif ( preg_match('/(\d+){4,5}/', $user['doctor'], $matchs) ) {
        $prefixMd = $matchs['0'];
        $where = "`doctorcode` = '$prefixMd'";
    }
    $sql = "SELECT CONCAT('ว.',`doctorcode`) AS `doctorcode` FROM `doctor` WHERE $where ";
    $db->select($sql);
    $dr = $db->get_item();
    $doctorcode = $dr['doctorcode'];

    $sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
    $db->select($sql);
    $dr = $db->get_item();
    
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
                    <td colspan="2"> 
                    <b>HN : </b><?=$user['hn'];?> <b>ชื่อ-สกุล : </b><?=$user['ptname'];?> <b>วันที่มารับบริการ : </b><?=$user['thidate'];?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">รหัสสถานบริการ : </td>
                    <td><input type="text" name="HOSPCODE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">ทะเบียนบุคคล : </td>
                    <td><input type="text" name="PID" value="<?=$user['hn'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">ครรภ์ที่ : </td>
                    <td><input type="text" name="GRAVIDA" id="">(ไม่ใส่ 0 นำหน้าเช่น 1,2,10)</td>
                </tr>
                <tr>
                    <td class="txtRight">วันแรกของการมีประจำเดือนครั้งสุดท้าย : </td>
                    <td><input type="text" name="LMP" id="LMP"></td>
                </tr>
                <tr>
                    <td class="txtRight">วันที่กำหนดคลอด : </td>
                    <td><input type="text" name="EDC" id="EDC"></td>
                </tr>
                <tr>
                    <td class="txtRight">ผลการตรวจ VDRL_RS : </td>
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
                    <td class="txtRight">ผลการตรวจ HB_RS : </td>
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
                    <td class="txtRight">ผลการตรวจ HIV_RS : </td>
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
                    <td class="txtRight">วันที่ตรวจ HCT : </td>
                    <td><input type="text" name="DATE_HCT" id="DATE_HCT"></td>
                </tr>
                <tr>
                    <td class="txtRight">ผลการตรวจ HCT : </td>
                    <td><input type="text" name="HCT_RESULT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">ผลการตรวจ THALASSAEMIA : </td>
                    <td><input type="text" name="THALASSAEMIA" id=""></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">บันทึกข้อมูล</button>
                        <input type="hidden" name="CID" value="<?=$user['idcard'];?>">
                        <input type="hidden" name="PROVIDER" value="<?=$dr['PROVIDER'];?>">
                        <input type="hidden" name="action" value="save">
                        <input type="hidden" name="D_UPDATE" value="<?=date('YmdHis');?>">
                        <input type="hidden" name="opday_id" value="<?=$user['row_id'];?>">
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