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
    $NUTRITIONPLACE = input_post('NUTRITIONPLACE');
    $WEIGHT = input_post('WEIGHT');
    $HEIGHT = input_post('HEIGHT');
    $HEADCIRCUM = input_post('HEADCIRCUM');
    $CHILDDEVELOP = input_post('CHILDDEVELOP');
    $FOOD = input_post('FOOD');
    $BOTTLE = input_post('BOTTLE');
    $PROVIDER = input_post('PROVIDER');
    $D_UPDATE = input_post('D_UPDATE');
    $CID = input_post('CID');
    $opday_id = input_post('opday_id');

    $sql = "INSERT INTO `43nutrition` ( 
        `id`, `HOSPCODE`, `PID`, `SEQ`, `DATE_SERV`, `NUTRITIONPLACE`, 
        `WEIGHT`, `HEIGHT`, `HEADCIRCUM`, `CHILDDEVELOP`, `FOOD`, `BOTTLE`, 
        `PROVIDER`, `D_UPDATE`, `CID`, `opday_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$SEQ', '$DATE_SERV', '$NUTRITIONPLACE', 
        '$WEIGHT', '$HEIGHT', '$HEADCIRCUM', '$CHILDDEVELOP', '$FOOD', '$BOTTLE', 
        '$PROVIDER', '$D_UPDATE', '$CID', '$opday_id' 
    );";
    $save = $db->insert($sql);

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    redirect('nutrition.php',$msg);
    exit;
}

include 'head.php';

?>
<div class="clearfix">
    <h1 style="margin:0;">NUTRITION</h1> <span>ข้อมูลการวัดระดับโภชนาการ</span>
</div>

<fieldset>
    <legend>แฟ้ม : NUTRITION</legend>
    <form action="nutrition.php" method="post">
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
    <div><b>HN : </b><?=$user['ptname'];?></div>
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
            <td><a href="nutrition.php?page=form&id=<?=$item['row_id'];?>">บันทึก</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    
    <?php
}elseif ($page === 'form') { 

    $row_id = input_get('id');
    $sql = "SELECT `row_id`,`hn`,`ptname`,`thidate`,`idcard`,`doctor`,SUBSTRING(`thidate`,1,10) AS `shortdate`,`age`,`vn`,`clinic` FROM `opday` WHERE `row_id` = '$row_id' LIMIT 1";
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

    $sql = "SELECT `doctorcode` FROM `doctor` WHERE $where ";
    $db->select($sql);
    $dr = $db->get_item();
    $doctorcode = $dr['doctorcode'];

    $sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
    $db->select($sql);
    $dr = $db->get_item();

    ?>
    <style>
        table td{
            vertical-align: top;
        }
    </style>
    <fieldset>
        <legend>ฟอร์มบันทึก NUTRITION</legend>
        <form action="nutrition.php" method="post">
            <table>
                <tr>
                    <td colspan="2"> 
                    <b>HN : </b><?=$user['hn'];?> <b>ชื่อ-สกุล : </b><?=$user['ptname'];?> <b>วันที่มารับบริการ : </b><?=$user['thidate'];?> <b>อายุ : </b><?=$user['age'];?>
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
                    <td class="txtRight">สถานที่รับบริการ : </td>
                    <td><input type="text" name="NUTRITIONPLACE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">น้ำหนัก(กก.) : </td>
                    <td>
                        <input type="text" name="WEIGHT" id="">
                        <div style="font-weight: bold; font-size: 16px; color: #FF5722;">อนุญาตให้ใช้ทศนิยม 1ตำแหน่ง เช่น20.5</div>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">ส่วนสูง(ซม.) : </td>
                    <td><input type="text" name="HEIGHT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">เส้นรอบศรีษะ(ซม.) : </td>
                    <td><input type="text" name="HEADCIRCUM" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">ระดับพัฒนาการเด็ก : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_nutrition_201`");
                        $ppLists = $db->get_items();
                        $i = 1;
                        foreach ($ppLists as $key => $item) {
                            ?>
                            <input type="radio" name="CHILDDEVELOP" id="cdev<?=$i;?>" value="<?=$item['code'];?>"><label for="cdev<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                        <div style="font-weight: bold; font-size: 16px; color: #FF5722;">หมายเหตุบันทึกเฉพาะอายุเด็ก 0-5 ปี 11 เดือน 29 วัน</div>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">อาหารที่รับประทานปัจจุบัน : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_nutrition_202`");
                        $ppLists = $db->get_items();
                        $i = 1;
                        foreach ($ppLists as $key => $item) {
                            ?>
                            <input type="radio" name="FOOD" id="food<?=$i;?>" value="<?=$item['code'];?>"><label for="food<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">การใช้ขวดนม : </td>
                    <td>
                    
                        <?php 
                        $db->select("SELECT * FROM `f43_nutrition_203`");
                        $ppLists = $db->get_items();
                        $i = 1;
                        foreach ($ppLists as $key => $item) {
                            ?>
                            <input type="radio" name="BOTTLE" id="bottle<?=$i;?>" value="<?=$item['code'];?>"><label for="bottle<?=$i;?>"><?=$item['detail'];?></label>
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
                        if( empty($user['doctor']) OR empty($dr['PROVIDER']) ){ 
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