<?php 

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();
// $db = Mysql::load();

include 'chk_menu.php';
    ?>
    <h3>ค้นหา ชื่อ-สกุล จากเลขบัตรประชาชน</h3>
    <form action="chk_test_ipcard.php" method="post" enctype="multipart/form-data">
        <div>
            ไฟล์นำเข้า : <input type="file" name="file">
        </div>
        <div>
            <p><b>ตัวอย่าง รูปแบบการจัดไฟล์ Excel</b></p>
            <table class="chk_table">
                <tr>
                    <td>เลขบัตรประชาชน</td>
                    <td>ชื่อ</td>
                    <td>สกุล</td>
                </tr>
            </table>
        </div>
        <div>
            <button type="submit">ตรวจสอบตามเลขบัตร</button>
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
                <th colspan="9">ข้อมูลจากฐานข้อมูล</th>
            </tr>
            <tr>
                <th>เลขบัตรประชาชน</th>
                <th>ชื่อ</th>
                <th>สกุล</th>
                <th>เลขบัตรประชาชน</th>
                <th>คำนำหน้า</th>
                <th>ชื่อ</th>
                <th>สกุล</th>
                <th>HN</th>
                <th>อายุปัจจุบัน</th>
                <th>วันเกิด</th>
                <th>หมายเหตุ</th>
                <th></th>
            </tr>
        <?php

        $i = 0;
        foreach ( $items as $key => $item ) {

            list($idcard, $name, $surname) = explode(',', $item);
            // dump($idcard);
            $name = iconv('TIS620', 'UTF8', $name);
            $surname = iconv('TIS620', 'UTF8', $surname);
            // dump($name);
            // dump($surname);

            $idcard = trim($idcard);
            if( !empty($idcard) ){

                ++$i;
            
                $sql = "SELECT `hn`,`yot`,`name`,`surname`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`, `idcard`,`sex`, idguard, idguard2, 
                `dbirth`, TIMESTAMPDIFF(YEAR,toEn(`dbirth`),NOW()) AS `age`
                FROM `opcard` 
                WHERE `idcard` = '$idcard' ";
                $db->select($sql);
                $user = $db->get_item();
                
                $color = '';

                // if( $name != $user['name'] ){
                //     $color = 'style="background-color: yellow;"';
                // }

                // if( $surname != $user['surname'] ){
                //     $color = 'style="background-color: yellow;"';
                // }

                ?>
                <tr <?=$color;?>>
                    <td><?=$i;?></td>
                    <td><?=$idcard;?></td>
                    <td><?=$name;?></td>
                    <td><?=$surname;?></td>
                    <td><?=$user['idcard'];?></td>
                    <td><?=$user['yot'];?></td>
                    <td><?=$user['name'];?></td>
                    <td><?=$user['surname'];?></td>
                    <td><?=$user['hn'];?></td>
                    <td><?=$user['age'];?></td>
                    <td><?=$user['dbirth'];?></td>
                    <td><?=$user['idguard'];?></td>
                    <td><?=$user['idguard2'];?></td>
                </tr>
                <?php
            }

        }
        ?>
        </table>
        <?php
    }
}