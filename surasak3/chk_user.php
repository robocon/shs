<?php

include 'bootstrap.php';

$page = input('page');
$db = Mysql::load();

$action = input_post('action');
if( $action === 'save' ){

    $id = input_post('id');
    $hn = input_post('hn');
    $idcard = input_post('idcard');
    $name = input_post('name');
    $surname = input_post('surname');
    $part = input_post('part');
    $course = input_post('course');
    $datechkup = input_post('datechkup');
    $agey = input_post('agey');

    $sql = "UPDATE `opcardchk` SET 
    `HN` = '$hn', 
    `idcard` = '$idcard', 
    `name` = '$name', 
    `surname` = '$surname', 
    `agey` = '$agey', 
    `part` = '$part', 
    `course` = '$course', 
    `datechkup` = '$datechkup' 
    WHERE `row` = '$id' ";
    $update = $db->update($sql);
    
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $update !== true ){
		$msg = errorMsg('save', $update['id']);
    }

    redirect('chk_user.php?page=form&id='.$id, $msg);
    exit;
}

if( $page === 'form' ){
    $id = input_get('id');

    if ( $id === false ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    $sql = "SELECT a.*,`HN` AS `hn`, b.`name` AS `company_name` 
    FROM `opcardchk` AS a 
    LEFT JOIN `chk_company_list` AS b ON b.`code` = a.`part` 
    WHERE a.`row` = '$id' ";
    $db->select($sql);
    $user = $db->get_item();

    $sql = "SELECT * FROM `chk_company_list`";
    $db->select($sql);
    $companys = $db->get_items();
    
    include 'chk_menu.php';
    ?>
    <h3>แก้ไขข้อมูลผู้ตรวจสุขภาพ - <?=$user['company_name'];?></h3>
    <?php
    if( isset($_SESSION['x-msg']) ){
        ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
        unset($_SESSION['x-msg']);
    }
    ?>
    <form action="chk_user.php" method="post">
        <div>
            HN : <input type="text" name="hn" id="" value="<?=$user['hn'];?>">
        </div>
        <div>
            ชื่อ : <input type="text" name="name" id="" value="<?=$user['name'];?>">
        </div>
        <div>
            สกุล : <input type="text" name="surname" id="" value="<?=$user['surname'];?>">
        </div>
        <div>
            บัตรประชาชน : <input type="text" name="idcard" id="" value="<?=$user['idcard'];?>">
        </div>
        <div>
            อายุ : <input type="text" name="agey" id="" value="<?=$user['agey'];?>">
        </div>
        <div>
            บริษัท : <select name="part" id="">
                <?php
                foreach ($companys as $key => $item) {
                    $selected = ( $item['code'] == $user['part'] ) ? 'selected="selected"' : '' ;
                    ?>
                    <option value="<?=$item['code'];?>" <?=$selected;?>><?=$item['name'];?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            โปรแกรมตรวจ : <input type="text" name="course" id="" value="<?=$user['course'];?>">
        </div>
        <div>
            วันที่ตรวจ : <input type="text" name="datechkup" id="" value="<?=$user['datechkup'];?>">
        </div>
        <div>
            <button type="submit">บันทึก</button> <a href="chk_show_user.php?part=<?=$user['part'];?>">กลับไปหน้ารายชื่อ</a>
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?=$user['row'];?>">
        </div>
    </form>
    <?php
}