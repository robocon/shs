<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_drugreact.php';

$hn = '47-4661';
$hn = '47-1';

$d = new Drugreact();
$res = $d->getDrugreactFromHn($hn);
var_dump($res);