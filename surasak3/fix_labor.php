<?php 

require_once 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);

$sql = "SELECT * FROM `43labor` ORDER BY `id` ASC";
$q_labor = $dbi->query($sql);
while ($item = $q_labor->fetch_assoc()) {

    $labor_id = $item['id'];
    $ipcard_id = $item['ipcard_id'];

    $q_ipcard = $dbi->query("SELECT `date` FROM `ipcard` WHERE `row_id` = '$ipcard_id' LIMIT 1 ");
    $ipcard = $q_ipcard->fetch_assoc();

    $ipcard_date = bc_to_ad(substr($ipcard['date'], 0, 10));
    $ipcard_date = str_replace('-', '', $ipcard_date);

    $update = $dbi->query("UPDATE `43labor` SET `ipcard_date` = '$ipcard_date' WHERE `id` = '$labor_id' ");
    dump($update);
    # code...
}

