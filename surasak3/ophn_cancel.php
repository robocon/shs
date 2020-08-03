<?php 
require_once 'bootstrap.php';

$rowId = $_GET['id'];
$db = Mysql::load();
$sql = "SELECT * FROM `ipcard` WHERE `row_id` = '$rowId' ";
$db->select($sql);
if ( $db->get_rows() > 0 ) {

    $it = $db->get_item();
    $date = $it['date'];
    $row_id = $it['row_id'];
    $sql = "UPDATE `ipcard` SET `dcdate` = '$date' WHERE `row_id` = '$row_id' ";
    $test = $db->exec($sql);
    
}

redirect('ophn.php');