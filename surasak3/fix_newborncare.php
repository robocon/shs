<?php 

require_once 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);

$q_newborn = $dbi->query("SELECT * FROM `43newborncare` WHERE `PID` IS NULL OR `PID` = '' ORDER BY `id` ASC");
while ($item = $q_newborn->fetch_assoc()) {

    $newborn_id = $item['id'];
    $CID = $item['CID'];

    $sql_opcard = "SELECT `hn` FROM `opcard` WHERE `idcard` = '$CID' LIMIT 1 ";
    $q_opcard = $dbi->query($sql_opcard);

    if($q_opcard->num_rows > 0)
    {
        $opcard = $q_opcard->fetch_assoc();
        $hn = $opcard['hn'];

        $sql_newborn_update = "UPDATE `43newborncare` SET `PID` = '$hn' WHERE `id` = '$newborn_id' ";
        $update =$dbi->query($sql_newborn_update);
        dump($update);

        // dump($sql_newborn_update);
    }
}
