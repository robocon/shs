<?php 
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_depart.php';

$d = new ClassDepart();
// $r = $d->startRunno();
// $r = $d->getDepartFromId('5075856');d
// $r = $d->getDepart('2567-11-09','63-1092');

// $r = $d->insertOnlyDepart(
//     '61-147',
//     'test detail',
//     'test diag',
//     array('ua','cbc'),
//     'test Officer',
//     'เงินสด',
//     '9999',
//     'PATHO'
// );

// $r = $d->setDepartManual(array('ptname'=>'ทดสอบ ใหม่', 'doctor'=>'หมอหน่วง'),'5075888');

// $r = $d->updateDepartFromList(array('uaxx','bs','hba1c'), '5075888', array('ptname'=>'ทดสอบ ใหม่2', 'doctor'=>'หมอหน่วง2'));
var_dump($r);


echo '<br><br>say something';