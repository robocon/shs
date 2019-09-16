<?php 
include 'bootstrap.php';

$db = Mysql::load();
$action = input('action');
$page = input_get('page');

if ( $action == 'save' ) {
    
    $company = input_post('company');
    $id = input_post('id');
    $date_checkup = input_post('date_checkup');

    $number = rand(19999,99999);
    $company_code = 'checkup_solider_'.$number;

    $msg = "�ѹ�֡���������º����";

    if( $id > 0 ){
        $sql = "UPDATE `chk_company_list`
        SET
        `name` = '$company',
        `date_checkup` = '$date_checkup'
        WHERE `id` = '$id';";
        $save = $db->update($sql);

        if( $save !== true ){
            $msg = errorMsg('save', $save['id']);
        }

    }else{

        $sql = "SELECT `id` FROM `chk_company_list` WHERE `code` = '$company_code'";
        $db->select($sql);
        $chk_row = $db->get_rows();

        $year = get_year_checkup(true);

        if( $chk_row == 0 ){
            $sql = "INSERT INTO `chk_company_list` ( `id`,`name`,`code`,`date_checkup`,`yearchk`,`status`,`report` ) 
            VALUES (
            NULL,'$company','$company_code','$date_checkup','$year','1',''
            );";
            $save = $db->insert($sql);

            if( $save !== true ){
                $msg = errorMsg('save', $save['id']);
            }
        }
        
    }
    
    redirect('pm_shs.php', $msg);
    exit;

}elseif ($action==='save_users') {

    $id = $_POST['id'];
    $part = input_post('part');

    foreach ($id as $key => $user_id) {
        
        $hn = $_POST['HN'][$user_id];
        $exam_no = $_POST['exam_no'][$user_id];
        $name = $_POST['name'][$user_id];
        $surname = $_POST['surname'][$user_id];

        $sql = "UPDATE `opcardchk` SET 
        `HN`='$hn', 
        `exam_no`='$exam_no', 
        `name`='$name', 
        `surname`='$surname' 
        WHERE `row`='$user_id' AND `part` = '$part' 
        LIMIT 1";

        $db->update($sql);

    }

    redirect('pm_shs.php?page=edit_user&part='.$part, '�ѹ�֡���������º����');
    exit;
}elseif ( $action === 'del_user' ) {
    
    $id = input_get('id');
    $part = input_get('part');

    $sql = "DELETE FROM `opcardchk` WHERE `row` = '$id' AND `part` = '$part' ";
    $db->delete($sql);

    redirect('pm_shs.php?page=edit_user&part='.$part, '�Ѵ��â��������º����');
    exit;
}





?>
<style>
/* ���ҧ */
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
</style>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;˹����ѡ�.�.</a> | <a href="pm_shs.php">˹���á�����ʵԡ����</a>
</div>

<?php
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}

if(empty($page)){

    list($py,$pm,$md) = explode('-', date('Y-m-d'));
    $date_checkup = $md.' '.$def_fullm_th[$pm].' '.($py+543);

    $id = input_get('id', 0);
    if( $id > 0 ){
        $sql = "SELECT * FROM `chk_company_list` WHERE `id` = '$id' ";
        $db->select($sql);
        $item = $db->get_item();
    
        $name = $item['name'];
        $date_checkup = $item['date_checkup'];
        
    }
    ?>

    <fieldset>
        <legend>��������ѷ����</legend>
        <form action="pm_shs.php" method="post">
            <div>
                ���ͺ���ѷ : <input type="text" name="company" value="<?=$name;?>" style="width: 40%; ">
            </div>
            <div>
                �ѹ����Ǩ : <input type="text" name="date_checkup" value="<?=$date_checkup;?>"> 
            </div>
            <div>
                <button type="submit">�ѹ�֡������</button>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?=$id;?>">
            </div>
        </form>
    </fieldset>

    <?php 

    $sql = "SELECT * FROM `chk_company_list` WHERE `code` LIKE 'checkup_solider%' AND `status` = '1' ORDER BY `id` ASC";
    $db->select($sql);
    $chk_rows = $db->get_rows();
    if ( $chk_rows > 0 ) {

        ?>
        <div>
            <h3>��ª���˹��§ҹ</h3>
        
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>���ͺ���ѷ</th>
                    <th>���������������</th>
                    <th>�ѹ����Ǩ</th>
                    <th>�Ѵ���</th>
                </tr>
            <?php

            $items = $db->get_items();
            $i = 0;
            foreach ($items as $key => $item) {
                ++$i;
                ?>

                <tr valign="top">
                    <td><?=$i;?></td>
                    <td><?=$item['name'];?></td>
                    <td><?=$item['code'];?></td>
                    <td><?=$item['date_checkup'];?></td>
                    <td>
                        <ul>
                            <li>
                                <a href="pm_shs.php?id=<?=$item['id'];?>">��䢪���˹��§ҹ</a>
                            </li>
                            <li>
                                <a href="pm_shs.php?page=edit_user&part=<?=$item['code'];?>">�����ª��ͼ����ҵ�Ǩ</a>
                            </li>
                            <li>
                                <a href="pm_upload.php?part=<?=$item['code'];?>">������ª��ʹ��� CSV</a>
                            </li>
                            <li>
                                <a href="chk_lab_sticker.php?part=<?=$item['code'];?>" target="_blank">�����ʵԡ����</a>
                            </li>
                        </ul>
                    </td>
                </tr>

                <?php
            }
            ?>
            </table>
        </div>
        <?php 
    }

}elseif ($page=='edit_user') {

    $part = input_get('part');
    $sql = "SELECT * FROM `chk_company_list` WHERE `code` LIKE '$part'";
    $db->select($sql);
    $chk_rows = $db->get_rows();

    if ( $chk_rows > 0 ) { 

        $company = $db->get_item();
        
        $sql = "SELECT * FROM `opcardchk` WHERE `part` = '$part' ORDER BY `row` ASC";
        $db->select($sql);
        $items = $db->get_items();

        ?> 
        <h3>��ª��� <?=$company['name'];?></h3>
        <form action="pm_shs.php" method="post">
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>�Ţ�Ż</th>
                    <th>�Ȫ���</th>
                    <th>ʡ��</th>
                    <th>�Ѵ���</th>
                </tr>
            
            <?php
            $i = 0;
            foreach ($items as $key => $item) {
                ++$i;

                $id = $item['row'];
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><input type="text" name="HN[<?=$id;?>]" id="" value="<?=$item['HN'];?>"></td>
                    <td><input type="text" name="exam_no[<?=$id;?>]" id="" value="<?=$item['exam_no'];?>"></td>
                    <td><input type="text" name="name[<?=$id;?>]" id="" value="<?=$item['name'];?>"></td>
                    <td><input type="text" name="surname[<?=$id;?>]" id="" value="<?=$item['surname'];?>"></td>
                    <td>
                        <a href="pm_shs.php?action=del_user&id=<?=$id;?>&part=<?=$part;?>" onclick="return confirm_user();">ź</a>

                        <input type="hidden" name="id[]" value="<?=$id;?>">
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <div>
                <button type="submit">�ѹ�֡������</button>
            </div>
            <input type="hidden" name="action" value="save_users">
            <input type="hidden" name="part" value="<?=$part;?>">
        </form>
        <script>
            function confirm_user(){
                var c=confirm('�׹�ѹ���ź������?');
                return c;
            }
        </script>
        <?php
    }


    exit;
}