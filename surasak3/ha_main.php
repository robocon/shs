<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_REQUEST['action']);
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
}elseif ($action==='delete') { 

    $id = sprintf("%s", $_GET['id']);
    $q = $dbi->query("DELETE FROM `indicator_main` WHERE `id`='$id';");
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if($q===false){
        $msg = 'บันทึกข้อมูลไม่สำเร็จ '.$dbi->error;
    }

    redirect('ha_main.php', $msg);
    exit;
}elseif ($action==='update_status') { 

    $id = sprintf("%s", $_GET['id']);
    $set_status = sprintf("%s", $_GET['set_status']);

    $sql = "UPDATE `indicator_main` SET `status`='$set_status' WHERE (`id`='$id');";
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
    <title>สร้าง/แก้ไข หัวข้อตัวชี้วัด</title>
</head>
<body>
    <?php 

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
    <fieldset style="margin-top:1em;">
        <legend><h1>สร้างหัวข้อตัวชี้วัด</h1></legend>
        <form action="ha_main.php" method="post" id="form_ha_main">
            <div style="margin-bottom:8px;">
                <label for="name">ชื่อหัวข้อ</label>
                <input type="text" name="name" id="name" value="<?=$item['name'];?>">
            </div>
            <div>
                <button type="submit">บันทึก</button>
                <input type="hidden" name="action" value="<?=$action;?>">
                <input type="hidden" name="id" value="<?=$item['id'];?>">
            </div>
        </form>
    </fieldset>
    <script>
        document.getElementById("form_ha_main").onsubmit = function(){
            var name = document.getElementById("name");
            if(name.value==''){
                alert("กรุณาใส่ชื่อหัวข้อตัวชี้วัด");
                event.preventDefault();
                return false;
            }
        }
    </script>
    <?php 
    $all_items = array();
    $q = $dbi->query("SELECT *,(select max(`sort`) from indicator_main where parent is null ) as max_sort FROM `indicator_main` WHERE `parent` IS NULL ORDER BY `sort`,`id` ASC");
    $q_num_rows = $q->num_rows;
    if($q_num_rows > 0){ 
        
        while ($a = $q->fetch_assoc()) { 

            $parent_id = $a['id'];
            $max_sort = $a['max_sort'];

            if($a['sort']==1){
                $a['position'] = 'top';
            }

            if($a['sort']==$max_sort){
                $a['position'] = 'bottom';
            }

            $all_items[] = $a;

            $q2 = $dbi->query("SELECT * FROM `indicator_main` WHERE `parent` = '$parent_id' ORDER BY `sort` ASC");
            $q2_num_rows = $q2->num_rows;
            if($q2_num_rows > 0){

                while ($sub = $q2->fetch_assoc()) {

                    if($sub['sort']==1){
                        $sub['position'] = 'top';
                    }
        
                    if($sub['sort']==$q2_num_rows){
                        $sub['position'] = 'bottom';
                    }

                    $all_items[] = $sub;
                }
            }

        }
    }
    
    
    // if($q->num_rows>0){ 
    if(count($all_items) > 0){
        ?>
        <div>&nbsp;</div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>วันที่สร้าง</th>
                <th>ชื่อ</th>
                <th>สร้างโดย</th>
                <th>จำนวนรายการ</th>
                <th>เรียงลำดับ</th>
                <th>จัดการ</th>
                <th>สถานะ</th>
            </tr>
        <?php
        $i = 1;
        // while ($a = $q->fetch_assoc()) {  
        foreach($all_items as $a){
            $main_id = $a['id'];

            // $q2 = $dbi->query("SELECT * FROM `indicator_main` WHERE `parent` = '$main_id'");
            // if($q2->num_rows>0){
            //     $b = $q2->fetch_all();
            //     dump($b);
            // }

            $on_off_color = 'green';
            
            $txt_status = 'แสดง';
            if($a['status']=='n'){
                $txt_status = 'ซ่อน';
                $on_off_color = 'red';
            }

            $status_revers = 'y';
            if($a['status']=='y'){ 
                $status_revers = 'n';
            }
            

            $qf = $dbi->query("SELECT `id` FROM `indicator_field` WHERE `main_id` = '$main_id' ");
            $field_rows = $qf->num_rows;
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$a['date_create'];?></td>
                <td>
                    <?php 
                    if($a['parent']){
                        ?>
                        <span>|--&nbsp;</span>
                        <?php
                    }
                    ?>
                    <a href="ha_main.php?id=<?=$a['id'];?>&page=edit" title="คลิกเพื่อแก้ไข"><?=$a['name'];?></a>
                </td>
                <td><?=$a['creater'];?></td>
                <td><?=$field_rows;?></td>
                <td>
                    <?php 
                    if($a['sort']){
                        ?>
                        <table width="100%">
                        <tr>
                            <td width="10%"><?=$a['sort'];?></td>
                            <td width="33%">
                                <?php 

                                $ext_url = "";
                                if($a['parent']){
                                    $ext_url = "&parent=".$a['parent'];
                                }

                                $url = "ha_main.php?action=move&id=".$a['id'].$ext_url;

                                if ($a['position']!='top') {
                                    
                                    ?>
                                    <a href="<?=$url.'&direction=up&sort='.($a['sort']-1);?>"><img src="images/icons/iconmonstr-caret-up-filled-32.png" alt="move up" title="เลื่อนขึ้น"></a>
                                    <?php
                                }
                                ?>
                            </td>
                            <td width="33%">
                                <?php 
                                if ($a['position']!='bottom') {
                                    ?>
                                    <a href="<?=$url.'&direction=down&sort='.($a['sort']+1);?>"><img src="images/icons/iconmonstr-caret-down-filled-32.png" alt="move down" title="เลื่อนลง"></a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        </table>
                        
                        <?php 
                    }
                    ?>
                    
                </td>
                <td align="center">
                    <a href="ha_field.php?id=<?=$a['id'];?>" class="icon"><img src="images/icons/Application.png" title="แก้ไขรายละเอียดตัวชี้วัด"/></a> 
                <?php 
                if($field_rows==0){
                    ?>
                    | <a href="ha_main.php?action=delete&id=<?=$a['id'];?>" class="icon" onclick="return confirm('ยืนยันที่จะลบข้อมูลนี้?');"><img src="images/icons/Trash.png" title="ลบข้อมูล"/>
                    <?php
                }
                ?>
                </td>
                <td align="center">
                    <a href="ha_main.php?action=update_status&id=<?=$a['id'];?>&set_status=<?=$status_revers;?>" class="icon <?=$on_off_color;?>" title="คลิกเพื่อปรับเปลี่ยนสถานะ"><?=$txt_status;?></a> 
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