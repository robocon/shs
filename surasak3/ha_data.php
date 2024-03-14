<?php 
include 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

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

    $res = 'บันทึกข้อมูลเรียบร้อย';
    if(intval($year)>0 && intval($month)==0){
        $where = " AND `year`='$year' AND `month`=''";

    }elseif (intval($year)>0 && intval($month)>0) {
        $where = " AND `year`='$year' AND `month`='$month'";
    }

    $q_data = $dbi->query("SELECT * FROM `indicator_data` WHERE `main_id` = '$main_id' $where ");
    if($q_data->num_rows===0){

        foreach ($_POST['data'] as $field_id => $value) {
            $sql = "INSERT INTO `indicator_data` (`id`, `main_id`, `field_id`, `value`, `year`, `month`, `date_create`, `date_edit`, `creater`, `editor`) 
            VALUES 
            (NULL, '$main_id', '$field_id', '$value', '$year', '$month', NOW(), NOW(), '$editor', '$editor');";
            $save = $dbi->query($sql);
        }

    }
    
    redirect("ha_data.php?id=$main_id", $res );
    
    exit;

}elseif ($action==='update') {

    $month = sprintf("%s", $_POST['months']);
    $year = sprintf("%s", $_POST['years']);
    $main_id = sprintf("%s", $_POST['main_id']);
    $editor = sprintf("%s", $_SESSION['sIdname']);

    foreach ($_POST['data'] as $field_id => $value) { 

        $f_sql = "SELECT `id` FROM `indicator_data` WHERE `field_id` = '$field_id' AND `year`='$year' AND `month`='$month'";
        $find = $dbi->query($f_sql);
        if ($find->num_rows > 0) {
            
            $sql = "UPDATE `indicator_data` SET 
            `value`='$value', 
            `date_edit`=NOW(), 
            `editor`='$editor' 
            WHERE (`main_id`='$main_id' AND `field_id` = '$field_id' AND `year`='$year' AND `month`='$month' );";
            
        }else{
            
            $sql = "INSERT INTO `indicator_data` (`id`, `main_id`, `field_id`, `value`, `year`, `month`, `date_create`, `date_edit`, `creater`, `editor`) 
            VALUES 
            (NULL, '$main_id', '$field_id', '$value', '$year', '$month', NOW(), NOW(), '$editor', '$editor');";

        }
        $save = $dbi->query($sql);

    }
    
    redirect("ha_data.php?id=$main_id", 'บันทึกข้อมูลเรียบร้อย');
    exit;

}elseif ($action==='load') { 
    $month = sprintf("%s", $_POST['month']);
    $year = sprintf("%s", $_POST['year']);
    $id = sprintf("%s", $_POST['id']);

    $test_month = (int) $month;

    $select = " AND `year` = '$year' AND (`month` = '' OR `month` IS NULL)";
    if($test_month > 0){
        $select = " AND `year` = '$year' AND `month` = '$month'";
    }

    $q = $dbi->query("SELECT * FROM `indicator_data` WHERE `main_id` = '$id' $select ");

    if($q->num_rows>0){

        $item = array();
        while ($a = $q->fetch_assoc()) {
            $item[] = $a;
        }

        $res = array(
            'ha_status' => 200,
            'ha_msg' => 'พบข้อมูล',
            'items' => $item
        );

    }else{
        $res = array(
            'ha_status' => 400,
            'ha_msg' => 'ไม่พบข้อมูล'
        );
    }

    echo $json->encode($res);
    exit;
}

$page_action = sprintf("%s",$_GET['page_action']);
$header_title = 'เพิ่มข้อมูลใหม่';
if($page_action==='update'){
    $header_title = 'แก้ไข/อัพเดท';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$header_title;?></title>
</head>
<body>
    <?php 
    include_once 'ha_menu.php';

    $month = sprintf("%02d", $_GET['month']);
    $year = sprintf("%02d", $_GET['year']);

    $extra_txt = '';
    if($page_action==='update'){
        $extra_txt = '<span style="display:inline-block;">(แก้ไข/อัพเดท)</span>';
    }

    ?>
    <div>
        <?php 
        $id = sprintf("%s", $_GET['id']);
        $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `id` = '$id' LIMIT 1");
        $a = $q->fetch_assoc();
        ?>
        <div>
            <h1 style="display:inline-block;">ตัวชี้วัด: <?=$a['name'];?></h1> <?=$extra_txt;?>
        </div>
        <div>
            <?php 

            $data_month = 0;
            $data_year = 0;

            $qf = $dbi->query("SELECT * FROM `indicator_field` WHERE `main_id` = '$id' AND `status`='y' ORDER BY `sort`");
            if($qf->num_rows>0){ 

                $action_value = 'save';
                $where = "";
                $per_year = false;
                if(intval($month)==0 && intval($year)>0){
                    $where = "AND `year`='$year' AND `month`=''";
                    $per_year = true;

                }elseif (intval($month)>0 && intval($year)>0) {
                    $where = "AND `year`='$year' AND `month`='$month'";

                }

                if($page_action==='update'){ 
                    
                    $qd = $dbi->query("SELECT * FROM `indicator_data` WHERE `main_id` = '$id' $where ");
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

                }
            ?>
            <form action="ha_data.php" method="post">
            <table>
                    <?php 
                    if($per_year===false){
                    ?>
                    <tr>
                        <td><b>เดือนที่บันทึก</b></td>
                        <td>
                            <select name="months" id="months" onchange="pre_load_data()">
                                <option value="">-- เลือกเดือน --</option>
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
                    <?php 
                    }
                    ?>
                    <tr>
                        <td><b>ปีที่บันทึก</b></td>
                        <td>
                            <?php 
                            $range = array_reverse(range('2019', date('Y')));
                            ?>
                            <select name="years" id="years" onchange="pre_load_data()">
                                <option value="">-- เลือกปี --</option>
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
                    
                </table>
                <table class="chk_table">
                    <tr>
                        <th>รายละเอียดตัวชี้วัด</th>
                        <th>เป้า</th>
                        <th></th>
                    </tr>
                    <?php 
                    while ($af = $qf->fetch_assoc()) { 

                        $key = $af['id'];
                        
                        ?>
                        <tr>
                            <td><?=$af['name'];?></td>
                            <td><?=$af['target'];?></td>
                            <td><input type="text" name="data[<?=$af['id'];?>]" class="field_input" id="field<?=$af['id'];?>" value="<?=$item_data[$key];?>"></td>
                        </tr>
                        <?php
                    }
                    ?>
                    
                </table>
                <table>
                    <tr>
                        <td colspan="2">
                            <button type="submit">บันทึกข้อมูล</button>
                            <input type="hidden" name="main_id" id="main_id" value="<?=$a['id'];?>">
                            <input type="hidden" name="action" id="action" value="<?=$action_value;?>">
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
    <script>
        function pre_load_data(){
            const month = document.getElementById('months').value;
            const year = document.getElementById('years').value;


            const id = document.getElementById('main_id').value;
            loadData(id,month,year).then((res)=>{ 
                if(res.ha_status==200){
                    res.items.forEach(el => { 
                    
                        if(el.value!==''){ 
                            
                            document.getElementById('field'+el.field_id).value = el.value;
                        }

                    });

                    document.getElementById('action').value = 'update';
                }else{

                    let field_inputs = document.getElementsByClassName('field_input');
                    for (let index = 0; index < field_inputs.length; index++) {
                        const element = field_inputs[index];
                        element.value = '';
                    }

                    document.getElementById('action').value = 'save';
                }
                
            });

        }

        async function loadData(id,month,year){ 
            var data = [];
            data.push(encodeURIComponent('action')+"="+encodeURIComponent('load'));
            data.push(encodeURIComponent('id')+"="+encodeURIComponent(id));
            data.push(encodeURIComponent('month')+"="+encodeURIComponent(month));
            data.push(encodeURIComponent('year')+"="+encodeURIComponent(year));
            var dataPost = data.join("&");

            let response = await fetch('ha_data.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: dataPost
            });
            const body = await response.json();
            return body;
        }
    </script>
</body>
</html>