<?php
include dirname(__FILE__).'/../bootstrap.php';
include dirname(__FILE__).'/../class_file/class_opd.php';

$opd = new Opd();

$a = $opd->last3MonthsFromHn('53-9604');
dump($a);