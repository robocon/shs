<?php
include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT a.`hn`  
FROM `out_result_chkup` AS a 
#LEFT JOIN `resulthead` AS b ON b.`
WHERE a.`part` = 'สรีรัตน์เหมืองแร่60' ;";

$db->select($sql);
$items = $db->get_items();

foreach ($items as $key => $item) {
    
    $hn = $item['hn'];
    $sql = "SELECT `autonumber`,`profilecode` FROM `resulthead` WHERE `hn` = '$hn' ";
    $db->select($sql);
    $heads = $db->get_items();

    foreach ($heads as $head) {
        // dump($head['profilecode']);

        $autonumber = $head['autonumber'];
        $sql = "SELECT * FROM `resultdetail` WHERE `autonumber` = '$autonumber' ";
        $db->select($sql);
        $details = $db->get_items();
        foreach( $details as $detail ){
            dump($detail['labname']);
            dump($detail['result']);
            dump($detail['unit']);
            dump($detail['normalrange']);
        }
        // echo "<hr>";
    }

    // echo "<hr>";

}