<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_POST['action']);
if($action==='save'){

    $name = sprintf("%s", $_POST['name']);
    $editor = sprintf("%s", $_SESSION['sIdname']);

    $sql = "INSERT INTO `indicator_main` (`id`, `name`, `status`, `date_create`, `date_edit`, `creater`, `editor`) VALUES (
        NULL, '$name', 'y', NOW(), NOW(), '$editor', '$editor'
    );";
    $q = $dbi->query($sql);
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if($q===false){
        $msg = 'บันทึกข้อมูลไม่สำเร็จ '.$dbi->error;
    }
    
    redirect('ha_main.php', $msg);
    exit;

}elseif ($action==='edit') {
    
    $id = sprintf("%s", $_POST['id']);
    $name = sprintf("%s", $_POST['name']);
    $editor = sprintf("%s", $_SESSION['sIdname']);
    
    $sql = "UPDATE `indicator_main` SET `name`='$name', `date_edit`=NOW(), `editor`='$editor' WHERE (`id`='$id');";
    $q = $dbi->query($sql);
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if($q===false){
        $msg = 'บันทึกข้อมูลไม่สำเร็จ '.$dbi->error;
    }
    
    redirect('ha_main.php', $msg);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
</head>
<body>
    <?php 
    if($_SESSION['x-msg']){
        ?>
        <div><?=$_SESSION['x-msg'];?></div>
        <?php
        $_SESSION['x-msg'] = null;
    }

    $id = sprintf("%s", $_GET['id']);
    $page = sprintf("%s", $_GET['page']);

    $action = 'save';
    if($page==='edit'){
        $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `id` = '$id' LIMIT 1");
        if($q->num_rows > 0){
            $item = $q->fetch_assoc();
            $action = 'edit';
        }
    }
    
    include_once 'ha_menu.php';
    ?>

    <form action="ha_main.php" method="post">
        <div>
            <label for="name">ชื่อฟอร์มบันทึก</label>
            <input type="text" name="name" id="name" value="<?=$item['name'];?>">
        </div>
        <div>
            <button type="submit">บันทึก</button>
            <input type="hidden" name="action" value="<?=$action;?>">
            <input type="hidden" name="id" value="<?=$item['id'];?>">
        </div>
    </form>

    <?php 
    $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `date_create` LIKE '2023-05%' ");
    if($q->num_rows>0){ 
        ?>
        <table>
            <tr>
                <th>#</th>
                <th>วันที่สร้าง</th>
                <th>ชื่อ</th>
                <th>สถานะ</th>
                <th>สร้างโดย</th>
                <th>จำนวนฟิลด์</th>
                <th></th>
                <th></th>
            </tr>
        <?php
        $i = 1;
        while ($a = $q->fetch_assoc()) { 

            $main_id = $a['id'];
            $qf = $dbi->query("SELECT `id` FROM `indicator_field` WHERE `main_id` = '$main_id' ");
            $rows = $qf->num_rows;
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$a['date_create'];?></td>
                <td><?=$a['name'];?></td>
                <td><?=$a['status'];?></td>
                <td><?=$a['creater'];?></td>
                <td><?=$rows;?></td>
                <td><a href="ha_field.php?id=<?=$a['id'];?>">จัดการฟิลด์</a></td>
                <td>
                    <a href="ha_main.php?id=<?=$a['id'];?>&page=edit" title="แก้ไข"><img src="images/icons/page_white_edit.png"></a>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </table>
        <?php
    }
    ?>
    <div>

    </div>
</body>
</html>