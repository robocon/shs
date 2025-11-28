<?php
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_diabetes.php';

$d = new Diabetes();

$r = $d->data('\\test');
dump($r);
$r = $d->getState();
dump($r);
$r = $d->getError();
dump($r);