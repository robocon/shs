<?php

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT * 
FROM  `dxofyear_out` 
WHERE `thdatehn` LIKE '2016%' 
AND `hn` IN ('59-6889',
'57-5576',
'57-5571',
'59-6884',
'59-6932',
'57-5577',
'57-5578',
'57-5584',
'57-5581',
'57-5574',
'57-5573',
'57-5572',
'59-6891',
'57-5585',
'59-7049')";

$db->select($sql);
$items = $db->get_items();
// dump($items);
foreach ($items as $key => $item) {

    $id = $item['row_id'];
    $sql = "UPDATE `dxofyear_out` 
    SET `camp` = '´ÑºàºÔéÅÇÔ§' 
    WHERE `row_id` = '$id';"; 
    // dump($sql);
    $update = $db->update($sql);
    dump($update);
}