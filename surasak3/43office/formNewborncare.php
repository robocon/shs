<?php 

include '../bootstrap.php';
include 'head.php';

function genSEQ($date, $hn){

    $s1 = date('Ymd', strtotime($date));
    list($prefix, $number) = explode('-', $hn);
    $newHn = $prefix.( sprintf('%05d', intval($nubmer)) );

    return $s1.$newHn;
}

$action = input_post('action');
if( $action === 'save' ){

    exit;
}
?>

<fieldset>
    <legend>ค้นหาข้อมูลตาม HN</legend>
    <form action="formNewborncare.php" method="post">
        <div>
        HN : <input type="text" name="hn" id="hn">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="searchHn">
        </div>
    </form>
</fieldset>

<?php 
$page = input('page');
if ($page === 'searchHn') {

    $db = Mysql::load();
    $hn = input_post('hn');
    $sql = "SELECT `row_id`,`hn`,`ptname`,`thidate`,`diag`,`doctor` FROM `opday` WHERE `hn` = '$hn' ORDER BY `thidate` DESC";
    $db->select($sql);
    $itemPop = $items = $db->get_items();

    $user = array_pop($itemPop);
    ?>
    <div>
        <fieldset>
            <legend>ข้อมูลเบื้องต้นวันที่มารับบริการ</legend>
            <table>
                <tr>
                    <td><b>HN : </b><?=$user['hn'];?> <b>ชื่อ-สกุล : </b><?=$user['ptname'];?></td>
                </tr>
            </table>
        </fieldset>
    </div>
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
            <td>
                <a href="formNewborncare.php?opdId=<?=$item['row_id'];?>&page=form">ลงข้อมูล</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}elseif ( $page==='form' ) {

    $db = Mysql::load();
    $id = input_get('opdId');
    $sql = "SELECT `hn`,`vn`,`ptname`,`thidate`,`doctor`,`idcard` FROM `opday` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    $hn = $item['hn'];
    $idcard = $item['idcard'];

    $db->select("SELECT `dbirth` FROM `opcard` WHERE `hn` = '$hn' ");
    $opcard = $db->get_item();
    $bdate = bc_to_ad($opcard['dbirth']);
    $bdate = str_replace('-','', $bdate);

    $seq = genSEQ(date('Ymd'),$hn);

    
    $prefixMd = substr($item['doctor'],0,5);
    $sql = "SELECT b.`PROVIDER` 
    FROM ( 
        SELECT CONCAT('ว.',`doctorcode`) AS `doctorcode` FROM `doctor` WHERE `name` LIKE '$prefixMd%'
    ) AS a 
    LEFT JOIN `tb_provider_9` AS b ON b.`REGISTERNO` = a.`doctorcode` ";
    $db->select($sql);
    $dr = $db->get_item();

    ?>
    <fieldset>
        <legend>บันทึกข้อมูลการดูแลทารกหลังคลอด</legend>
        <form action="formNewborncare.php" method="post">
            <table>
                <tr>
                    <td class="tdRow">
                        <b>HN : </b><?=$item['hn'];?> <b>ชื่อ-สกุล : </b><?=$item['ptname'];?> <b>วันที่มารับบริการ : </b><?=$item['thidate'];?>
                    </td>
                </tr>
                <tr>
                    <td class="tdRow">
                        เลขบัตรประชาชน <input type="text" name="idcard" class="important" value="<?=$idcard;?>">
                    </td>
                </tr>
                <tr>
                    <td class="tdRow">
                        <span class="sRow">ผลการตรวจทารกหลังคลอด <select name="bcareresult" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborncare_196`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="tdRow">
                        <span class="sRow">อาหารที่รับประทาน <select name="food" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborncare_197`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit">บันทึก</button>
                        <input type="hidden" name="PID" value="<?=$hn;?>">
                        <input type="hidden" name="SEQ" value="<?=$seq;?>">
                        <input type="hidden" name="BDATE" value="bdate">
                        <input type="hidden" name="BCARE" value="<?=date('Ymd');?>">
                        <input type="hidden" name="BCPlACE" value="11512">
                        <input type="hidden" name="PROVIDER" value="<?=$dr['PROVIDER'];?>">
                        <input type="hidden" name="D_UPDATE" value="<?=date('YmdHis');?>">
                        <input type="hidden" name="CID" value="<?=$idcard;?>">

                        <input type="hidden" name="action" value="save">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <?php

}

include 'footer.php';
?>