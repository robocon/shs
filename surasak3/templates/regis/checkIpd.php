<?php

include '../../bootstrap.php';

$hn = input_post('id');
if( $hn != false ){
    DB::load();

    $sql_pre = "
    SELECT b.`my_ward` FROM `bed` AS a
    LEFT JOIN `ipcard` AS b ON b.`an` = a.`an`
    WHERE a.`hn` = :hn ;
    ";
    $item = DB::select($sql_pre, array(':hn' => $hn), true);

    $txt = '{"state":200}';
    
    // คนไข้ยังอยู่ใน ward
    if( !empty($item) ){
        $txt = '{"state":400,"msg":"'.$item['my_ward'].'"}';
    }
    header('Content-Type:text/html; charset=tis-620');
    echo $txt;
    exit;
}