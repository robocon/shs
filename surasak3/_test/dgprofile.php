<?php
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_dgprofile.php';

$d = new Dgprofile();
$test = $d->updateAmount('1', '100');
dump($test);

$test = $d->updateSlcode('1', 'SL12345');
dump($test);