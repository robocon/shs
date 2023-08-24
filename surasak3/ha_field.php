<?php 
include 'bootstrap.php';

$sOfficer = $_SESSION['sOfficer'];
$sMenucode = $_SESSION['smenucode'];
if( ($sMenucode!='ADMOBG' && $sOfficer!='สุมีนา โมเหล็ก') && ($sMenucode!='ADM' && $sMenucode!='ADMCOM') ){
    echo "ระงับสิทธิการใช้งาน ไม่สามารถเข้าถึงเมนูนี้ได้ กรุณาติดต่อศูนย์พัฒนาคุณภาพ";
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_POST['action']);
// ตอนบันทึก field ครั้งแรกเท่านั้น ครั้งต่อๆไปจะไปเข้าเงื่อนไข update
if($action==='save'){  

    $main_id = sprintf("%s", $_POST['id']);
    $editor = sprintf("%s", $_SESSION['sIdname']);
    
    $i = 1;
    foreach ($_POST['field_name'] as $key => $fname) { 

        $target = $_POST['target'][$key];

        $sql = "INSERT INTO `indicator_field` 
        (`id`, `main_id`, `name`, `target`, `depart`, `date_create`, `date_edit`, `creater`, `editor`, `status`, `sort`) 
        VALUES 
        (NULL, '$main_id', '$fname', '$target', NULL, NOW(), NOW(), '$editor', '$editor', 'y', '$i' );";
        $save = $dbi->query($sql);

        $i++;
    }

    redirect('ha_field.php?id='.$main_id, 'บันทึกข้อมูลเรียบร้อย');
    exit;

}elseif ($action==='update') {
    
    $main_id = sprintf("%s", $_POST['id']);
    $editor = sprintf("%s", $_SESSION['sIdname']);

    // เลือกข้อมูลเดิมออกมาก่อน
    $sql = "SELECT * FROM `indicator_field` WHERE `main_id` = '$main_id' ORDER BY `sort` IS NULL, `sort`,`id` ASC";
    $q = $dbi->query($sql);
    $data_before = array();
    $status_before = array();
    $target_before = array();
    
    while ($a = $q->fetch_assoc()) {

        $fkey = $a['id'];
        $data_before[$fkey] = $a['name'];
        $status_before[$fkey] = $a['status'];
        $target_before[$fkey] = $a['target'];

    }

    $msg = 'บันทึกข้อมูลเรียบร้อย';

    if(count($_POST['field_name'])==0){
        $_POST['field_name'] = array();
    }

    // ถ้าจำนวน POST มีเยอะกว่า $data_before ให้ diff หาความต่างแล้วเพิ่มข้อมูล
    if(count($_POST['field_name']) > count($data_before) ){
        $diff = array_diff_assoc($_POST['field_name'], $data_before);
        $status_diff = array_diff_assoc($_POST['status'], $status_before);
        $target_diff = array_diff_assoc($_POST['target'], $target_before);
        foreach ($diff as $id => $value) {
            
            $status = $status_diff[$id];
            $target = $target_diff[$id];
            
            // INSERT INTO 
            $sql = "INSERT INTO `indicator_field` (`id`, `main_id`, `name`, `target`, `depart`, `date_create`, `date_edit`, `creater`, `editor`, `status`) 
            VALUES 
            (NULL, '$main_id', '$value', '$target', NULL, NOW(), NOW(), '$editor', '$editor', '$status');";
            $save = $dbi->query($sql);
            if($save===false){
                $msg = $dbi->error;
            }
        }

    }elseif (count($data_before) > count($_POST['field_name'])) { // เทียบข้อมูล ถ้ามีฟิลด์หายไป คือการลบ
        
        $diff = array_diff_assoc($data_before, $_POST['field_name']);
        foreach ($diff as $id => $value) {
            
            $sql = "DELETE FROM `indicator_field` WHERE `id`='$id';";
            $save = $dbi->query($sql);
        }
    }

    $intersect_items = array_intersect_key($_POST['field_name'], $data_before);
    $intersect_status = array_intersect_key($_POST['status'], $status_before);
    $intersect_target = array_intersect_key($_POST['target'], $target_before);


    foreach ($intersect_items as $key => $value) { 
        
        $status = $intersect_status[$key];
        $target = $intersect_target[$key];

        $sql = "UPDATE `indicator_field` SET 
        `name`='$value', 
        `target`='$target',
        `date_edit`=NOW(), 
        `editor`='$editor',
        `status`='$status'
        WHERE (`id`='$key');";
        $save = $dbi->query($sql);
    }


    $sql = "SELECT * FROM `indicator_field` WHERE `main_id` = '$main_id' ORDER BY `sort` IS NULL, `sort`,`id` ASC";
    $q = $dbi->query($sql);
    if($q->num_rows > 0){
        $sort = 1;
        while ($a = $q->fetch_assoc()) {

            $id = $a['id'];

            $sqlUpdate = "UPDATE `indicator_field` SET `sort` = '$sort' WHERE `id` = '$id' ";
            $update = $dbi->query($sqlUpdate);

            $sort++;
        }
    }

    redirect('ha_field.php?id='.$main_id, $msg);
    exit;
}

$action_value = 'save';

$id = sprintf("%s", $_GET['id']);
$q = $dbi->query("SELECT * FROM `indicator_main` WHERE `id` = '$id' LIMIT 1");
if($q->num_rows > 0){
    $a = $q->fetch_assoc();

    $field_html = '';

    $div_html = '';
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
            $target = $af['target'];

            $field_html .= '<tr class="box">';
            $field_html .= '<td><input type="text" name="field_name['.$fid.']" value="'.$fname.'" size="40" /></td>';
            $field_html .= '<td><input type="text" name="target['.$fid.']" value="'.$target.'" size="20" /></td>';
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

            // $field_html .= '</td>';
            $div_html .= '<div class="flex-row box" draggable="true">';
            $div_html .= '<div class="flex-col drag">[ :::: ]</div>';
            $div_html .= '<div class="flex-col" style="flex-grow: 3"><input type="text" name="field_name['.$fid.']" value="'.$fname.'" size="40" /></div>';
            $div_html .= '<div class="flex-col" style="flex-grow: 2"><input type="text" name="target['.$fid.']" value="'.$target.'" size="20" /></div>';
            $div_html .= '<div class="flex-col" style="flex-grow: 1">'.$d_rows.'</div>';
            $div_html .= '<div class="flex-col" style="flex-grow: 1">'.$remove.'</div>';
            $div_html .= '<div class="flex-col" style="flex-grow: 1"><select name="status['.$fid.']"><option value="y" '.$selected_y.'>แสดง</option><option value="n" '.$selected_n.'>ซ่อน</option></select></div>';
            $div_html .= '</div>';

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
                            <th>เป้าหมาย</th>
                            <th>จำนวนข้อมูล</th>
                            <th>จัดการ</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody id="data-field" class="container">
                        <?=$field_html;?>
                    </tbody>
                </table>
                <style>
                    .title{
                        text-align: center;
                        font-weight: bold;
                    }
                    .flex-container .flex-row, .flex-col{
                        display: flex;
                    }
                    .flex-col{
                        flex: 1;
                    }
                    .flex-row{
                        gap: 4px;
                        border: 1px solid #ffffff;
                    }
                    .drag:hover{
                        cursor: grab;
                    }
                    .over{
                        border: 1px dashed #000000;
                    }
                </style>
                <div class="flex-container " style="width:60%;">
                    <div class="flex-row">
                        <div class="flex-col title" style="">&nbsp;</div>
                        <div class="flex-col title" style="flex-grow: 3">ชื่อรายละเอียด</div>
                        <div class="flex-col title" style="flex-grow: 2">เป้าหมาย</div>
                        <div class="flex-col title" style="flex-grow: 1">จำนวนข้อมูล</div>
                        <div class="flex-col title" style="flex-grow: 1">จัดการ</div>
                        <div class="flex-col title" style="flex-grow: 1">สถานะ</div>
                    </div>
                    <div class="container" id="my-list">
                        <?=$div_html;?>
                    </div>
                </div>
                <div><a href="javascript:void(0)" onclick="add_field()">[ + เพิ่มรายละเอียดตัวชี้วัด]</a></div>
            </div>
            <div>
                <button type="submit">บันทึก</button>
                <input type="hidden" name="action" value="<?=$action_value;?>">
                <input type="hidden" name="id" value="<?=$id;?>">
            </div>
        </form>
    </div>

    <!-- https://sortablejs.github.io/Sortable/#grid -->
    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script>
        function add_field(){
            var f = document.getElementById('data-field');

            var newContain = document.getElementById('my-list');

            var tr = document.createElement("tr");
            var dContain = document.createElement("div");
            dContain.setAttribute('class', "flex-row box");
            dContain.setAttribute('draggable', "true");

            var td1 = document.createElement("td");
            var d1 = document.createElement("div");
            d1.setAttribute('class', "flex-row");

            var input = document.createElement("input");
            input.setAttribute('type', "text");
            input.setAttribute('size', "40");
            input.setAttribute('name', "field_name[]");
            td1.appendChild(input);
            d1.appendChild(input);

            var d2 = document.createElement("div");
            d2.setAttribute('class', "flex-row");
            d2.append('[ :::: ]');

            var td_target = document.createElement("td");
            var d3 = document.createElement("div");
            d3.setAttribute('class', "flex-row");
            var input_target = document.createElement("input");
            input_target.setAttribute('type', "text");
            input_target.setAttribute('size', "20");
            input_target.setAttribute('name', "target[]");
            td_target.appendChild(input_target);
            d3.appendChild(input_target);

            var td2 = document.createElement("td");
            var d4 = document.createElement("div");
            d4.setAttribute('class', "flex-row");

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
            tr.appendChild(td_target);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);

            f.appendChild(tr);


            dContain.appendChild(d1);
            dContain.appendChild(d2);
            dContain.appendChild(d3);
            dContain.appendChild(d4);
            newContain.appendChild(dContain);

            /*
            x$div_html .= '<div class="flex-row box" draggable="true">';
            x$div_html .= '<div class="flex-col drag">[ :::: ]</div>';
            x$div_html .= '<div class="flex-col" style="flex-grow: 3"><input type="text" name="field_name['.$fid.']" value="'.$fname.'" size="40" /></div>';
            $div_html .= '<div class="flex-col" style="flex-grow: 2"><input type="text" name="target['.$fid.']" value="'.$target.'" size="20" /></div>';
            $div_html .= '<div class="flex-col" style="flex-grow: 1">'.$d_rows.'</div>';
            $div_html .= '<div class="flex-col" style="flex-grow: 1">'.$remove.'</div>';
            $div_html .= '<div class="flex-col" style="flex-grow: 1"><select name="status['.$fid.']"><option value="y" '.$selected_y.'>แสดง</option><option value="n" '.$selected_n.'>ซ่อน</option></select></div>';
            $div_html .= '</div>';
            */

        }

        $('#my-list').sortable({
            animation: 150
        });
    </script>
</body>
</html>