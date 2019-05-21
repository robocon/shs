<?php 

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load($shs_configs);


include 'chk_menu.php';
    ?>
    <h3>ค้นหา ชื่อ-สกุล จาก HN</h3>
    <form action="chk_test_hn.php" method="post" enctype="multipart/form-data">
        <div>
            ไฟล์นำเข้า : <input type="file" name="file">
        </div>
        <div>
            <p><b>ตัวอย่าง รูปแบบการจัดไฟล์ Excel</b></p>
            <table class="chk_table">
                <tr>
                    <td>HN</td>
                    <td>ชื่อ</td>
                    <td>สกุล</td>
                </tr>
            </table>
        </div>
        <div>
            <button type="submit">นำเข้า</button>
            <input type="hidden" name="action" value="test">
        </div>
    </form>
    <?php 


if( $action == false ){ 
    
}elseif ( $action == 'test' ) {
    
    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);

    if( $content !== false ){
        $items = explode("\r\n", $content);
        
        ?>
        <style>
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th, 
        .chk_table td{
            border: 1px solid black;
            padding: 3px;
        }
        </style>
        <table border="1" class="chk_table">
            <tr>
                <th>#</th>
                <th>HN ตรวจสอบ</th>
                <th>ชื่อ สกุล ตรวจสอบ</th>
                <th>HN ฐานข้อมูล</th>
                <th>ชื่อ-สกุล</th>
            </tr>
        <?php

        $i = 0;
        foreach ( $items as $key => $item ) {

            list($hn, $name, $suname) = explode(',', $item,3);

            $sql = "SELECT `hn`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`, `idcard`,`sex` FROM `opcard` WHERE `hn` = '$hn' ";
            $db->select($sql);

            $user = $db->get_item();

            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$hn;?></td>
                <td><?=$name.' '.$surname;?></td>
                <td><?=$user['hn'];?></td>
                <td><?=$user['ptname'];?></td>
            </tr>
            <?php

            $i++;

        }

        ?>
        </table>
        <?php
    }
}