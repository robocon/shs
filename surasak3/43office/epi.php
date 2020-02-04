<?php 
include '../bootstrap.php';
include 'libs/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $SEQ = input_post('SEQ');
    $DATE_SERV = input_post('DATE_SERV');
    $DATE_SERV = bc_to_ad($DATE_SERV);
    $DATE_SERV = str_replace('-','', $DATE_SERV);
    $VACCINETYPE = input_post('VACCINETYPE');
    $VACCINEPLACE = input_post('VACCINEPLACE');
    $PROVIDER = input_post('PROVIDER');
    $D_UPDATE = input_post('D_UPDATE');
    $CID = input_post('CID');
    $opday_id = input_post('opday_id');

    $sql = "INSERT INTO `43epi` ( 
        `id`, `HOSPCODE`, `PID`, `SEQ`, `DATE_SERV`, `VACCINETYPE`, 
        `VACCINEPLACE`, `PROVIDER`, `D_UPDATE`, `CID`, `opday_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$SEQ', '$DATE_SERV', '$VACCINETYPE', 
        '$VACCINEPLACE', '$PROVIDER', '$D_UPDATE', '$CID', '$opday_id' 
    );";
    $save = $db->insert($sql);
    
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    redirect('epi.php',$msg);
    exit;
}

include 'head.php';

?>
<div class="clearfix">
    <h1 style="margin:0;">EPI</h1> <span>บริการวัคซีนผู้ที่มารับบริการ</span>
</div>

<fieldset>
    <legend>แฟ้ม : EPI</legend>
    <form action="epi.php" method="post">
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

    $sql = "SELECT * FROM `opday` WHERE `hn` = '$hn' ORDER BY `row_id` DESC";
    $db->select($sql);
    $itemPop = $items = $db->get_items();
    $user = array_pop($itemPop);
    ?>
    <div>&nbsp;</div>
    <div><b>HN : </b><?=$user['hn'];?> <b>ชื่อ-สกุล : </b><?=$user['ptname'];?></div>
    <table class="chk_table">
        <tr>
            <th>วันที่มารับบริการ</th>
            <th>Diag</th>
            <th>แพทย์</th>
            <th>มาเพื่อ</th>
        </tr>
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['doctor'];?></td>
            <td><a href="epi.php?page=form&id=<?=$item['row_id'];?>">บันทึก</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    
    <?php
}elseif ($page === 'form') {

    $row_id = input_get('id');
    $sql = "SELECT `row_id`,`hn`,`ptname`,`thidate`,`idcard`,`doctor`,SUBSTRING(`thidate`,1,10) AS `shortdate` FROM `opday` WHERE `row_id` = '$row_id' LIMIT 1";
    $db->select($sql);
    $user = $db->get_item();

    $date_bc = bc_to_ad($user['thidate']);
    $seq = genSEQ($date_bc, $user['hn']);

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
    <fieldset>
        <legend>ฟอร์มบันทึก FP</legend>
        <form action="epi.php" method="post">
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
                    <td><input type="text" name="DATE_SERV" id="DATE_SERV" value="<?=$user['shortdate'];?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">รหัสวัคซีน : </td>
                    <td>
                        <input type="text" name="VACCINETYPE" id="VACCINETYPE"><span id="epi198" style="position: relative;"></div>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">สถานที่รับวัคซีน : </td>
                    <td><input type="text" name="VACCINEPLACE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">เลขที่ผู้ให้บริการ : </td>
                    <td>
                        <?php 
                        if( empty($user['doctor']) ){ 
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
    include 'assets/ajax.php';
    ?>
    <script type="text/javascript">
        var popup1;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('DATE_SERV'),false);
        };

        var btnVACCINETYPE = document.getElementById("VACCINETYPE");
        btnVACCINETYPE.addEventListener('keyup', function(event) {

            var newSm = new SmHttp();
            newSm.ajax(
                'epi198.php', 
                { 'word': btnVACCINETYPE.value }, 
                function(res){
                    document.getElementById('epi198').innerHTML = res;

                    /* https://clubmate.fi/detect-click-with-pure-javascript/ */
                    var el = document.getElementsByClassName('icd10');
                    for (var i=0; i < el.length; i++) {
                        // Here we have the same onclick
                        el.item(i).onclick = function(){

                            document.getElementById('VACCINETYPE').value = this.getAttribute('data');
                            document.getElementById('epi198').innerHTML = '';
                        };
                    }

                    // ปุ่มปิด
                    var btnClose = document.getElementById("btnLaborClose");
                    btnClose.addEventListener('click', function(event) { 
                        document.getElementById('epi198').innerHTML = '';
                    });

                }
            );
        });
    </script>
    <?php

}