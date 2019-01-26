<?php 


include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT * 
FROM `opcardchk` 
WHERE `part` = 'มหาวิทยาลัยสวนดุสิต62'";
$db->select($sql);

$items = $db->get_items();

foreach ($items as $key => $item) {

    $id = $item['exam_no'];
    dump($id);

    $sql = "DELETE FROM `orderhead` WHERE `labnumber` = '$id' LIMIT 1";
    $del_head = $db->delete($sql);
    dump($del_head);

    $sql = "DELETE FROM `orderdetail` WHERE `labnumber` = '$id'";
    $del_detail = $db->delete($sql);
    dump($del_detail);

}