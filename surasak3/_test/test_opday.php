<?php
include dirname(__FILE__).'/../bootstrap.php';
include dirname(__FILE__).'/../class_file/class_opday.php';

$opday = new Opday();

$a = $opday->last3MonthsFromHn('53-9604');
dump($a);