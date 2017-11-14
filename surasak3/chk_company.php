<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

if( $action == false ){
    include 'chk_menu.php';
    
    if( isset($_SESSION['x-msg']) ){
        ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
        unset($_SESSION['x-msg']);
    }

    $id = input_get('id');
    $company = $company_code = $date_checkup = '';
    if( $id !== false ){
        $sql = "SELECT * FROM `chk_company_list` WHERE `id` = '$id' ";
        $db->select($sql);
        $item = $db->get_item();

        $name = $item['name'];
        $code = $item['code'];
        $date_checkup = $item['date_checkup'];
        
    }
    ?>
    <form action="chk_company.php" method="post">
        <div>
            ���ͺ���ѷ <input type="text" name="company" value="<?=$name;?>" style="width: 40%; ">
        </div>
        <div>
            ���ʺ���ѷ <input type="text" name="company_code" value="<?=$code;?>">
        </div>
        <div>
            �ѹ����Ǩ <input type="text" name="date_checkup" value="<?=$date_checkup;?>"> 
            <span style="color: red;"><u>* ��㹡���ʴ����㺾����ŵ�Ǩ�آ�Ҿ��Шӻ�</u></span>
            <div>
                <span style="color: red;">������ҧ�� 5-20 ���Ҥ� 2560</span>
            </div>
        </div>
        <div>
            <button type="submit">�ѹ�֡������</button>
            <input type="hidden" name="action" value="save">
        </div>
    </form>
    <style type="text/css">
    .chk_table ol{
        margin: 0;
        padding-left: 1em;
    }
    </style>
    <div>
        <?php
        $sql = "SELECT * FROM `chk_company_list` WHERE `status` = '1' ORDER BY `id` ASC";
        $db->select($sql);

        $items = $db->get_items();
        ?>
        <h3>��ª��ͺ���ѷ</h3>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>���ͺ���ѷ</th>
                <th>����</th>
                <th>��ǧ���ҷ���Ǩ</th>
                <th>�ͺ�է�����ҳ</th>
                <th>ŧ��/������</th>
                <th></th>
            </tr>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['name'];?></td>
                    <td><?=$item['code'];?></td>
                    <td><?=$item['date_checkup'];?></td>
                    <td align="center"><?=$item['yearchk'];?></td>
                    <td>
                        <ol>
                            <li><a href="out_result.php?part=<?=$item['code'];?>">ŧ�����ūѡ����ѵ�</a></li>
                            <li><a href="chk_report_self.php?camp=<?=$item['code'];?>">�ŵ�Ǩ��ºؤ��</a></li>
                            <li><a href="chk_report_all.php?camp=<?=$item['code'];?>">��ػ�ŵ�Ǩ</a></li>
                        </ol>
                    </td>
                    <td><a href="chk_company.php?id=<?=$item['id'];?>">���</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <?php
        ?>
    </div>
    <?php
} else if( $action == 'save' ) {
    
    $company = input_post('company');
    $company_code = input_post('company_code');
    $date_checkup = input_post('date_checkup');
    $year = get_year_checkup(true);

    $sql = "INSERT INTO `chk_company_list` ( `id`,`name`,`code`,`date_checkup`,`yearchk`,`status` ) 
    VALUES (
    NULL,'$company','$company_code','$date_checkup','$year',  '1'
    );";
    $save = $db->insert($sql);

    redirect('chk_company.php', '�ѹ�֡���������º����');
    exit;
}
?>
