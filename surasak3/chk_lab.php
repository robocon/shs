<?php

include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

if ( $action === 'save' ) {

    $info = input_post('info');
    $number = input_post('number');
    $id = input_post('id');

    if ( empty($number) ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    $sql = "UPDATE `resulthead` SET 
    `clinicalinfo` = '$info' 
    WHERE `autonumber` = '$number' ";
    $update = $db->update($sql);

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $update !== true ){
		$msg = errorMsg('update', $update['id']);
    }

    redirect('chk_lab.php?page=form&id='.$id, $msg);
    exit;
} elseif ( $action == 'save_result' ){

    $autonumber = input_post('autonumber');
    $labcode = input_post('labcode');
    $id = input_post('id');

    $result = input_post('result');
    $normalrange = input_post('normalrange');

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    $sql = "UPDATE `resultdetail` SET 
    `result` = '$result', 
    `normalrange` = '$normalrange' 
    WHERE `autonumber` = '$autonumber' 
    AND `labcode` = '$labcode' ";
    $update = $db->update($sql);

    redirect('chk_lab.php?page=form&id='.$id, $msg);
    exit;
}

if ( $page === 'form' ) { 

    $id = input_get('id');
    
    if ( $id === false ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    $year_chk = get_year_checkup();

    $db->select("SELECT *,`HN` AS `hn` FROM `opcardchk` WHERE `row` = '$id' ");
    $user = $db->get_item();

    $sql = "SELECT * 
    FROM `resulthead` 
    WHERE `hn` = '".$user['hn']."'  
    AND `clinicalinfo` LIKE '%ตรวจสุขภาพประจำปี$year_chk'";
    $db->select($sql);
    $items = $db->get_items();

    $lab_rows = $db->get_rows();

    include 'chk_menu.php';

    ?>
    <p><a href="chk_show_user.php?part=<?=$user['part'];?>">&lt;&lt;&nbsp;กลับไปหน้ารายชื่อ</a></p>
    <?php

    if( $lab_rows === 0 ){
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }else {
        
        ?>
        <h3>แก้ไขข้อมูลแลป</h3>
        <p>HN : <?=$user['hn'];?></p>
        <p>ชื่อ-สกุล : <?=$user['name'];?> <?=$user['surname'];?></p>
        <table class="chk_table" width="100%">
            <tr>
                <th>autonumber</th>
                <th>รายการตรวจ</th>
                <th>keyword</th>
                <th>labcode/labname/result/normalrange</th>
                <th>ปรับสถานะLab</th>
            </tr>
            <?php
            foreach ($items as $key => $item) {
                $autonumber = $item['autonumber'];
            ?>
            <tr>
            <td><?=$autonumber;?></td>
                <td><?=$item['profilecode'];?></td>
                <td>
                    <div>
                        <?=$item['clinicalinfo'];?>
                    </div>
                </td>
                <td>
                    <?php
                    $detail_sql = "SELECT * FROM `resultdetail` WHERE `autonumber` = '$autonumber' ";
                    $db->select($detail_sql);
                    $detail_items = $db->get_items();
                    ?>
                    <table class="chk_table" width="100%">
                        <?php
                        foreach( $detail_items AS $key => $detail ){
                        ?>
                        <tr>
                            <td width="20%">
                                <a href="chk_lab.php?page=edit_result&autonumber=<?=$autonumber;?>&labcode=<?=$detail['labcode'];?>&id=<?=$id;?>"><?=$detail['labcode'];?></a>
                            </td>
                            <td width="20%"><?=$detail['labname'];?></td>
                            <td width="10%"><?=$detail['result'];?></td>
                            <td width="10%"><?=$detail['normalrange'];?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </td>
                <td><a href="chk_lab.php?page=editdetail&number=<?=$item['autonumber'];?>&id=<?=$id;?>">แก้ไขสถานะ</a></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <?php
    }
}elseif ( $page === 'editdetail' ) {

    $number = input_get('number');
    $id = input_get('id');

    if ( empty($number) ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    $sql = "SELECT * FROM `resulthead` WHERE `autonumber` = '$number' ";
    $db->select($sql);
    $item = $db->get_item();

    include 'chk_menu.php';
    ?>

    <form action="chk_lab.php" method="post">
        <div>
            Keyword : <input type="text" name="info" id="" value="<?=$item['clinicalinfo'];?>">
        </div>
        <div style="color: red;">
            คำแนะนำ : ให้เปลี่ยน keyword เช่น ตรวจสุขภาพประจำปี60 เป็น deleteตรวจสุขภาพประจำปี60
        </div>
        <div>
            <button type="submit">บันทึกข้อมูล</button>
            <input type="hidden" name="number" value="<?=$number;?>">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?=$id;?>">

            <a href="chk_lab.php?page=form&id=<?=$id;?>">&lt;&lt;&nbsp;กลับไปหน้าปรับผล</a>
        </div>
    </form>
    <?php
}elseif ( $page === 'edit_result' ) {

    $autonumber = input_get('autonumber');
    $labcode = input_get('labcode');
    $id = input_get('id');

    $sql = "SELECT `result`,`normalrange` 
    FROM `resultdetail` 
    WHERE `autonumber` = '$autonumber' 
    AND `labcode` = '$labcode' ";
    $db->select($sql);
    $item_result = $db->get_item();

    include 'chk_menu.php';
    ?>
    <div>
        <h3>แก้ไขผลแลป</h3>
        <p>เลขที่ Autonumber : <?=$autonumber;?></p>
        <p>Labcode : <?=$labcode;?></p>
    </div>
    <form action="chk_lab.php" method="post">
        <div>
            result: <input type="text" name="result" id="" value="<?=$item_result['result'];?>">
        </div>
        <div>
            normalrange: <input type="text" name="normalrange" id="" value="<?=$item_result['normalrange'];?>">
        </div>
        <div>
            <button type="submit">บันทึกข้อมูล</button>
            <input type="hidden" name="action" value="save_result">
            <input type="hidden" name="autonumber" value="<?=$autonumber;?>">
            <input type="hidden" name="labcode" value="<?=$labcode;?>">
            <input type="hidden" name="id" value="<?=$id;?>">
        </div>
        <div>
            <a href="javascript: window.history.back();">ย้อนกลับ</a>
        </div>
    </form>
    <?php

}