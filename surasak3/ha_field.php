<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_POST['action']);
if($action==='save'){  

    $main_id = sprintf("%s", $_POST['id']);
    $editor = sprintf("%s", $_SESSION['sIdname']);
    foreach ($_POST['field_name'] as $key => $fname) {
        $sql = "INSERT INTO `indicator_field` (`id`, `main_id`, `name`, `depart`, `date_create`, `date_edit`, `creater`, `editor`) 
        VALUES 
        (NULL, '$main_id', '$fname', NULL, NOW(), NOW(), '$editor', '$editor');";
        $save = $dbi->query($sql);
    }

    redirect('ha_field.php?id='.$main_id);
    exit;
}elseif ($action==='update') {
    
    $main_id = sprintf("%s", $_POST['id']);
    $editor = sprintf("%s", $_SESSION['sIdname']);

    $sql = "SELECT * FROM `indicator_field` WHERE `main_id` = '$main_id' ";
    $q = $dbi->query($sql);
    $data_before = array();
    while ($a = $q->fetch_assoc()) {
        $fkey = $a['id'];
        $data_before[$fkey] = $a['name'];
        
    }
    
    // เพิ่ม
    if(count($_POST['field_name']) > count($data_before) ){
        $diff = array_diff($_POST['field_name'], $data_before);
        foreach ($diff as $id => $value) {
            
            // INSERT INTO 
            $sql = "INSERT INTO `indicator_field` (`id`, `main_id`, `name`, `depart`, `date_create`, `date_edit`, `creater`, `editor`) 
            VALUES 
            (NULL, '$main_id', '$value', NULL, NOW(), NOW(), '$editor', '$editor');";
            $save = $dbi->query($sql);
        }

    }elseif (count($data_before) > count($_POST['field_name'])) { // ลด

        $diff = array_diff($data_before, $_POST['field_name']);
        foreach ($diff as $id => $value) {
            dump($id);
            $sql = "DELETE FROM `indicator_field` WHERE `id`='$id';";
            $save = $dbi->query($sql);
        }
    }

    $intersect_items = array_intersect_key($_POST['field_name'], $data_before);
    foreach ($intersect_items as $key => $value) { 
        
        $sql = "UPDATE `indicator_field` SET 
        `name`='$value', 
        `date_edit`=NOW(), 
        `editor`='$editor' 
        WHERE (`id`='$key');";
        $save = $dbi->query($sql);
    }

    redirect('ha_field.php?id='.$main_id,'บันทึกข้อมูลเรียบร้อย');
    exit;
}

$action_value = 'save';

$id = sprintf("%s", $_GET['id']);
$q = $dbi->query("SELECT * FROM `indicator_main` WHERE `id` = '$id' LIMIT 1");
if($q->num_rows > 0){
    $a = $q->fetch_assoc();

    $field_html = '';
    $qf = $dbi->query("SELECT * FROM `indicator_field` WHERE `main_id` = '$id' ");
    if($qf->num_rows>0){ 

        $action_value = 'update';
        

        while ($af = $qf->fetch_assoc()) { 

            $fid = $af['id'];

            $q_data = $dbi->query("SELECT `id` FROM `indicator_data` WHERE `main_id` = '$id' AND `field_id` = '$fid' ");
            $d_rows = $q_data->num_rows;

            $remove = '[ยกเลิก]';
            if($d_rows===0){
                $remove = '<a href="javascript:void(0);" onclick="this.parentNode.remove()">[ยกเลิก]</a>';
            }


            $fname = $af['name'];
            $field_html .= '<div>ชื่อฟิลด์: <input type="text" name="field_name['.$fid.']" value="'.$fname.'" /> ('.$d_rows.') '.$remove.'</div>';
        }
    }

}else{
    echo "ไม่พบข้อมูล";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้าง ฟิลด์</title>
</head>
<body>
    <?php 
    include_once 'ha_menu.php';
    ?>
    <div>
        <form action="ha_field.php" method="post">
            <div>
                ชื่อฟอร์ม: <?=$a['name'];?>
            </div>
            <div>
                <div id="data-field"><?=$field_html;?></div>
                <div><a href="javascript:void(0)" onclick="add_field()">[ + เพิ่มข้อมูลตัวชี้วัด]</a></div>
            </div>
            <div>
                <div style="color: red;">ยังมีปัญหาตอน edit</div>
                <button type="submit">บันทึกฟิลด์</button>
                <input type="hidden" name="action" value="<?=$action_value;?>">
                <input type="hidden" name="id" value="<?=$id;?>">
            </div>
        </form>
    </div>
    <script>
        function add_field(){
            var f = document.getElementById('data-field');

            var d = document.createElement("div");
            d.append("ชื่อฟิลด์: ");

            var input = document.createElement("input");
            input.setAttribute('type', "text");
            input.setAttribute('name', "field_name[]");

            var in_a = document.createElement("a");
            in_a.setAttribute('href', "javascript:void(0);");
            in_a.setAttribute('onclick', "this.parentNode.remove()");
            in_a.append('[ยกเลิก]');

            d.appendChild(input);
            d.appendChild(in_a);

            f.appendChild(d);

        }
    </script>
</body>
</html>