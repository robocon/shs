<?php

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT * FROM `smdb`.`drug_control_user`;";
$db->select($sql);
$items = $db->get_items();

foreach ($items as $key => $item) {
    $drugcode = $item['drugcode'];
    $new_min = (int) $item['min'];
    $new_max = (int) $item['max'];

    $item_id = $item['id'];

    dump($drugcode);

    if( $new_min === 0 && $new_max === 0 ){
        $sql = "SELECT `min`,`max` FROM `druglst` WHERE `drugcode` = '$drugcode'";
        $db->select($sql);
        $drug = $db->get_item();

        $old_min = (int) $drug['min'];
        $old_max = (int) $drug['max'];

        if( $old_min > 0 && $old_max > 0 ){

            $sql = "UPDATE `drug_control_user` SET 
            `min` = '$old_min', 
            `max` = '$old_max' 
            WHERE `id` = '$item_id';";
            $update = $db->update($sql);
            dump($sql);
            dump($update);

        }
        

    }

}