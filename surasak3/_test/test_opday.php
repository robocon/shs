<?php 
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_opday.php';

$op = new Opday();

$r = $op->getThisDay('47-1');

var_dump($r);