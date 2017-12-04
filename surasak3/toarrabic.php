<?php

include 'bootstrap.php';

$db = Mysql::load();

$numbers = array(
    '�'  => '1', '�'  => '2', '�'  => '3', '�'  => '4', '�'  => '5', 
    '�'  => '6', '�'  => '7', '�'  => '8', '�'  => '9', '�'  => '0', 
);

$sql = "SELECT `row_id`,`hn`,`idcard` FROM smdb.opcard 
WHERE idcard LIKE '%�%' 
OR idcard LIKE '%�%'
OR idcard LIKE '%�%' 
OR idcard LIKE '%�%' 
OR idcard LIKE '%�%' 
OR idcard LIKE '%�%' 
OR idcard LIKE '%�%' 
OR idcard LIKE '%�%' 
OR idcard LIKE '%�%' ";

$db->select($sql);
$items = $db->get_items();

foreach( $items as $key => $item ){
    $row_id = $item['row_id'];
    $thai_idcard = str_replace(' ', '', $item['idcard']);
    $txts = str_split($thai_idcard);

    $new_txt = '';
    foreach( $txts as $key => $val ){
        $new_txt .= $numbers[$val];
    }

    if( preg_match('/(\d){13}/', $new_txt) !== false ){

        $sql = "UPDATE `opcard`
        SET `idcard` = '$new_txt' 
        WHERE `row_id` = '$row_id';";
        $update = $db->update($sql);
        dump($update);
        
    }
    
}