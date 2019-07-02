<?php 
include 'bootstrap.php';
include_once 'includes/JSON.php';
$db = Mysql::load();
$action = input('action');
if( $action == 'save_qr' ){

    $title = input_post('title');
    $id = input_post('id');
    $file = $_FILES['qr_file'];
    
    // DIR
    $uploads_dir = 'qr_code';
    $full_parth = NULL;

    if( $id === false ){
        
        if($file['error'] == UPLOAD_ERR_OK){

            $tmp_name = $file["tmp_name"];
            $name = basename($file["name"]);

            $prefix = substr(strrchr($name, "."), 1);
            $rand = rand(10000, 99999);
            $new_file = date('Ymd').$rand.'.'.$prefix;

            $full_parth = "$uploads_dir/$new_file";

            $test_upload = move_uploaded_file($tmp_name, $full_parth);
            
        }

        $sql = "INSERT INTO `qr_pics` (`id`, `name`, `parth`, `status`) VALUES (NULL, '$title', '$full_parth', 1);";
        $db->select($sql);

    }else if($id > 0){

        $db->select("SELECT `parth` FROM `qr_pics` WHERE `id` = '$id' ");
        $item = $db->get_item();

        if($file['error'] == UPLOAD_ERR_OK){
            $tmp_name = $file["tmp_name"];
            $full_parth = $item['parth'];
            $test_upload = move_uploaded_file($tmp_name, $full_parth);
        }

        $sql = "UPDATE `qr_pics` SET `name`='$title', `parth`='$full_parth' WHERE `id`='$id' LIMIT 1;";
        $db->update($sql);

    }

    redirect('rdu_qrcode.php?page=qr', 'บันทึกข้อมูลเรียบร้อย');

    exit;
}elseif ( $action == 'bin_pic' ) {
    $id = input_get('id');

    $db->update("UPDATE `qr_pics` SET `status`='0 WHERE `id`='$id' LIMIT 1;");
    redirect('rdu_qrcode.php?page=qr', 'ดำเนินการเรียบร้อย');

    exit;
}elseif ( $action == 'search_drug' ) {

    $db->select("SELECT `drugcode`,`tradname`,`genname` FROM `druglst` WHERE `drugcode` LIKE '$drug_name%' OR `tradname` LIKE '$drug_name%' OR `genname` LIKE '$drug_name%' ");
    $items = $db->get_items();

    $json = new Services_JSON();
    $output = $json->encode($items);
    echo $output;

    exit;
}elseif ( $action == 'save_drug' ) { 

    $code = trim(input_post('drug_name'));
    $qr_pic_id = input_post('qr_id');

    $db->select("SELECT `parth` FROM `qr_pics` WHERE `id` = '$qr_pic_id' ");
    $qr = $db->get_item();

    $parth = $qr['parth'];

    $sql_insert = "INSERT INTO `qr_drugs` (
        `id`, `drug_code`, `qr_pic_id`, `status`, `pic_parth`
    ) VALUES (
        NULL, '$code', '$qr_pic_id', 1, '$parth'
    );";
    $db->insert($sql_insert);
    //

    redirect('rdu_qrcode.php?page=drug', 'บันทึกข้อมูลเรียบร้อย');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการ QR Code คู่รหัสยา</title>
</head>
<body>
    <style type="text/css">
    .clearfix:after{
        content: "";
        display: table;
        clear: both;
    }

    /* ตาราง */
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table, th, td{
        border: 1px solid black;
    }

    .chk_table th,
    .chk_table td{
        padding: 3px;
    }

    /* เมนู */
    .chk_menu{
        margin-bottom: 1em;
        padding-bottom: 5px;
    }
    .chk_menu ul{
        margin: 0;
        padding: 0;
    }
    .chk_menu ul li{
        list-style: none;
        float: left;
    }
    .chk_menu ul li a{
        float: left;
        padding: 10px;
        text-decoration: none;
        color: #000000;
        background-color: #e2e2e2;
        margin-right: 2px;
    }
    .chk_menu ul li a:hover{
        background-color: #bfbfbf;
    }
    </style>
    <div>
        <h3>RDU - ระบบ QR Code ตามรหัสยา</h3>
    </div>
    <div class="chk_menu">
        <ul>
            <li><a href="../nindex.htm">หน้าหลัก ร.พ.ฯ</a></li>
            <li><a href="rdu_qrcode.php?page=qr">จัดการQR</a></li>
            <li><a href="rdu_qrcode.php?page=drug">จับคู่ยา</a></li>
        </ul>
    </div>
    <div class="clearfix"></div>

    <?php 
    if( isset($_SESSION['x-msg']) ){
        ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
        unset($_SESSION['x-msg']);
    }
    ?>

    <div class="container">
    <?php 
    $page = input('page');
    $section = input_get('section');
    if ( $page == 'qr' ) {
        $id = false;
        if( $section == 'edit' ){
            $id = input_get('id');
            $db->select("SELECT * FROM `qr_pics` WHERE `id` = '$id' ");
            $qr = $db->get_item();

            $name = $qr['name'];
            $parth = $qr['parth'];
        }

        ?>
        <div>
            <h3>หน้าจัดการ QR Code</h3>
        </div>
        <div>
            <form action="rdu_qrcode.php" method="post" enctype="multipart/form-data">
                <div>
                    <label for="title">ชื่อ QR Code: <input type="text" name="title" id="title" value="<?=$name;?>"></label>
                </div>
                <div>
                    เลือกไฟล์: <input type="file" name="qr_file" id="">
                    <?php 
                    if ( $id !== false ) {
                        ?>
                        <div>
                            [รูปเดิม]<br>- การอัพโหลดรูปใหม่จะเป็นการแทนที่รูปเดิม<br><img src="<?=$parth;?>" alt="<?=$name;?>">
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div>
                    <button type="submit">บันทึก</button>
                    <input type="hidden" name="action" value="save_qr">
                    <input type="hidden" name="id" value="<?=$id;?>">
                </div>
            </form>
        </div>
        <div>
            <h3>รายการ QR Code</h3>
        </div>
        <div>
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>ชื่อ</th>
                    <th>QR Code</th>
                    <th>จัดการ</th>
                </tr>
                <?php 
                $db->select("SELECT * FROM `qr_pics` WHERE `status` = 1 ORDER BY `id` DESC");
                $items = $db->get_items();
                $i = 0;
                foreach ($items as $key => $item) {
                    ++$i;
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$item['name'];?></td>
                        <td><img src="<?=$item['parth'];?>" alt="<?=$item['name'];?>"></td>
                        <td>
                            <a href="rdu_qrcode.php?action=bin_pic&id=<?=$item['id'];?>" onclick="return confirm('ยืนยันการลบข้อมูล?')">ลบ</a> | <a href="rdu_qrcode.php?page=qr&section=edit&id=<?=$item['id'];?>">แก้ไข</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }elseif ( $page == 'drug' ) {
        //

        $db->select("SELECT * FROM `qr_pics` ORDER BY `id` DESC");
        $qr_items = $db->get_items();
        ?>
        <div>
            <h3>เพิ่มยา</h3>
        </div>
        <div style="position: relative;">
            <form action="rdu_qrcode.php" method="post">
                <div>
                    รหัสยา: <input type="text" name="drug_name" id="drug_name">
                </div>
                <div>
                    QR Code: <select name="qr_id" id="qr_id">
                    <?php 
                    foreach ($qr_items as $key => $qr) {
                        ?>
                        <option value="<?=$qr['id'];?>"><?=$qr['name'];?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div>
                    <button type="submit">บันทึก</button>
                    <input type="hidden" name="action" value="save_drug">
                </div>
            </form>
            <div style="position: absolute; left: 0;">
                <div id="drug_list" style="display: none; background-color: #ffffff; border: 6px solid #00ad02;"></div>
            </div>
        </div>
        <div>
            <div>
                <h3>จัดการข้อมูล</h3>
            </div>
            <?php 
            $sql = "SELECT *, b.`name` AS `group_name`,c.`tradname`,c.`genname`
            FROM `qr_drugs` AS a 
            LEFT JOIN `qr_pics` AS b ON b.`id` = a.`qr_pic_id` 
            LEFT JOIN `druglst` AS c ON c.`drugcode` = a.`drug_code` 
            ORDER BY a.`qr_pic_id`,a.`id` DESC";
            
            $db->select($sql);
            $drug_items = $db->get_items();
            ?>
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>รหัสยา</th>
                    <th>กลุ่ม</th>
                    <th>Trade name</th>
                    <th>General name</th>
                    <th>จัดการ</th>
                </tr>
            <?php
            $i=0;
            foreach ($drug_items as $key => $item) {
                ++$i;
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['drug_code'];?></td>
                    <td><?=$item['group_name'];?></td>
                    <td><?=$item['tradname'];?></td>
                    <td><?=$item['genname'];?></td>
                    <td>
                        <a href="#">ลบ</a> | <a href="#">แก้ไข</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
        </div>
        <style>
        .code_item{
            color: blue;
            text-decoration: underline;
        }
        .code_item:hover{
            cursor: pointer;
        }
        </style>
        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script>

        document.getElementById('drug_name').focus();

        $(function(){
            $(document).on('keyup', '#drug_name', function(){

                var dCode = $(this).val().trim();
                if(dCode.length > 2){

                
                $.ajax({
                    url: 'rdu_qrcode.php',
                    type: 'POST',
                    data: {'action': 'search_drug', 'drug_name': dCode},
                    dataType: 'json',
                    success: function(res_html){

                        var html = '<table class="chk_table test_drug_code">';
                        html += '<tr class="close_btn"><td colspan="3" style="text-align: center;">[ ปิด ]</td></tr>';
                        html += '<tr><th>Drug Code</th><th>Trad Name</th><th>General Name</th></tr>';
                        var tb_tr = '';
                        res_html.forEach(function(element){
                            tb_tr += '<tr>';
                            tb_tr += '<td class="code_item" data-code="'+element.drugcode+'">'+element.drugcode+'</td>';
                            tb_tr += '<td>'+element.tradname+'</td>';
                            tb_tr += '<td>'+element.genname+'</td>';
                            tb_tr += '</tr>';
                        });
                        
                        html += tb_tr;
                        html += '</table>';

                        $('#drug_list').html(html).show();
                    }
                });

                }

            });

            $(document).on('click', '.code_item', function(){ 

                var key_code = $(this).attr('data-code');
                $('#drug_name').val(key_code);

                $('#drug_list').hide().html('');
            });

            $(document).on('click', '.close_btn', function(){
                $('#drug_list').hide().html('');
            });
        });
        </script>
        <?php
    }
    ?>
    </div>
</body>
</html>