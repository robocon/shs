<?php
include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

if ( $action == 'save' ) {
    $id = input_post('id');
    $labcode = input_post('labcode');
    $detail = input_post('detail');
    $codex = input_post('codex');
    $depart = input_post('depart');
    $labpart = input_post('labpart');
    $price = input_post('price');
    $yprice = input_post('yprice');
    $nprice = input_post('nprice');
    $labtype = input_post('labtype');
    $status = input_post('status');
    $outlab_name = '';
    if( $labtype == 'OUT' ){
        $outlab_name = input_post('outlab_name');
    }
    $olddetail = "($codex) $detail";

    if( $id == false ){

        $sql = "INSERT INTO `labcare` (
            `row_id`, `numbered`, `depart`, `part`, `code`, `codebak`, 
            `codex`, `detail`, `olddetail`, `icd9cm`, `unit`, `price`, 
            `yprice`, `nprice`, `note`, `oldcode`, `lablis`, `codelab`, 
            `outlab_name`, `labpart`, `labtype`, `labstatus`, `chkup`, `reportlabno`, 
            `lab_list`, `lab_listdetail`, `report_m`
        ) VALUES (
            NULL, '', '$depart', '$depart', '$labcode', '$labcode', 
            '$codex', '$detail', '$olddetail', NULL, NULL, '$price', 
            '$yprice', '$nprice', NULL, NULL, NULL, '', 
            '$outlab_name', '$labpart', '$labtype', '$status', 'chk', '', 
            NULL, '', '');";
        $save = $db->insert($sql);

    }else{

        $sql = "UPDATE `labcare` SET 
        `depart`='$depart', 
        `part`='$depart', 
        `code`='$labcode', 
        `codebak`='$labcode', 
        `codex`='$codex', 
        `detail`='$detail', 
        `olddetail`='$olddetail', 
        `price`='$price', 
        `yprice`='$yprice', 
        `nprice`='$nprice', 
        `outlab_name`='$outlab_name', 
        `labpart`='$labpart', 
        `labtype`='$labtype', 
        `labstatus`='$status' 
        WHERE `row_id`='$id';";
        $save = $db->update($sql);

    }

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }

    redirect('chk_labcare.php', $msg);
    exit;
} elseif ( $action == 'check_drug' ) {
    
    
    $txt = input_post('word');
    $sql = "SELECT * FROM `labcare` WHERE code LIKE '$txt'";
    $db->select($sql);
    $rows = $db->get_rows();

    $find = 0;
    if( $rows > 0 ){
        $find = 1;
    }

    echo '{"find_rows": '.$find.'}';

    exit;
}

include 'chk_menu.php';

if ( empty($page) ) {
    
    $sql = "SELECT * FROM `labcare` WHERE `chkup` = 'chk' AND `lab_list` IS NULL ";
    $db->select($sql);

    $items = $db->get_items();
    ?>
    <div>
        <a href="chk_labcare.php?page=form">สร้างรหัสใหม่</a>
    </div>
    <div>
        <h3>ระบบจัดการรายการ Lab สำหรับการตรวจสุขภาพ</h3>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>รหัสLab</th>
                <th>รายละเอียด</th>
                <th>แผนก</th>
                <th>ราคา</th>
                <th>เบิกได้</th>
                <th>เบิกไม่ได้</th>
                <th>Part</th>
                <th>ประเภท</th>
                <th>สถานะ</th>
                <th></th>
            </tr>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['code'];?></td>
                    <td><?=('('.$item['codex'].') '.$item['detail']);?></td>
                    <td><?=$item['depart'];?></td>
                    <td align="right"><?=$item['price'];?></td>
                    <td align="right"><?=$item['yprice'];?></td>
                    <td align="right"><?=$item['nprice'];?></td>
                    <td align="right"><?=$item['labpart'];?></td>
                    <td>
                        <?php 
                        echo $item['labtype'];
                        if( $item['labtype'] == 'OUT' ){
                            echo ' ('.$item['outlab_name'].')';
                        }
                        ?>
                    </td>
                    <td><?=$item['labstatus'];?></td>
                    <td><a href="chk_labcare?page=form&id=<?=$item['row_id'];?>">แก้ไข</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
    </div>
    <?php
} elseif ( $page == 'form' ) {

    $part_list = array('Heamato','Chemistry','Micros','Micro','Serology','Outlab','Blood Bank');
    $outlab_list = array('รัฐบาล','อินเตอร์-แลป','ธนบุรี-แลป','เมดสตาร์-แลป');
    $depart_list = array('DENTA','OTHER','PATHO','XRAY');

    $labcode = $detail = $codex = $depart = $labpart = $price = $yprice = $nprice = $labtype = '';

    $id = input_get('id');
    if( $id !== false ){
        $sql = "SELECT * FROM `labcare` WHERE `row_id` = '$id'";
        $db->select($sql);

        $item = $db->get_item();
        
        $labcode = $item['code'];
        $detail = $item['detail'];
        $codex = $item['codex'];
        $depart = $item['depart'];
        $labpart = $item['labpart'];
        $price = $item['price'];
        $yprice = $item['yprice'];
        $nprice = $item['nprice'];
        $labtype = $item['labtype'];
        $outlab_name = $item['outlab_name'];
        $status = $item['labstatus'];
    }
    ?>
    <style type="text/css">
    #alert_code{
        color: red;
        text-decoration: underline;
    }
    </style>
    <div>
        <h3>ฟอร์มบันทึก</h3>
    </div>
    <div>
        <form action="chk_labcare.php" method="post">
            <div>
                รหัสLab: <input type="text" id="labcode" name="labcode" value="<?=$labcode;?>">
                <span id="alert_code" style="display: none;">รหัสซ้ำกับตัวอื่นกรุณาตรวจสอบอีกครั้ง</span>
            </div>
            <div>
                รายละเอียด: <input type="text" name="detail" value="<?=$detail;?>">
            </div>
            <div>
                รหัสกรมบัญชีกลาง: <input type="text" name="codex" value="<?=$codex;?>">
            </div>
            <div>
                แผนก: <select name="depart">
                    <?php
                    foreach ($depart_list as $key => $depart_item) {
                        $select = ( $depart_item == $depart ) ? 'selected="selected"' : '' ;
                        ?>
                        <option value="<?=$depart_item;?>" <?=$select;?>><?=$depart_item;?></option>
                        <?php
                    }
                    ?>
                </select> 
            </div>
            <div>
                Lab Part: <select name="labpart" id="">
                    <?php
                    foreach ($part_list as $key => $part_item) {
                        $select = ( $part_item == $labpart ) ? 'selected="selected"' : '' ;
                        ?>
                        <option value="<?=$part_item;?>" <?=$select;?>><?=$part_item;?></option>
                        <?php
                    }
                    ?>
                </select> 
            </div>
            <div>
                ราคาเต็ม: <input type="text" name="price" value="<?=$price;?>"> บาท
            </div>
            <div>
                เบิกได้: <input type="text" name="yprice" value="<?=$yprice;?>"> บาท
            </div>
            <div>
                เบิกไม่ได้: <input type="text" name="nprice" value="<?=$nprice;?>"> บาท
            </div>
            <div>
                <?php 
                $in_select = ( $labtype == 'IN' ) ? 'checked="checked"' : '' ;
                $out_select = ( $labtype == 'OUT' ) ? 'checked="checked"' : '' ;
                ?>
                ประเภทLab: 
                <label for="labin" class="test_labin"><input type="radio" name="labtype" id="labin" value="IN" <?=$in_select;?> > ในรพ.(IN)</label> 
                <label for="labout" class="test_labout"><input type="radio" name="labtype" id="labout" value="OUT" <?=$out_select;?>> นอกรพ.(OUT)</label>
                <?php
                $style = 'style="display: none;"';
                if ( $labtype == 'OUT' ) {
                    $style = '';
                }
                ?>
                <span <?=$style;?> id="outlab_list">
                    <select name="outlab_name">
                        <?php
                        foreach ($outlab_list as $key => $outlab_item) {
                            $select = ( $outlab_item == $outlab_name ) ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$outlab_item;?>" <?=$select;?>><?=$outlab_item;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </span>
            </div>
            <div>
                <?php
                $status_y = ( $status == 'Y' ) ? 'checked="checked"' : '' ;
                $status_n = ( $status == 'N' ) ? 'checked="checked"' : '' ;
                ?>
                สถานะ: <label for="s1"><input type="radio" name="status" id="s1" value="Y" <?=$status_y;?>> ใช้งาน(Y)</label>
                <label for="s2"><input type="radio" name="status" id="s2" value="N" <?=$status_n;?>> ไม่ใช้งาน(N)</label>
            </div>
            <div>
                <button type="submit">บันทึกข้อมูล</button>
                <input type="hidden" name="action" value="save">
                <?php
                if( $id !== false ){
                    ?>
                    <input type="hidden" name="id" value="<?=$item['row_id'];?>">
                    <?php
                }
                ?>
            </div>
        </form>
    </div>
    <div><a href="labcareedit1.php" target="_blank">รายการหัถการห้อง LAB</a></div>
    <script src="js/vendor/jquery-1.11.2.min.js"></script>
    <script>
        
        $(function(){

            $(document).on('click', '.test_labout', function(){
                $('#outlab_list').show();
            });

            $(document).on('click', '.test_labin', function(){
                $('#outlab_list').hide();
            });

            $(document).on('keyup', '#labcode', function(){
                var txt = $('#labcode').val();
                if(txt.length >= 2){
                    $.ajax({
                        method: "POST",
                        url: "chk_labcare.php",
                        data: { 'word': txt, 'action': 'check_drug'},
                        success: function(res){
                            
                            res = $.parseJSON(res);
                            if( res.find_rows > 0 ){
                                $('#alert_code').show();
                            }else{
                                $('#alert_code').hide();
                            }
                        }
                    });
                }
                
            });

        });

    </script>
    <?php
}