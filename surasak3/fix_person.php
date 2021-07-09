<?php 

require_once 'bootstrap.php';
define(HOST, 'localhost');
define(USER, 'root');
define(PASS, '1234');
define(DB, 'smdb');

$dbi = new mysqli(HOST, USER, PASS, DB);

$sql = "SELECT `row_id`,`yot`,`hn` FROM `opcard` WHERE `hn` LIKE '60%' AND ( `yot` = 'พลทหาร' OR `yot` = 'นางสาว' ) ";
$q_opcard = $dbi->query($sql);

while ($item = $q_opcard->fetch_assoc()) {
    
    $opcard_id = $item['row_id'];
    $opcard_hn = $item['hn'];

    if($item['yot'] == 'พลทหาร')
    {
        $prename = 'พลฯ';
    }
    elseif ($item['yot'] == 'นางสาว') {
        $prename = 'น.ส.';
    }

    $sql_update = "UPDATE `opcard` SET `yot` = '$prename' WHERE `row_id` = '$opcard_id' ";
    $update_opcard = $dbi->query($sql_update);
    var_dump($opcard_id);
    var_dump($update_opcard);
    if($update_opcard===true)
    {
        $sql_person = "SELECT `id` FROM `PERSON` WHERE `hn` = '$opcard_hn' ";
        $q_person = $dbi->query($sql_person);
        if($q_person->num_rows > 0)
        {
            $person = $q_person->fetch_assoc();
            $person_id = $person['id'];

            $sql_update = "UPDATE `PERSON` SET `PRENAME` = '$prename' WHERE `id` = '$person_id' ";
            $update_person = $dbi->query($sql_update);
            var_dump($person_id);
            var_dump($update_person);
        }

    }

    echo "<hr>";

}














