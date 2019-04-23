<?php 

include 'bootstrap.php';

$shs_configs = array(
    'host' => '192.168.1.2',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'remoteuser',
    'pass' => ''
);

$db = Mysql::load($shs_configs);

/*
SELECT * 
FROM `patdata`WHERE 
`date` LIKE '2562-03%' 
AND `code` LIKE 'E-%' 
AND `depart` = 'PATHO' 
AND `status` = 'Y' 
GROUP BY `idno`
*/

// หาจากตัวต้นตอก่อน
$sql = "SELECT `date`,`hn` FROM `patdata`WHERE 
`date` LIKE '2562-03%' 
AND `code` = 'E-EKG' 
AND `depart` = 'PATHO' 
AND `status` = 'Y' 
GROUP BY `idno` ";
$db->select($sql);
$items = $db->get_items();

exit;

foreach ($items as $key => $value) {

    $date = $value['date'];
    $hn = $value['hn'];

    dump($date);
    dump($hn);

    dump("OPACC");
    $sql = "SELECT `row_id` FROM `opacc` WHERE `txdate` = '$date' AND `hn` = '$hn' AND `depart` = 'PATHO' ";
    $db->select($sql);
    $test_rows = $db->get_rows();
    if ( $test_rows > 0 ) {
        
        $opc = $db->get_item();
        $id = $opc['row_id'];

        $sql = "UPDATE `opacc` SET `depart` = 'EMER', `detail` = 'ค่าบริการทางการแพทย์' WHERE `row_id` = '$id' ";
        dump($sql);
        $db->update($sql);

    }

    dump("DEPART");
    $sql = "SELECT `row_id` FROM `depart` WHERE `date` = '$date' AND `hn` = '$hn' AND `depart` = 'PATHO' ";
    $db->select($sql);
    $test_rows = $db->get_rows();
    if ( $test_rows > 0 ) {

        $dep = $db->get_item();
        $id = $dep['row_id'];
        
        $sql = "UPDATE `depart` SET `depart` = 'EMER', `detail` = 'ค่าบริการทางการแพทย์' WHERE `row_id` = '$id' ";
        dump($sql);
        $db->update($sql);

    }

    dump("PATDATA");
    $sql = "SELECT `row_id` FROM `patdata` WHERE `date` = '$date' AND `hn` = '$hn' AND `depart` = 'PATHO' ";
    $db->select($sql);
    $test_rows = $db->get_rows();
    if ( $test_rows > 0 ) {

        $pat_items = $db->get_items();
        foreach ($pat_items as $pat_key => $item) {

            $id = $item['row_id'];
        
            $sql = "UPDATE `patdata` SET `depart` = 'EMER' WHERE `row_id` = '$id' ";
            dump($sql);
            $db->update($sql);

        }

    }

    echo "<hr>";

}