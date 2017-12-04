<?php

include 'bootstrap.php';

$db = Mysql::load();

$numbers = array(
    'ñ'  => '1', 'ò'  => '2', 'ó'  => '3', 'ô'  => '4', 'õ'  => '5', 
    'ö'  => '6', '÷'  => '7', 'ø'  => '8', 'ù'  => '9', 'ğ'  => '0', 
);

$sql = "SELECT `row_id`,`hn`,`idcard` FROM smdb.opcard 
WHERE idcard LIKE '%ñ%' 
OR idcard LIKE '%ò%'
OR idcard LIKE '%ó%' 
OR idcard LIKE '%ô%' 
OR idcard LIKE '%õ%' 
OR idcard LIKE '%ö%' 
OR idcard LIKE '%÷%' 
OR idcard LIKE '%ø%' 
OR idcard LIKE '%ù%' ";

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