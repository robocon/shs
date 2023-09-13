<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'bootstrap.php';
require_once 'class_file/opday.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$hn = sprintf("%s", $_GET['hn']);

$opday = new Opday();
$opdayToday = $opday->getThisDay($hn);
$test = false;
if($opdayToday===false){
    $opday->setToborow('EX16 ตรวจสุขภาพ');
    $test = $opday->createOpday($hn);
}
dump($test);