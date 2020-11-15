<?php 
require_once 'bootstrap.php';

$db = Mysql::load();

$action = input_get('action');
$cHn = input_get('cHn');
$dateTh = (date('Y')+543).date('-m-d');

if ($action == 'update') {
    $id = input_get('id');
    $hn = input_get('cHn');
    $sql = "UPDATE `ipcard` SET `dcdate` = '$dateTh 00:00:00' WHERE `row_id` = '$id' ";
    $update = $db->update($sql);
    ?><script>window.close();</script><?php
}

exit;