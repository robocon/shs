<?php

include 'bootstrap.php';

$idcard = input_post('idcard');

$db = Mysql::load();
$sql = "SELECT `row_id`,`hn`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `idcard` = '$idcard' ";
$db->select($sql);

$item = $db->get_item();
$txt = '{"state":200}';
if( count($item) > 0 ){
    $txt = '{"state":400, "hn":"'.$item['hn'].'", "name":"'.$item['ptname'].'"}';
}

header('Content-Type:text/html; charset=tis-620');
echo $txt;
exit;