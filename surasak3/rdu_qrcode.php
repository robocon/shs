<?php 
include 'bootstrap.php';
include_once 'includes/JSON.php';
$db = Mysql::load();

// $db->exec("SET NAMES TIS620");

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

    redirect('rdu_qrcode.php?page=qr', '�ѹ�֡���������º����');

    exit;
}elseif ( $action == 'bin_pic' ) {
    $id = input_get('id');

    $db->update("UPDATE `qr_pics` SET `status`='0 WHERE `id`='$id' LIMIT 1;");
    redirect('rdu_qrcode.php?page=qr', '���Թ������º����');

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
    $qr_drug_id = input('qr_drug_id');

    $db->select("SELECT `parth` FROM `qr_pics` WHERE `id` = '$qr_pic_id' ");
    $qr = $db->get_item();
    $parth = $qr['parth'];

    $msg = '�ѹ�֡���������º����';
    if( empty($qr_drug_id) ){

        $db->select("SELECT * FROM `qr_drugs` WHERE `drug_code` = '$code' ");
        $row = $db->get_rows();
        if( $row > 0 ){
            redirect('rdu_qrcode.php?page=drug', '�ºѹ�֡�ҵ�ǹ�������');
        }
        
        $sql_insert = "INSERT INTO `qr_drugs` (
            `id`, `drug_code`, `qr_pic_id`, `status`, `pic_parth`
        ) VALUES (
            NULL, '$code', '$qr_pic_id', 1, '$parth'
        );";
        $save = $db->insert($sql_insert);
        $state = 'save';

    }else{
        
        $sql_update = "UPDATE `qr_drugs` SET 
        `drug_code`='$code', 
        `qr_pic_id`='$qr_pic_id' 
        WHERE (`id`='$qr_drug_id');";
        $save = $db->update($sql_update);
        $state = 'edit';
    }

    if( $save !== true ){
        $msg = errorMsg($state, $save['id']);
    }
    
    redirect('rdu_qrcode.php?page=drug', $msg);
    exit;
}elseif ( $action == 'del_drug' ) { 

    $msg = '���Թ������º����';
    $id = input('del_id');
    $sql = "DELETE FROM `qr_drugs` WHERE `id` = :id ";
    $delete = $db->delete($sql,array(':id' => $id));
    if( $delete !== true ){
        $msg = errorMsg('delete', $delete['id']);
    }
    redirect('rdu_qrcode.php?page=drug', $msg);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>�к��Ѵ��� QR Code ���������</title>
</head>
<body>
    <style type="text/css">
    .clearfix:after{
        content: "";
        display: table;
        clear: both;
    }

    /* ���ҧ */
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

    /* ���� */
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
    .qr_drug_contain tr.drug_item:hover{
        background-color: #c6fdd2!important;
    }
    </style>
    <div>
        <h3>RDU - �к� QR Code ���������</h3>
    </div>
    <div class="chk_menu">
        <ul>
            <li><a href="../nindex.htm">˹����ѡ �.�.�</a></li>
            <li><a href="rdu_qrcode.php?page=qr">�Ѵ���QR</a></li>
            <li><a href="rdu_qrcode.php?page=drug">�Ѻ�����</a></li>
        </ul>
    </div>
    <div class="clearfix"></div>

    <?php 
    if( isset($_SESSION['x-msg']) ){
        ?><p style="background-color: #ffffc1; border: 2px solid #afaf00; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
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
            <h3>˹�ҨѴ��� QR Code</h3>
        </div>
        <div>
            <form action="rdu_qrcode.php" method="post" enctype="multipart/form-data">
                <div>
                    <label for="title">���� QR Code: <input type="text" name="title" id="title" value="<?=$name;?>"></label>
                </div>
                <div>
                    ���͡���: <input type="file" name="qr_file" id="">
                    <?php 
                    if ( $id !== false ) {
                        ?>
                        <div>
                            [�ٻ���]<br>- ����Ѿ��Ŵ�ٻ������繡��᷹����ٻ���<br><img src="<?=$parth;?>" alt="<?=$name;?>">
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div>
                    <button type="submit">�ѹ�֡</button>
                    <input type="hidden" name="action" value="save_qr">
                    <input type="hidden" name="id" value="<?=$id;?>">
                </div>
            </form>
        </div>
        <div>
            <h3>��¡�� QR Code</h3>
        </div>
        <div>
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>����</th>
                    <th>QR Code</th>
                    <th>�Ѵ���</th>
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
                            <?php 
                            /** rdu_qrcode.php?action=bin_pic&id=<?=$item['id'];?> */
                            ?>
                            <a href="javascript: void(0);" onclick="return confirm('�׹�ѹ���ź������?')">ź</a> | <a href="rdu_qrcode.php?page=qr&section=edit&id=<?=$item['id'];?>">���</a>
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

        $edit_id = input('edit_id');

        $db->select("SELECT * FROM `qr_pics` ORDER BY `id` DESC");
        $qr_items = $db->get_items();

        $sql = "SELECT a.*, b.`name` AS `group_name` 
        FROM `qr_drugs` AS a 
        LEFT JOIN `qr_pics` AS b ON b.`id` = a.`qr_pic_id` 
        WHERE a.`id` = '$edit_id' ";
        $db->select($sql);

        $drug_code = '';
        $qr_pic_id = '';
        $qr_drug_id = $edit_id;
        $more_txt = '';
        if( $db->get_rows() > 0 ){
            $item = $db->get_item();
            $drug_code = $item['drug_code'];
            $qr_pic_id = $item['qr_pic_id'];
            $more_txt = '������';
        }

        ?>
        <fieldset>
            <legend>������</legend>
            <div style="position: relative;">
                <form action="rdu_qrcode.php" method="post">
                    <div>
                        ������: <input type="text" name="drug_name" id="drug_name" value="<?=$drug_code;?>">
                    </div>
                    <div>
                        QR Code: <select name="qr_id" id="qr_id">
                        <?php 
                        foreach ($qr_items as $key => $qr) {

                            $selected = ( $qr_pic_id == $qr['id'] ) ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$qr['id'];?>" <?=$selected;?> ><?=$qr['name'];?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div>
                        <button type="submit">�ѹ�֡<?=$more_txt;?></button>
                        <input type="hidden" name="action" value="save_drug">
                        <input type="hidden" name="qr_drug_id" value="<?=$qr_drug_id;?>">
                    </div>
                </form>
                <div style="position: absolute; left: 0;">
                    <div id="drug_list" style="display: none; background-color: #ffffff; border: 6px solid #00ad02;"></div>
                </div>
            </div>
        </fieldset>
        <div>
            <div>
                <h3>�Ѵ��â�����</h3>
            </div>
            <?php 
            $sql = "SELECT a.*, b.`name` AS `group_name`,c.`tradname`,c.`genname`
            FROM `qr_drugs` AS a 
            LEFT JOIN `qr_pics` AS b ON b.`id` = a.`qr_pic_id` 
            LEFT JOIN `druglst` AS c ON c.`drugcode` = a.`drug_code` 
            ORDER BY a.`qr_pic_id`,a.`id` DESC";
            
            $db->select($sql);
            $drug_items = $db->get_items();
            ?>
            <table class="chk_table qr_drug_contain">
                <tr>
                    <th>#</th>
                    <th>������</th>
                    <th>�����</th>
                    <th>Trade name</th>
                    <th>General name</th>
                    <th>�Ѵ���</th>
                </tr>
            <?php
            $i=0;
            foreach ($drug_items as $key => $item) {
                ++$i;

                $bg = '';
                if( $i % 2 != 0 ){
                    $bg = 'style="background-color: #ececec;"';
                }

                ?>
                <tr <?=$bg;?> class="drug_item">
                    <td><?=$i;?></td>
                    <td><?=$item['drug_code'];?></td>
                    <td><?=$item['group_name'];?></td>
                    <td><?=$item['tradname'];?></td>
                    <td><?=$item['genname'];?></td>
                    <td>
                        <a href="rdu_qrcode.php?action=del_drug&del_id=<?=$item['id'];?>" onclick="return confirm_del_drug();">ź</a> | <a href="rdu_qrcode.php?page=drug&edit_id=<?=$item['id'];?>">���</a>
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
        .code_item:hover, .close_btn:hover{
            cursor: pointer;
        }
        </style>
        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script>

        document.getElementById('drug_name').focus();

        function confirm_del_drug(){
            var c=confirm('�׹�ѹ����ź������');
            return c;
        }

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
                        html += '<tr class="close_btn"><td colspan="3" style="text-align: center; background-color: #90ffa8;">[ �Դ ]</td></tr>';
                        html += '<tr><th>Drug Code</th><th>Trad Name</th><th>General Name</th></tr>';
                        var tb_tr = '';

                        var test_i = 1;

                        res_html.forEach(function(element){

                            var bg_tr = ''; 

                            if ( test_i % 2 != 0 ) {
                                bg_tr = 'style="background-color: #dddddd;"'; 
                            }

                            tb_tr += '<tr '+bg_tr+'>';
                            tb_tr += '<td class="code_item" data-code="'+element.drugcode+'">'+element.drugcode+'</td>';
                            tb_tr += '<td>'+element.tradname+'</td>';
                            tb_tr += '<td>'+element.genname+'</td>';
                            tb_tr += '</tr>';

                            test_i++;
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