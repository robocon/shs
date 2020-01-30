<?php 

include '../bootstrap.php';

$db = Mysql::load();
$hn = input_post('hn');

if( $hn === false ){
    echo '{"findStatus":404}';
    exit;
}

$sql = "SELECT `hn`,`idcard`,`yot`,CONCAT(`name`,' ',`surname`) AS `ptname`,`dbirth` FROM `opcard` WHERE `hn` = '$hn' ";
$db->select($sql);

if( $db->get_rows() > 0 ){
    $item = $db->get_item();
    $hn = $item['hn'];
    $idcard = $item['idcard'];
    $yot = $item['yot'];
    $ptname = $item['ptname'];
    $dbirth = $item['dbirth'];

    $db->select("SELECT `an` FROM `ipcard` WHERE `hn` = '$hn' ");
    $ipc = $db->get_item();

    $an = $ipc['an'];

    echo '{"findStatus":200, "hn": "'.$hn.'", "yot": "'.$yot.'", "ptname":"'.$ptname.'", "idcard":"'.$idcard.'", "dbirth":"'.$dbirth.'", "an":"'.$an.'"}';
}else{
    echo '{"findStatus":404}';
}