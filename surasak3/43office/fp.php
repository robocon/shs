<?php 
include '../bootstrap.php';
include 'libs/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $CID = input_post('CID');
    $SEQ = input_post('SEQ');
    $DATE_SERV = input_post('DATE_SERV');
    $FPTYPE = input_post('FPTYPE');
    $PROVIDER = input_post('PROVIDER');
    $D_UPDATE = input_post('D_UPDATE');
    $opday_id = input_post('opday_id');
    $FPPLACE = input_post('FPPLACE');

    $DATE_SERV = bc_to_ad($DATE_SERV);
    $DATE_SERV = str_replace('-','', $DATE_SERV);

    $sql = "INSERT INTO `43fp` ( 
        `id`, `HOSPCODE`, `PID`, `SEQ`, `DATE_SERV`, `FPTYPE`, 
        `FPPLACE`, `PROVIDER`, `D_UPDATE`, `CID`, `opday_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$SEQ', '$DATE_SERV', '$FPTYPE', 
        '$FPPLACE', '$PROVIDER', '$D_UPDATE', '$CID', '$opday_id');";
    $save = $db->insert($sql);

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    redirect('fp.php',$msg);
    exit;
}

include 'head.php';

?>
<div class="clearfix">
    <h1 style="margin:0;">FP</h1> <span>บริการวางแผนครอบครัว</span>
</div>

<fieldset>
    <legend>แฟ้ม : FP</legend>
    <form action="fp.php" method="post">
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
if ($page === 'search') {
    
    $hn = input_post('hn');
    $gettime = strtotime("-2 YEARS");
    $lastdate = (date('Y', $gettime)+543).date('-m-d', $gettime);

    $sql = "SELECT * FROM `opday` WHERE `thidate` >= '$lastdate' AND `hn` = '$hn' ORDER BY `row_id` DESC LIMIT 100";
    $db->select($sql);
    $itemPop = $items = $db->get_items();

    $user = array_pop($itemPop);
    ?>
    <div>HN : <?=$user['hn'];?> ชื่อ-สกุล : <?=$user['ptname'];?></div>
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
        ?>
        <tr>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['doctor'];?></td>
            <td><?=$item['toborow'];?></td>
            <td><a href="fp.php?page=form&opday_id=<?=$item['row_id'];?>">บันทึก</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    
    <?php
}elseif ($page === 'form') {

    $opday_id = input_get('opday_id');
    $sql = "SELECT `row_id`,`hn`,`ptname`,`thidate`,`idcard`,`doctor`,SUBSTRING(`thidate`,1,10) AS `shortdate`,`vn`,`clinic` FROM `opday` WHERE `row_id` = '$opday_id' LIMIT 1";
    $db->select($sql);
    $user = $db->get_item();

    $date_bc = bc_to_ad($user['thidate']);
    $seq = genSEQ($date_bc, $user['vn'], $user['clinic']);

    if( preg_match('/MD\d+/', $user['doctor']) > 0 ){
        $prefixMd = substr($user['doctor'],0,5);
        $where = "`name` LIKE '$prefixMd%'";

    }elseif ( preg_match('/(\d+){4,5}/', $user['doctor'], $matchs) ) {
        $prefixMd = $matchs['0'];
        $where = "`doctorcode` = '$prefixMd'";
    }

    $sql = "SELECT `doctorcode` AS `doctorcode` FROM `doctor` WHERE $where ";
    $db->select($sql);
    $dr = $db->get_item();
    $doctorcode = $dr['doctorcode'];

    $sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
    $db->select($sql);
    $dr = $db->get_item();

    $fp_id = input_get('fp_id');
    if(!empty($fp_id))
    {
        $db->select("SELECT * FROM `43fp` WHERE `id` = '$fp_id' ");
        $fp = $db->get_item();
        $FPTYPE = $fp['FPTYPE'];
    }else{
        $FPTYPE = ''; 
    }

    ?>
    <fieldset>
        <legend>ฟอร์มบันทึก FP</legend>
        <form action="fp.php" method="post">
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
                    <td class="txtRight">เลขที่บัตรประชาชน : </td>
                    <td><input type="text" name="CID" value="<?=$user['idcard'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">ลำดับที่ : </td>
                    <td><input type="text" name="SEQ" value="<?=$seq;?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">วันที่ให้บริการ : </td>
                    <td><input type="text" name="DATE_SERV" value="<?=$user['shortdate'];?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">รหัสวิธีการคุมกำเนิด : </td>
                    <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_fp_172`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) { 

                        $checked = ($FPTYPE == $item['code']) ? 'checked="checked"' : '' ;

                        ?>
                        <input type="radio" name="FPTYPE" id="fptype<?=$i;?>" value="<?=$item['code'];?>" <?=$checked;?> ><label for="fptype<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">สถานที่รับบริการ : </td>
                    <td><input type="text" name="FPPLACE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">เลขที่ผู้ให้บริการ : </td>
                    <td>
                        <?php 
                        if( empty($dr['PROVIDER']) ){ 
                            $db->select("SELECT `PROVIDER`,`REGISTERNO`,`NAME`,`LNAME` FROM `tb_provider_9` ORDER BY `ROW_ID` ");
                            $providerLists = $db->get_items();
                            ?>
                            <select name="PROVIDER" id="">
                                <option value="">กรุณาเลือกผู้ให้บริการ</option>
                                <?php 
                                foreach ($providerLists as $key => $pv) {
                                    
                                    $dr_no = '';
                                    if( $pv['REGISTERNO'] ){
                                        $dr_no = '('.$pv['REGISTERNO'].')';
                                    }
                                
                                ?>
                                <option value="<?=$pv['PROVIDER'];?>"><?=$pv['NAME'].' '.$pv['LNAME'].$dr_no;?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="PROVIDER" value="<?=$dr['PROVIDER'];?>" readonly>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">บันทึกข้อมูล</button>
                        <input type="hidden" name="action" value="save">
                        <input type="hidden" name="D_UPDATE" value="<?=date('YmdHis');?>">
                        <input type="hidden" name="opday_id" value="<?=$user['row_id'];?>">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <?php

}