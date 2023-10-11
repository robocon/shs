<?php
require_once 'bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_appoint.php';

$app = new Appoint();
$date = '2566-10-10';
// $date = '';
$res = $app->getDisAppoint($date);
dump($res);