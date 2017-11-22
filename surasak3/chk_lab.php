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
        echo "��辺������";
        exit;
    }

    $sql = "UPDATE `resulthead` SET 
    `clinicalinfo` = '$info' 
    WHERE `autonumber` = '$number' ";
    $update = $db->update($sql);

    $msg = '�ѹ�֡���������º����';
    if( $update !== true ){
		$msg = errorMsg('update', $update['id']);
    }

    redirect('chk_lab.php?page=form&id='.$id, $msg);
    exit;
}

if ( $page === 'form' ) { 

    $id = input_get('id');
    
    if ( $id === false ) {
        echo "��辺������";
        exit;
    }

    $year_chk = get_year_checkup();

    $db->select("SELECT *,`HN` AS `hn` FROM `opcardchk` WHERE `row` = '$id' ");
    $user = $db->get_item();

    $sql = "SELECT * 
    FROM `resulthead` 
    WHERE `hn` = '".$user['hn']."'  
    AND `clinicalinfo` LIKE '%��Ǩ�آ�Ҿ��Шӻ�$year_chk'";
    $db->select($sql);
    $items = $db->get_items();

    $lab_rows = $db->get_rows();

    include 'chk_menu.php';

    ?>
    <p><a href="chk_show_user.php?part=<?=$user['part'];?>">&lt;&lt;&nbsp;��Ѻ�˹����ª���</a></p>
    <?php

    if( $lab_rows === 0 ){
        ?>
        <p>��辺������</p>
        <?php
    }else {
        
        if( isset($_SESSION['x-msg']) ){
            ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
            unset($_SESSION['x-msg']);
        }
        ?>
        <h3>��䢢������Ż</h3>
        <p>HN : <?=$user['hn'];?></p>
        <p>����-ʡ�� : <?=$user['name'];?> <?=$user['surname'];?></p>
        <table class="chk_table">
            <tr>
                <th>autonumber</th>
                <th>��¡�õ�Ǩ</th>
                <th>keyword</th>
                <th>��</th>
                <th></th>
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
                    foreach( $detail_items AS $key => $detail ){
                        ?>
                        <div style="position: relative;"><?=$detail['labname'];?> : <span style="float: right;"><?=$detail['result'];?></span></div>
                        <?php
                    }
                    ?>
                </td>
                <td><a href="chk_lab.php?page=editdetail&number=<?=$item['autonumber'];?>&id=<?=$id;?>">���</a></td>
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
        echo "��辺������";
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
            ���й� : �������¹ keyword �� ��Ǩ�آ�Ҿ��Шӻ�60 �� delete��Ǩ�آ�Ҿ��Шӻ�60
        </div>
        <div>
            <button type="submit">�ѹ�֡������</button>
            <input type="hidden" name="number" value="<?=$number;?>">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?=$id;?>">

            <a href="chk_lab.php?page=form&id=<?=$id;?>">&lt;&lt;&nbsp;��Ѻ�˹�һ�Ѻ��</a>
        </div>
    </form>
    <?php
}