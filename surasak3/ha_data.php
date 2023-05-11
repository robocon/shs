<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_POST['action']);
if($action==='save'){  

    $month = sprintf("%s", $_POST['months']);
    $year = sprintf("%s", $_POST['years']);
    $main_id = sprintf("%s", $_POST['main_id']);
    $editor = sprintf("%s", $_SESSION['sIdname']);

    if(empty($year)){
        redirect("ha_data.php?id=$main_id", 'กรุณาเลือกปีที่จะบันทึก');
        exit;
    }

    foreach ($_POST['data'] as $field_id => $value) {
        $sql = "INSERT INTO `indicator_data` (`id`, `main_id`, `field_id`, `value`, `year`, `month`, `date_create`, `date_edit`, `creater`, `editor`) 
        VALUES 
        (NULL, '$main_id', '$field_id', '$value', '$year', '$month', NOW(), NOW(), '$editor', '$editor');";
        $save = $dbi->query($sql);
    }

    redirect("ha_data.php?id=$main_id&month=$month&year=$year", 'บันทึกข้อมูลเรียบร้อย');
    exit;

}elseif ($action==='update') {

    $month = sprintf("%s", $_POST['months']);
    $year = sprintf("%s", $_POST['years']);
    $main_id = sprintf("%s", $_POST['main_id']);
    $editor = sprintf("%s", $_SESSION['sIdname']);

    foreach ($_POST['data'] as $field_id => $value) {
        $sql = "UPDATE `indicator_data` SET 
        `value`='$value', 
        `date_edit`=NOW(), 
        `editor`='$editor' 
        WHERE (`main_id`='$main_id' AND `field_id` = '$field_id' AND `year`='$year' AND `month`='$month' );";
        $save = $dbi->query($sql);
        
    }
    
    redirect("ha_data.php?id=$main_id&month=$month&year=$year", 'บันทึกข้อมูลเรียบร้อย');
    exit;

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include_once 'ha_menu.php';

    $month = $_GET['month'];
    $year = $_GET['year'];

    ?>
    <div>
        <?php 
        $id = sprintf("%s", $_GET['id']);
        $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `id` = '$id' LIMIT 1");
        $a = $q->fetch_assoc();
        ?>
        <div>
            <h1>ตัวชี้วัด: <?=$a['name'];?></h1>
        </div>
        <div>
            <?php 

            $data_month = 0;
            $data_year = 0;

            $qf = $dbi->query("SELECT * FROM `indicator_field` WHERE `main_id` = '$id' ");
            if($qf->num_rows>0){ 

                $action_value = 'save';

                $qd = $dbi->query("SELECT * FROM `indicator_data` WHERE `main_id` = '$id' AND `year`='$year' AND `month`='$month' ");
                if ($qd->num_rows>0) { 

                    $action_value = 'update';
                    $item_data = array();
                    
                    while ($data = $qd->fetch_assoc()) {
                        $key = $data['field_id'];
                        $item_data[$key] = $data['value'];

                        $data_month = $data['month'];
                        $data_year = $data['year'];
                    }
                }
            ?>
            <form action="ha_data.php" method="post">
                <table class="chk_table">
                    <tr>
                        <th>รายละเอียดตัวชี้วัด</th>
                        <th></th>
                    </tr>
                    <?php 
                    while ($af = $qf->fetch_assoc()) { 

                        $key = $af['id'];
                        
                        ?>
                        <tr>
                            <td><?=$af['name'];?></td>
                            <td><input type="text" name="data[<?=$af['id'];?>]" id="" value="<?=$item_data[$key];?>"></td>
                        </tr>
                        <?php
                    }
                    ?>
                    
                </table>
                <table>
                    <tr>
                        <td><b>เดือนที่บันทึก</b></td>
                        <td>
                            <select name="months" id="months">
                                <option value="">เลือกเดือน</option>
                                <?php 
                                foreach ($def_fullm_th as $key => $value) { 
                                    $selected = $key == $month ? 'selected="selected"' : '' ;
                                    ?>
                                    <option value="<?=$key;?>" <?=$selected;?> ><?=$value;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><b>ปีที่บันทึก</b></td>
                        <td>
                            <?php 
                            $range = range('2019', date('Y'));
                            ?>
                            <select name="years" id="years">
                                <option value="">เลือกปี</option>
                                <?php 
                                foreach ($range as $key => $value) {
                                    $selected = $value == $year ? 'selected="selected"' : '' ;
                                    ?>
                                    <option value="<?=$value;?>" <?=$selected;?> ><?=($value+543);?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit">บันทึกข้อมูล</button>
                            <input type="hidden" name="main_id" value="<?=$a['id'];?>">
                            <input type="hidden" name="action" value="<?=$action_value;?>">
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
            }else{
                ?>
                <p>ยังไม่มีข้อมูลตัวชี้วัด <a href="ha_field.php?id=<?=$id;?>">คลิกที่นี่เพื่อเพิ่มตัวชี้วัด</a></p>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>