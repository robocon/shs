<?php 

include '../bootstrap.php';

$db = Mysql::load();
$idcard = input_post('idcard');

if( $idcard === false ){
    echo '{"findStatus":404}';
    exit;
}

$sql = "SELECT `hn` FROM `opcard` WHERE `idcard` = '$idcard' ";
$db->select($sql);

if( $db->get_rows() > 0 ){
    $item = $db->get_item();
    echo '{"findStatus":200, "hn": "'.$item['hn'].'"}';
}else{
    echo '{"findStatus":404}';
}