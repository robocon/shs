<?php

include 'bootstrap.php';

$db = Mysql::load();
$sql = "SHOW FULL PROCESSLIST";
$db->select($sql);
$items = $db->get_items();
dump($items);