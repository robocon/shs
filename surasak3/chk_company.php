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
            ชื่อบริษัท <input type="text" name="company" value="<?=$name;?>" style="width: 40%; ">
        </div>
        <div>
            รหัสบริษัท <input type="text" name="company_code" value="<?=$code;?>">
        </div>
        <div>
            วันที่ตรวจ <input type="text" name="date_checkup" value="<?=$date_checkup;?>"> 
            <span style="color: red;"><u>* ใช้ในการแสดงผลในใบพิมพ์ผลตรวจสุขภาพประจำปี</u></span>
            <div>
                <span style="color: red;">ตัวอย่างเช่น 5-20 ตุลาคม 2560</span>
            </div>
        </div>
        <div>
            <button type="submit">บันทึกข้อมูล</button>
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
        <h3>รายชื่อบริษัท</h3>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>ชื่อบริษัท</th>
                <th>รหัส</th>
                <th>ช่วงเวลาที่ตรวจ</th>
                <th>รอบปีงบประมาณ</th>
                <th>ลงผล/พิมพ์ผล</th>
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
                            <li><a href="out_result.php?part=<?=$item['code'];?>">ลงข้อมูลซักประวัติ</a></li>
                            <li><a href="chk_report_self.php?camp=<?=$item['code'];?>">ผลตรวจรายบุคคล</a></li>
                            <li><a href="chk_report_all.php?camp=<?=$item['code'];?>">สรุปผลตรวจ</a></li>
                        </ol>
                    </td>
                    <td><a href="chk_company.php?id=<?=$item['id'];?>">แก้ไข</a></td>
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

    redirect('chk_company.php', 'บันทึกข้อมูลเรียบร้อย');
    exit;
}
?>
