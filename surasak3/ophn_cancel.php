<?php 
require_once 'bootstrap.php';

$rowId = $_GET['id'];
$db = Mysql::load();
$sql = "SELECT * FROM `ipcard` WHERE `row_id` = '$rowId' ";
$db->select($sql);
if ( $db->get_rows() > 0 ) {

    $it = $db->get_item();
    $date = $it['date'];
    $sql = "UPDATE `ipcard` SET `dcdate` = '$date' ";
    $test = $db->exec($sql);
}

redirect('ophn.php');