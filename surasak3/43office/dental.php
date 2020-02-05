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
    $DENTTYPE = input_post('DENTTYPE');

    $SERVPLACE = input_post('SERVPLACE');
    $PTEETH = input_post('PTEETH');
    $PCARIES = input_post('PCARIES');
    $PFILLING = input_post('PFILLING');
    $PEXTRACT = input_post('PEXTRACT');
    $DTEETH = input_post('DTEETH');

    $DCARIES = input_post('DCARIES');
    $DFILLING = input_post('DFILLING');
    $DEXTRACT = input_post('DEXTRACT');
    $NEED_FLUORIDE = input_post('NEED_FLUORIDE');
    $NEED_SCALING = input_post('NEED_SCALING');
    $NEED_SEALANT = input_post('NEED_SEALANT');

    $NEED_PFILLING = input_post('NEED_PFILLING');
    $NEED_DFILLING = input_post('NEED_DFILLING');
    $NEED_PEXTRACT = input_post('NEED_PEXTRACT');
    $NEED_DEXTRACT = input_post('NEED_DEXTRACT');
    $NPROSTHESIS = input_post('NPROSTHESIS');
    $PERMANENT_PERMANENT = input_post('PERMANENT_PERMANENT');

    $D_UPDATE = input_post('D_UPDATE');
    $CID = input_post('CID');
    $opday_id = input_post('opday_id');

    $sql = "INSERT INTO `43dental` ( 
        `id`, `HOSPCODE`, `PID`, `SEQ`, `DATE_SERV`, `DENTTYPE`, 
        `SERVPLACE`, `PTEETH`, `PCARIES`, `PFILLING`, `PEXTRACT`, `DTEETH`, 
        `DCARIES`, `DFILLING`, `DEXTRACT`, `NEED_FLUORIDE`, `NEED_SCALING`, `NEED_SEALANT`, 
        `NEED_PFILLING`, `NEED_DFILLING`, `NEED_PEXTRACT`, `NEED_DEXTRACT`, `NPROSTHESIS`, `PERMANENT_PERMANENT`, 
        `PERMANENT_PROSTHESIS`, `PROSTHESIS_PROSTHESIS`, `GUM`, `SCHOOLTYPE`, `CLASS`, `PROVIDER`, 
        `D_UPDATE`, `CID`, `opday_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$SEQ', '$DATE_SERV', '$DENTTYPE', 
        '$SERVPLACE', '$PTEETH', '$PCARIES', '$PFILLING', '$PEXTRACT', '$DTEETH', 
        '$DCARIES', '$DFILLING', '$DEXTRACT', '$NEED_FLUORIDE', '$NEED_SCALING', '$NEED_SEALANT', 
        '$NEED_PFILLING', '$NEED_DFILLING', '$NEED_PEXTRACT', '$NEED_DEXTRACT', '$NPROSTHESIS', '$PERMANENT_PERMANENT', 
        '$PERMANENT_PROSTHESIS', '$PROSTHESIS_PROSTHESIS', '$GUM', '$SCHOOLTYPE', '$CLASS', '$PROVIDER', 
        '$D_UPDATE', '$CID', '$opday_id' 
    );";
    $save = $db->insert($sql);
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    redirect('dental.php',$msg);
    exit;
}

include 'head.php';

?>
<div class="clearfix">
    <h1 style="margin:0;">DENTAL</h1> <span>ข้อมูลการตรวจสภาวะทันตสุขภาพของฟันทุกซี่</span>
</div>

<fieldset>
    <legend>แฟ้ม : DENTAL</legend>
    <form action="dental.php" method="post">
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
            <td><a href="dental.php?page=form&id=<?=$item['row_id'];?>">บันทึก</a></td>
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
        <form action="dental.php" method="post">
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
                    <td class="txtRight">ประเภทผู้ได้รับบริการ : </td>
                    <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_158`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) { 
                        ?>
                        <input type="radio" name="DENTTYPE" id="dentype<?=$i;?>" value="<?=$item['code'];?>"><label for="dentype<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">บริการใน-นอกสถานที่ : </td>
                    <td> 
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_154_ncd_165_pp_204`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) {
                        ?>
                        <input type="radio" name="SERVPLACE" id="servplace<?=$i;?>" value="<?=$item['code'];?>"><label for="servplace<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันแท้ที่มีอยู่ (ซี่) : </td>
                    <td><input type="text" name="PTEETH" id=""> </td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันแท้ผุที่ไม่ได้อุด (ซี่) : </td>
                    <td><input type="text" name="PCARIES" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันแท้ที่ได้รับการอุด (ซี่) : </td>
                    <td><input type="text" name="PFILLING" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันแท้ที่ถอนหรือหลุด (ซี่) : </td>
                    <td><input type="text" name="PEXTRACT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันน้านมที่มีอยู่ (ซี่) : </td>
                    <td><input type="text" name="DTEETH" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันน้านมผุที่ไม่ได้อุด (ซี่) : </td>
                    <td><input type="text" name="DCARIES" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันน้านมที่ได้รับการอุด (ซี่) : </td>
                    <td><input type="text" name="DFILLING" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันน้านมที่ถอนหรือหลุด (ซี่) : </td>
                    <td><input type="text" name="DEXTRACT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำเป็นต้องทา/เคลือบฟลูออไรด์ : </td>
                    <td> 
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_155`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) {
                        ?>
                        <input type="radio" name="NEED_FLUORIDE" id="nfluoride<?=$i;?>" value="<?=$item['code'];?>"><label for="nfluoride<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">จำเป็นต้องขูดหินน้าลาย : </td>
                    <td> 
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_156`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) {
                        ?>
                        <input type="radio" name="NEED_SCALING" id="nscaling<?=$i;?>" value="<?=$item['code'];?>"><label for="nscaling<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันที่ต้องเคลือบหลุมร่องฟัน : </td>
                    <td><input type="text" name="NEED_SEALANT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันแท้ที่ต้องอุด : </td>
                    <td><input type="text" name="NEED_PFILLING" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันน้านมที่ต้องอุด : </td>
                    <td><input type="text" name="NEED_DFILLING" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันแท้ที่ต้องถอน/รักษาคลองรากฟัน : </td>
                    <td><input type="text" name="NEED_PEXTRACT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนฟันน้านมที่ต้องถอน/รักษาคลองรากฟัน : </td>
                    <td><input type="text" name="NEED_DEXTRACT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำเป็นต้องใส่ฟันเทียม : </td>
                    <td> 
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_159`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) {
                        ?>
                        <input type="radio" name="NPROSTHESIS" id="npro<?=$i;?>" value="<?=$item['code'];?>"><label for="npro<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนคู่สบฟันแท้กับฟันแท้ : </td>
                    <td><input type="text" name="PERMANENT_PERMANENT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนคู่สบฟันแท้กับฟันเทียม : </td>
                    <td><input type="text" name="PERMANENT_PROSTHESIS" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนคู่สบฟันเทียมกับฟันเทียม : </td>
                    <td><input type="text" name="PROSTHESIS_PROSTHESIS" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">สภาวะปริทันต์ : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_dental_160`");
                        $ppLists = $db->get_items();
                        ?>
                        <select name="GUM" id="">
                            <option value="">เลือกข้อมูลสภาวะปริทันต์</option>
                            <?php 
                                foreach ($ppLists as $key => $value) {
                                    ?><option value="<?=$value['code'];?>"><?=$value['detail'];?></option><?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">สถานศึกษา : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_dental_157`");
                        $ppLists = $db->get_items();
                        ?>
                        <select name="SCHOOLTYPE" id="">
                            <option value="">เลือกข้อมูลสถานศึกษา</option>
                            <?php 
                                foreach ($ppLists as $key => $value) {
                                    ?><option value="<?=$value['code'];?>"><?=$value['detail'];?></option><?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">ระดับการศึกษา : </td>
                    <td>
                    <?php 
                    $classList = array(1,2,3,4,5,6);
                    $i = 1;
                    foreach ($classList as $key => $item) {
                        ?>
                        <input type="radio" name="CLASS" id="class<?=$i;?>" value="<?=$item;?>"><label for="class<?=$i;?>"><?=$item;?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
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
    <script type="text/javascript">
        var popup1;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('DATE_SERV'),false);
        };
    </script>
    <?php
}