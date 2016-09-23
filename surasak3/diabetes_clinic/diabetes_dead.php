<?php

include '../bootstrap.php';

$db = Mysql::load();

// àºÒËÇÒ¹
$sql = "SELECT a.`row_id`,a.`hn` 
FROM `diabetes_clinic` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE b.`idguard` LIKE 'MX04%'";

$db->select($sql);
$items = $db->get_items();
foreach( $items as $key => $item ){

    $id = $item['row_id'];
    $sql = "DELETE FROM `diabetes_clinic`
    WHERE `row_id` = :row_id ;
    ";
    $db->delete($sql, array(':row_id' => $id));
}

// ¤ÇÒÁ´Ñ¹
$sql = "SELECT a.`row_id`,a.`hn` 
FROM `hypertension_clinic` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE b.`idguard` LIKE 'MX04%'";

$db->select($sql);
$items = $db->get_items();
foreach( $items as $key => $item ){

    $id = $item['row_id'];
    $sql = "DELETE FROM `hypertension_clinic`
    WHERE `row_id` = :row_id ;
    ";
    $db->delete($sql, array(':row_id' => $id));
}