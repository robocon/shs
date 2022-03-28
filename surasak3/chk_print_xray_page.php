<?php
// require 'bootstrap.php';
function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}
$dbi = new mysqli('192.168.131.250','remoteuser','','smdb');

$company = $_REQUEST['company'];
$sql = "SELECT * FROM opcardchk WHERE part = '$company' ";
$q = $dbi->query($sql);
while ($a = $q->fetch_assoc()) {
    dump($a);
    # code...
}