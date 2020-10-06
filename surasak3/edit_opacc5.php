<?php 
include 'bootstrap.php';

$configs = array('host' => '192.168.1.2', 'port' => '', 'dbname' => 'smdb', 'user' => 'remoteuser', 'pass' => '' );
$db = Mysql::load($configs);

$action = $_POST['action'];
$type = $_REQUEST['type'];

if($type === 'patdata' && $action === 'save'){

    $id = $_POST['id'];
    $price = $_POST['price'];
    $yprice = $_POST['yprice'];
    $nprice = $_POST['nprice'];

    $sql = "UPDATE `patdata` SET 
    `price`='$price', 
    `yprice`='$yprice', 
    `nprice`='$nprice' 
    WHERE (`row_id`='$id');";
    dump($sql);

}





if ($type === 'patdata') {

    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM `patdata` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    ?>
    <form action="edit_opacc5.php" method="post">
        <div>
            <b><?=$item['hn'];?></b> <b><?=$item['ptname'];?></b> <b>id</b> <?=$item['row_id'];?> <b>code</b> <?=$item['code'];?> <b>detail</b> <?=$item['detail'];?>
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
        <input type="hidden" name="id" value="<?=$id;?>">
        <input type="hidden" name="action" value="save">
    </form>
    <?php
}