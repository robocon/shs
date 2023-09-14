<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_depart.php';
require_once 'class_file/class_patdata.php';
require_once 'class_file/class_opacc.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$depart_id = sprintf("%s", $_GET['depart_id']);
$new_lab = sprintf("%s", $_GET['new_lab']);
$vn = sprintf("%s", $_GET['vn']);

dump($depart_id);
dump($new_lab);
dump($vn);

$dep = new ClassDepart();
$item = $dep->getDepartFromId($depart_id);
dump($item);