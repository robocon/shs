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
            <button type="submit">ตรวจสอบตาม HN</button>
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
        <table class="chk_table">
            <tr>
                <th rowspan="2">#</th>
                <th colspan="3">ข้อมูลที่ตรวจสอบ</th>
                <th colspan="4">ข้อมูลจากฐานข้อมูล</th>
            </tr>
            <tr>
                <th>HN</th>
                <th>ชื่อ</th>
                <th>สกุล</th>
                <th>HN</th>
                <th>ชื่อ</th>
                <th>สกุล</th>
                <th>เลขบัตรประชาชน</th>
            </tr>
        <?php

        $i = 0;
        foreach ( $items as $key => $item ) {

            list($hn, $name, $surname) = explode(',', $item,3);

            if( !empty($hn) ){

                ++$i;

                $sql = "SELECT `hn`,`name`,`surname`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`, `idcard`,`sex` FROM `opcard` WHERE `hn` = '$hn' ";
                $db->select($sql);
                $user = $db->get_item();

                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$hn;?></td>
                    <td><?=$name;?></td>
                    <td><?=$surname;?></td>
                    <td><?=$user['hn'];?></td>
                    <td><?=$user['name'];?></td>
                    <td><?=$user['surname'];?></td>
                    <td><?=$user['idcard'];?></td>
                </tr>
                <?php
            }
        }
        ?>
        </table>
        <?php
    }
}