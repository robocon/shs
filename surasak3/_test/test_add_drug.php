<?php 
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_drug.php';
require_once dirname(__FILE__).'/../class_file/class_ipcard.php';

$an = '68/464';
$doctor = 'MD999 หมอลืมปากกา  ไม่ใช่หมอปลอม';
$diag = 'test diag';
$doctorOrder = array(
    array('drugcode'=>'1COUM-C3','amount'=>'15','slcode'=>'1HS'),
    array('drugcode'=>'1COUM-C2','amount'=>'25','slcode'=>'1hssat sun'),
    array('drugcode'=>'1COUM-C1','amount'=>'10','slcode'=>'1*1')
);

$ipClass = new Ipcard();
$ip = $ipClass->getIpcard($an);


$d = new Drug();
// $chktranx = $d->setNewRunno();
$chktranx = '0000000001';
$date = $d->getThDateTime();

$officer = $d->getOfficer();
$items = $d->getItemsFromCode($doctorOrder);
$item = $d->getItem();
$dphardepPrice = $d->setPriceDruglst($doctorOrder);
$d->setSlCodeDruglst($doctorOrder);

$dphardepData = array(
'chktranx'=>$chktranx,
'date'=>$date,
'ptname'=>$ip['ptname'],
'hn'=>$ip['hn'],
'price'=>$dphardepPrice,
'doctor'=>$doctor,
'item'=>$item,
'idname'=>$officer,
'diag'=>$diag,
'essd'=>'',
'nessdy'=>'',
'nessdn'=>'',
'dpy'=>'',
'dpn'=>'',
'dsy'=>'',
'dsn'=>'',
'tvn'=>'',
'ptright'=>'',
'whokey'=>'',
'kew'=>''
);
dump($dphardepData);