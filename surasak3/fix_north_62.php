<?php 
include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT `labnumber` 
FROM `chk_lab_items` 
WHERE `part` = '¹ÍÃì¸à·ÔÃì¹62' 
AND `item_sso` != 'bs'  ";

$db->select($sql);

$items = $db->get_items();

foreach ($items as $key => $item) {
    
    // $sql = "";

    $labnumber = $item['labnumber'];

    dump($labnumber);

    $db->select("SELECT * FROM `orderdetail` WHERE `labnumber` = '$labnumber' AND `labcode` = 'BS' ");
    $lab_details = $db->get_item();

    if( $lab_details != NULL ){
        dump($lab_details);

        $delete = $db->delete("DELETE FROM `orderdetail` WHERE `labnumber` = '$labnumber' AND `labcode` = 'BS' LIMIT 1");
            dump($delete);
    }
    
    // foreach ($lab_details as $key => $det) {

        // $delete = '';
        // dump($det);
        // if( $det['labcode'] == 'BS' ){
            // $delete = $db->delete("DELETE FROM `orderdetail` WHERE `labnumber` = '$labnubmer' AND `labcode` = 'BS' LIMIT 1");
            // dump($delete);
        // }

        // dump($labnubmer);
        // dump($delete);



    // }


    echo "<hr>";


}