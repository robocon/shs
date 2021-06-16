<?php 
include '../bootstrap.php';
include 'libs/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $GRAVIDA = input_post('GRAVIDA');
    $LMP = input_post('LMP');
    $LMP = bc_to_ad($LMP);
    $LMP = str_replace('-','', $LMP);

    $EDC = input_post('EDC');
    $EDC = bc_to_ad($EDC);
    $EDC = str_replace('-','', $EDC);

    $VDRL_RESULT = input_post('VDRL_RESULT');
    $HB_RESULT = input_post('HB_RESULT');
    $HIV_RESULT = input_post('HIV_RESULT');

    $DATE_HCT = input_post('DATE_HCT');
    $DATE_HCT = bc_to_ad($DATE_HCT);
    $DATE_HCT = str_replace('-','', $DATE_HCT);

    $HCT_RESULT = input_post('HCT_RESULT');
    $THALASSAEMIA = input_post('THALASSAEMIA');
    $D_UPDATE = input_post('D_UPDATE');
    $PROVIDER = input_post('PROVIDER');
    $CID = input_post('CID');

    $opday_id = input_post('opday_id');
    $prenatal_id = input_post('prenatal_id');

    if( $prenatal_id != false ){ 

        $sql = "UPDATE `43prenatal` SET 
        `HOSPCODE`='$HOSPCODE', 
        `PID`='$PID', 
        `GRAVIDA`='$GRAVIDA', 
        `LMP`='$LMP', 
        `EDC`='$EDC', 
        `VDRL_RESULT`='$VDRL_RESULT', 
        `HB_RESULT`='$HB_RESULT', 
        `HIV_RESULT`='$HIV_RESULT', 
        `DATE_HCT`='$DATE_HCT', 
        `HCT_RESULT`='$HCT_RESULT', 
        `THALASSEMIA`='$THALASSAEMIA', 
        `D_UPDATE`='$D_UPDATE', 
        `PROVIDER`='$PROVIDER', 
        `CID`='$CID', 
        `opday_id`='$opday_id' 
        WHERE (`id`='$prenatal_id');";
        $save = $db->update($sql);

    }else{ 

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

    }
    

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    redirect('prenatal.php', $msg);
    exit;
}

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">PRENATAL</h1> <span>ข้อมูลประวัติการตั้งครรภ์ ของหญิงตั้งครรภ์</span>
</div>
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

    $sql = "SELECT a.`row_id`,a.`hn`, a.`ptname`,a.`diag`, a.`doctor`, a.`toborow`, a.`thidate`, b.`id` AS `prenatal_id` 
    FROM `opday` AS a 
    LEFT JOIN `43prenatal` AS b ON b.`opday_id` = a.`row_id` 
    WHERE a.`hn` = '$hn' 
    ORDER BY a.`thidate` 
    DESC LIMIT 100";
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
            <th>มาเพื่อ</th>
            <th>จัดการข้อมูล</th>
        </tr>
    <?php
    foreach ($items as $key => $item) { 

        $title = $color = '';
        if ( $item['prenatal_id'] ) { 
            $color = 'style="background-color: #abff90;"';
            $title = 'เคยบันทึกข้อมูลแล้ว';
        }
        
        ?>
        <tr <?=$color;?>>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['doctor'];?></td>
            <td><?=$item['toborow'];?></td>
            <td><a href="prenatal.php?page=form&id=<?=$item['row_id'];?>" title="<?=$title;?>">บันทึก</a></td>
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

    $thdatehn = $user['thdatehn'];

    if( preg_match('/MD\d+/', $user['doctor']) > 0 ){
        $prefixMd = substr($user['doctor'],0,5);
        $where = "`name` LIKE '$prefixMd%'";

    }elseif ( preg_match('/(\d+){4,5}/', $user['doctor'], $matchs) ) {
        $prefixMd = $matchs['0'];
        $where = "`doctorcode` = '$prefixMd'";
    }
    $sql = "SELECT `doctorcode` FROM `doctor` WHERE $where ";
    $db->select($sql);
    $dr = $db->get_item();
    $doctorcode = $dr['doctorcode'];

    $sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
    $db->select($sql);
    $dr = $db->get_item();




    // วันที่ประจำเดือนครั้งสุดท้ายจาก OPD
    $db->select("SELECT `mens`,`mens_date` FROM `opd` WHERE `thdatehn` = '$thdatehn' ");
    $mens = $db->get_item();
    $mensId = $mens['mens'];
    $mensList = array(1 => 'ยังไม่มีประจำเดือน','หมดประจำเดือน','ยังมีประจำเดือน');

    if( $mensList[$mensId] ){
        $lmpNoti = $mensList[$mensId];
    }

    $LMP = '';
    if( $mens['mens_date'] != '0000-00-00' ){
        $LMP = ad_to_bc($mens['mens_date']);
    }

    $db->select("SELECT * FROM `43prenatal` WHERE `opday_id` = '$row_id'");
    $prenatal = false;
    if( $db->get_rows() > 0 ){
        $prenatal = $db->get_item();
        
        $GRAVIDA = $prenatal['GRAVIDA'];
        $VDRL_RESULT = $prenatal['VDRL_RESULT'];
        $HB_RESULT = $prenatal['HB_RESULT'];
        $HIV_RESULT = $prenatal['HIV_RESULT'];
        $HCT_RESULT = $prenatal['HCT_RESULT'];
        $THALASSEMIA = $prenatal['THALASSEMIA'];
        $LMP = substr($prenatal['LMP'],0,4).'-'.substr($prenatal['LMP'],4,2).'-'.substr($prenatal['LMP'],6,2);
        $LMP = ad_to_bc($LMP);

        $DATE_HCT = substr($prenatal['DATE_HCT'],0,4).'-'.substr($prenatal['DATE_HCT'],4,2).'-'.substr($prenatal['DATE_HCT'],6,2);
        $DATE_HCT = ad_to_bc($DATE_HCT);

        $EDC = substr($prenatal['EDC'],0,4).'-'.substr($prenatal['EDC'],4,2).'-'.substr($prenatal['EDC'],6,2);
        $EDC = ad_to_bc($EDC);
        
    }
    
    
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
                    <td><input type="text" name="GRAVIDA" id="GRAVIDA" value="<?=$GRAVIDA;?>" >(ไม่ใส่ 0 นำหน้าเช่น 1,2,10)</td>
                </tr>
                <tr>
                    <td class="txtRight">วันแรกของการมีประจำเดือนครั้งสุดท้าย : </td>
                    <td><input type="text" name="LMP" id="LMP" value="<?=$LMP;?>" ><?=$lmpNoti;?> เช่น 2564-01-31</td>
                </tr>
                <tr>
                    <td class="txtRight">วันที่กำหนดคลอด : </td>
                    <td><input type="text" name="EDC" id="EDC" value="<?=$EDC;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">ผลการตรวจ VDRL_RS : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_prenatal_174`");
                        $vdrlLists = $db->get_items();
                        $i = 1;
                        foreach ($vdrlLists as $key => $item) { 

                            $checkedVDRL = ( $VDRL_RESULT == $item['code'] ) ? 'checked="checked"' : '' ;

                            ?>
                            <input type="radio" name="VDRL_RESULT" id="vdrl<?=$i;?>" value="<?=$item['code'];?>" <?=$checkedVDRL;?> ><label for="vdrl<?=$i;?>"><?=$item['detail'];?></label>
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

                            $checkedHB = ( $HB_RESULT == $item['code'] ) ? 'checked="checked"' : '' ;

                            ?>
                            <input type="radio" name="HB_RESULT" id="hb<?=$i;?>" value="<?=$item['code'];?>" <?=$checkedHB;?> ><label for="hb<?=$i;?>"><?=$item['detail'];?></label>
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

                            $checkedHIV = ( $HIV_RESULT == $item['code'] ) ? 'checked="checked"' : '' ;

                            ?>
                            <input type="radio" name="HIV_RESULT" id="hiv<?=$i;?>" value="<?=$item['code'];?>" <?=$checkedHIV;?> ><label for="hiv<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">วันที่ตรวจ HCT : </td>
                    <td><input type="text" name="DATE_HCT" id="DATE_HCT" value="<?=$DATE_HCT;?>">  เช่น 2564-01-31</td>
                </tr>
                <tr>
                    <td class="txtRight">ผลการตรวจ HCT : </td>
                    <td><input type="text" name="HCT_RESULT" id="HCT_RESULT" value="<?=$HCT_RESULT;?>" >(ระดับฮีมาโตคริค (%) ระบุเป็นตัวเลขไม่เกิน 2 หลัก)</td>
                </tr>
                <tr>
                    <td class="txtRight">ผลการตรวจ THALASSAEMIA : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_prenatal_176`");
                        $hctLists = $db->get_items();
                        $i = 1;
                        foreach ($hctLists as $key => $item) { 

                            $checkedTHA = ( $THALASSEMIA == $item['code'] ) ? 'checked="checked"' : '' ;

                            ?>
                            <input type="radio" name="THALASSAEMIA" id="hct<?=$i;?>" value="<?=$item['code'];?>"  <?=$checkedTHA;?> ><label for="hct<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">บันทึกข้อมูล</button>
                        <input type="hidden" name="CID" value="<?=$user['idcard'];?>">
                        <input type="hidden" name="PROVIDER" value="<?=$dr['PROVIDER'];?>">
                        <input type="hidden" name="action" value="save">
                        <input type="hidden" name="D_UPDATE" value="<?=date('YmdHis');?>">
                        <input type="hidden" name="opday_id" value="<?=$user['row_id'];?>">
                        <input type="hidden" name="prenatal_id" value="<?=$prenatal['id'];?>">
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