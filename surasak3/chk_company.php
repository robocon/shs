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
    ?>
    <form action="chk_company.php" method="post">
        <div>
            ชื่อบริษัท <input type="text" name="company">
        </div>
        <div>
            รหัสบริษัท <input type="text" name="company_code">
        </div>
        <div>
            <button type="submit">บันทึกข้อมูล</button>
            <input type="hidden" name="action" value="save">
        </div>
    </form>
    <div>
        <?php
        $sql = "SELECT * FROM `chk_company_list` WHERE `status` = '1' ORDER BY `id` DESC";
        $db->select($sql);

        $items = $db->get_items();
        ?>
        <h3>รายชื่อบริษัท</h3>
        <table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff">
            <tr>
                <th>#</th>
                <th>ชื่อบริษัท</th>
                <th>รหัส</th>
                <th>ปีงบประมาณ</th>
            </tr>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['name'];?></td>
                    <td><?=$item['code'];?></td>
                    <td align="center"><?=$item['yearchk'];?></td>
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
    $year = get_year_checkup(true);

    $sql = "INSERT INTO  `chk_company_list` (  `id` ,  `name` ,  `code` ,  `yearchk` ,  `status` ) 
    VALUES (
    NULL,  '$company',  '$company_code',  '$year',  '1'
    );";
    $save = $db->insert($sql);

    redirect('chk_company.php', 'บันทึกข้อมูลเรียบร้อย');
    exit;
}
?>
