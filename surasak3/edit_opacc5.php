<?php 
include 'bootstrap.php';

$configs = array('host' => '192.168.131.250', 'port' => '', 'dbname' => 'smdb', 'user' => 'remoteuser', 'pass' => '' );
$db = Mysql::load($configs);

$action = $_POST['action'];
$type = $_REQUEST['type'];

if($type === 'patdata' && $action === 'save'){

    $id = $_POST['id'];
    $date = $_POST['date'];
    $price = $_POST['price'];
    $yprice = $_POST['yprice'];
    $nprice = $_POST['nprice'];
    $code = $_POST['code'];
    $detail = $_POST['detail'];
    $part = $_POST['part'];
    $depart = $_POST['depart'];

    $sql = "UPDATE `patdata` SET 
    `date`='$date',`price`='$price', `yprice`='$yprice', `nprice`='$nprice', 
    `code`='$code', `detail`='$detail', `part`='$part', `depart`='$depart'
    WHERE `row_id`='$id';";
    $save = $db->exec($sql);
    if($save === true){
        echo "บันทึกข้อมูลเรียบร้อย";
    }else{
        echo $save['error'];
    }

}elseif ($type === 'depart' && $action === 'save') {
    
    $id = $_POST['id'];
    $date = $_POST['date'];
    $price = $_POST['price'];
    $sumyprice = $_POST['sumyprice'];
    $sumnprice = $_POST['sumnprice'];
    $paid = $_POST['paid'];
    $depart = $_POST['depart'];
    $detail = $_POST['detail'];
    $cashok = $_POST['cashok'];
    $sql = "UPDATE `depart` SET 
    `date`='$date',`price`='$price', `sumyprice`='$sumyprice', `sumnprice`='$sumnprice', 
    `paid`='$paid', `depart`='$depart', `detail`='$detail', `cashok`='$cashok' 
    WHERE `row_id`='$id';";
    $save = $db->exec($sql);
    if($save === true){
        echo "บันทึกข้อมูลเรียบร้อย";
    }else{
        echo $save['error'];
    }

}elseif ($type === 'opacc' && $action === 'save') {
    
    $id = $_POST['id'];
    $date = $_POST['date'];
    $price = $_POST['price'];
    $paid = $_POST['paid'];
    $paidcscd = $_POST['paidcscd'];
    $depart = $_POST['depart'];
    $detail = $_POST['detail'];
    $credit = $_POST['credit'];
    $credit_detail = $_POST['credit_detail'];
    
    $sql = "UPDATE `opacc` SET 
    `date`='$date',`price`='$price', `paid`='$paid', `paidcscd`='$paidcscd' , 
    `depart`='$depart', `detail`='$detail', `credit`='$credit', `credit_detail`='$credit_detail' 
    WHERE `row_id`='$id';";
    $save = $db->exec($sql);
    if($save === true){
        echo "บันทึกข้อมูลเรียบร้อย";
    }else{
        echo $save['error'];
    }

}





if ($type === 'patdata') {

    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM `patdata` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    ?>
    <form action="edit_opacc5.php" method="post">
        <div>
            PATDATA ==> <b><?=$item['hn'];?></b> <b><?=$item['ptname'];?></b> <b>id</b> <?=$item['row_id'];?> <b>code</b> <?=$item['code'];?> <b>detail</b> <?=$item['detail'];?>
        </div>
        <div>
            date <input type="text" name="date" id="date" value="<?=$item['date'];?>">
        </div>
        <div>
            code <input type="text" name="code" id="code" value="<?=$item['code'];?>">
        </div>
        <div>
            detail <input type="text" name="detail" id="detail" value="<?=$item['detail'];?>">
        </div>
        <div>
            depart <input type="text" name="depart" id="depart" value="<?=$item['depart'];?>">
        </div>
        <div>
            part <input type="text" name="part" id="part" value="<?=$item['part'];?>">
        </div>
        <div>
            price <input type="text" name="price" id="price" value="<?=$item['price'];?>">
        </div>
        <div>
            yprice <input type="text" name="yprice" id="yprice" value="<?=$item['yprice'];?>">
        </div>
        <div>
            nprice <input type="text" name="nprice" id="nprice" value="<?=$item['nprice'];?>">
        </div>
        <div>
            <button type="submit">save</button>
        </div>
        <input type="hidden" name="type" value="patdata">
        <input type="hidden" name="id" value="<?=$item['row_id'];?>">
        <input type="hidden" name="action" value="save">
    </form>
    <?php
}elseif ($type === 'depart') {

    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM `depart` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    ?>
    <form action="edit_opacc5.php" method="post">
        <div>
            DEPART ==> <b><?=$item['hn'];?></b> <b><?=$item['ptname'];?></b> <b>id</b> <?=$item['row_id'];?> <b>code</b> <?=$item['code'];?> <b>detail</b> <?=$item['detail'];?>
        </div>
        <div>
            date <input type="text" name="date" id="date" value="<?=$item['date'];?>">
        </div>
        <div>
            depart <input type="text" name="depart" id="depart" value="<?=$item['depart'];?>">
        </div>
        <div>
            detail <input type="text" name="detail" id="detail" value="<?=$item['detail'];?>">
        </div>
        <div>
            price <input type="text" name="price" id="price" value="<?=$item['price'];?>">
        </div>
        <div>
            sumyprice <input type="text" name="sumyprice" id="sumyprice" value="<?=$item['sumyprice'];?>">
        </div>
        <div>
            sumnprice <input type="text" name="sumnprice" id="sumnprice" value="<?=$item['sumnprice'];?>">
        </div>
        <div>
            paid <input type="text" name="paid" id="paid" value="<?=$item['paid'];?>">
        </div>
        <div>
        cashok <input type="text" name="cashok" id="cashok" value="<?=$item['cashok'];?>">
        </div>
        <div>
            <button type="submit">save</button>
        </div>
        <input type="hidden" name="type" value="depart">
        <input type="hidden" name="id" value="<?=$item['row_id'];?>">
        <input type="hidden" name="action" value="save">
    </form>
    <?php 

}elseif ($type === 'opacc') { 
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM `opacc` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    ?>
    <form action="edit_opacc5.php" method="post">
        <div>
            OPACC ==> <b><?=$item['hn'];?></b> <b>id</b> <?=$item['row_id'];?> <b>depart</b> <?=$item['depart'];?> <b>detail</b> <?=$item['detail'];?>
        </div>
        <div>
            date <input type="text" name="date" id="date" value="<?=$item['date'];?>">
        </div>
        <div>
            depart <input type="text" name="depart" id="depart" value="<?=$item['depart'];?>">
        </div>
        <div>
            detail <input type="text" name="detail" id="detail" value="<?=$item['detail'];?>">
        </div>
        <div>
            credit <input type="text" name="credit" id="credit" value="<?=$item['credit'];?>">
        </div>
        <div>
            credit_detail <input type="text" name="credit_detail" id="credit_detail" value="<?=$item['credit_detail'];?>">
        </div>
        <div>
            price <input type="text" name="price" id="price" value="<?=$item['price'];?>">
        </div>
        <div>
            paid <input type="text" name="paid" id="paid" value="<?=$item['paid'];?>">
        </div>
        <div>
            paidcscd <input type="text" name="paidcscd" id="paidcscd" value="<?=$item['paidcscd'];?>">
        </div>
        <div>
            <button type="submit">save</button>
        </div>
        <input type="hidden" name="type" value="opacc">
        <input type="hidden" name="id" value="<?=$item['row_id'];?>">
        <input type="hidden" name="action" value="save">
    </form>
    <?php
}