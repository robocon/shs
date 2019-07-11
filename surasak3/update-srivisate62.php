<?php 

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT * FROM `opcardchk` WHERE `part` = 'ÈÃÕÇÔàÈÉ62' ";
$db->select($sql);

$items = $db->get_items();
// dump($items);
foreach ($items as $key => $item) {

    $hn = $item['HN'];
    $opcardchk_ptname = $item['name'].' '.$item['surname'];

    $sql = "SELECT * 
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND ( `labnumber` LIKE '620710%' OR `labnumber` LIKE '620711%' ) ";

    $db->select($sql);
    $head_list = $db->get_items();
    
    foreach ($head_list as $i => $res) {

        if( $res['patientname'] != $opcardchk_ptname ){ 

            // dump($res['patientname']);
            // dump($opcardchk_ptname);

            $autonumber = $res['autonumber'];
            list($test_name, $test_surname) = explode(' ', $res['patientname']);

            $sql = "SELECT `HN`,CONCAT(`name`,' ',`surname`) AS `test_ptname` FROM `opcardchk` WHERE `part` = 'ÈÃÕÇÔàÈÉ62' AND `name` = '$test_name' AND `surname` = '$test_surname' ";
            $db->select($sql);
            $test = $db->get_item();
            $new_hn = $test['HN'];

            $sql = "UPDATE `resulthead` SET `hn` = '$new_hn' WHERE `autonumber` = '$autonumber' ";
            dump($sql);
            $update = $db->update($sql);
            dump($update);
        }

    }

    echo "<hr>";
}