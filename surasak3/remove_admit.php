<?php 
require_once 'bootstrap.php';

$db = Mysql::load();

/**
 * แก้หน้าออก VN ใส่เงื่อนไขเพิ่ม ถ้ามีการออก AN ค่อยแสดงเมนูยกเลิก Admit
 */
$an = input('an');
$hn = input_get('hn');
$dateTh = (date('Y')+543).date('-m-d');

$sql = "SELECT * 
FROM `ipcard` 
WHERE `hn` = '$hn' 
AND `date` LIKE '$dateTh%' ";
$db->select($sql);
$item = $db->get_item();

if( $item['bedcode'] === NULL ){
    $sql = "UPDATE `ipcard` SET `dcdate` = '$dateTh 00:00:00' WHERE `hn` = '$hn' AND `an` = '$an' ";

}elseif ($item['bedcode'] !== NULL) {
    echo "ผู้ป่วยถูกนำขึ้นเตียงเรียบร้อยแล้ว กรุณาประสานวอร์ดเพื่อทำการ D/C";
}
