<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_POST['action']);
if($action==='save'){  

    $main_id = sprintf("%s", $_POST['id']);
    $editor = sprintf("%s", $_SESSION['sIdname']);
    foreach ($_POST['field_name'] as $key => $fname) {
        $sql = "INSERT INTO `indicator_field` (`id`, `main_id`, `name`, `depart`, `date_create`, `date_edit`, `creater`, `editor`, `status`) 
        VALUES 
        (NULL, '$main_id', '$fname', NULL, NOW(), NOW(), '$editor', '$editor', 'y');";
        $save = $dbi->query($sql);
    }

    redirect('ha_field.php?id='.$main_id, 'บันทึกข้อมูลเรียบร้อย');
    exit;

}elseif ($action==='update') {
    
    $main_id = sprintf("%s", $_POST['id']);
    $editor = sprintf("%s", $_SESSION['sIdname']);

    $sql = "SELECT * FROM `indicator_field` WHERE `main_id` = '$main_id' ";
    $q = $dbi->query($sql);
    $data_before = array();
    $status_before = array();
    while ($a = $q->fetch_assoc()) {
        $fkey = $a['id'];
        $data_before[$fkey] = $a['name'];
        $status_before[$fkey] = $a['status'];
    }

    $msg = 'บันทึกข้อมูลเรียบร้อย';

    if(count($_POST['field_name'])==0){
        $_POST['field_name'] = array();
    }

    // เพิ่ม
    if(count($_POST['field_name']) > count($data_before) ){
        $diff = array_diff_assoc($_POST['field_name'], $data_before);
        $status_diff = array_diff_assoc($_POST['status'], $status_before);
        foreach ($diff as $id => $value) {
            
            $status = $status_diff[$id];

            // INSERT INTO 
            $sql = "INSERT INTO `indicator_field` (`id`, `main_id`, `name`, `depart`, `date_create`, `date_edit`, `creater`, `editor`, `status`) 
            VALUES 
            (NULL, '$main_id', '$value', NULL, NOW(), NOW(), '$editor', '$editor', '$status');";
            $save = $dbi->query($sql);
        }

    }elseif (count($data_before) > count($_POST['field_name'])) { // ลด

        $diff = array_diff_assoc($data_before, $_POST['field_name']);
        foreach ($diff as $id => $value) {
            
            $sql = "DELETE FROM `indicator_field` WHERE `id`='$id';";
            $save = $dbi->query($sql);
        }
    }

    $intersect_items = array_intersect_key($_POST['field_name'], $data_before);
    $intersect_status = array_intersect_key($_POST['status'], $status_before);
    foreach ($intersect_items as $key => $value) { 
        
        $status = $intersect_status[$key];

        $sql = "UPDATE `indicator_field` SET 
        `name`='$value', 
        `date_edit`=NOW(), 
        `editor`='$editor',
        `status`='$status'
        WHERE (`id`='$key');";
        $save = $dbi->query($sql);
    }

    redirect('ha_field.php?id='.$main_id, 'บันทึกข้อมูลเรียบร้อย');
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
            $fstatus = $af['status'];

            $q_data = $dbi->query("SELECT `id` FROM `indicator_data` WHERE `main_id` = '$id' AND `field_id` = '$fid' ");
            $d_rows = $q_data->num_rows;

            $remove = '[ยกเลิก]';
            if($d_rows===0){
                $remove = '<a href="javascript:void(0)" onclick="this.closest(\'tr\').remove()">[ยกเลิก]</a>';
            }

            $fname = $af['name'];

            $field_html .= '<tr>';
            $field_html .= '<td><input type="text" name="field_name['.$fid.']" value="'.$fname.'" size="40" /></td>';
            $field_html .= '<td align="center">'.$d_rows.'</td>';
            $field_html .= '<td>'.$remove.'</td>';

            // $fstatus
            $selected_y = $fstatus==='y' ? 'selected="selected"' : '';
            $selected_n = $fstatus==='n' ? 'selected="selected"' : '';

            $field_html .= '<td>';
            $field_html .= '<select name="status['.$fid.']">';
            $field_html .= '<option value="y" '.$selected_y.'>แสดง</option>';
            $field_html .= '<option value="n" '.$selected_n.'>ซ่อน</option>';
            $field_html .= '</select>';
            $field_html .= '</td>';
            // $field_html .= '<td><input type="text" name="status['.$fid.']" value="'.$fstatus.'" size="5"></td>';

            $field_html .= '</td>';
            // $field_html .= '<div>ชื่อฟิลด์: <input type="text" name="field_name['.$fid.']" value="'.$fname.'" /> ('.$d_rows.') '.$remove.'</div>';
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
    <div>&nbsp;</div>
    <div>
        <form action="ha_field.php" method="post">
            <div>
                <h1>ชื่อตัวชี้วัด: <?=$a['name'];?></h1>
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ชื่อรายละเอียด</th>
                            <th>จำนวนข้อมูล</th>
                            <th>จัดการ</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody id="data-field">
                        <?=$field_html;?>
                    </tbody>
                </table>
                <div><a href="javascript:void(0)" onclick="add_field()">[ + เพิ่มรายละเอียดตัวชี้วัด]</a></div>
            </div>
            <div>
                <button type="submit">บันทึก</button>
                <input type="hidden" name="action" value="<?=$action_value;?>">
                <input type="hidden" name="id" value="<?=$id;?>">
            </div>
        </form>
    </div>
    <script>
        function add_field(){
            var f = document.getElementById('data-field');

            var tr = document.createElement("tr");

            var td1 = document.createElement("td");
            var input = document.createElement("input");
            input.setAttribute('type', "text");
            input.setAttribute('size', "40");
            input.setAttribute('name', "field_name[]");
            td1.appendChild(input);

            var td2 = document.createElement("td");
            td2.setAttribute('align', "center");
            td2.append('0');

            var td3 = document.createElement("td");

            var td4 = document.createElement("td");
            var td4_select = document.createElement("select");
            td4_select.setAttribute('name', "status[]");

            var td4_option1 = document.createElement("option");
            td4_option1.setAttribute('value', "y");
            td4_option1.append("แสดง");

            var td4_option2 = document.createElement("option");
            td4_option2.setAttribute('value', "n");
            td4_option2.append("ซ่อน");

            td4_select.appendChild(td4_option1);
            td4_select.appendChild(td4_option2);
            td4.appendChild(td4_select);

            var in_a = document.createElement("a");
            in_a.setAttribute('href', "javascript:void(0);");
            in_a.setAttribute('onclick', "this.closest('tr').remove()");
            in_a.append('[ยกเลิก]');

            td3.appendChild(in_a);

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);

            f.appendChild(tr);

        }
    </script>
</body>
</html>