<?php
var_dump(__FILE__);
include_once dirname(__FILE__).'/../newBootstrap.php';
// include dirname(__FILE__).'/../class_file/class_opd.php';

// dump(HOST);
$classOpd = new Opd();

// $a = $classOpd->last3MonthsFromHn('53-9604');
// dump($a);

$data = array('thdatehn'=>'99-99-999947-1', 'hn'=>'47-1', 'opd_id'=>'999999');
$r = $classOpd->getBotoxFromThdatehn($data['thdatehn']);

if($r===false){
    $insert = $classOpd->insertBotox($data);
    if($insert===false){
        dump($classOpd->getError());
    }
}else{
    $update = $classOpd->updateBotox($data, $data['opd_id']);
    if($update===false){
        dump($classOpd->getError());
    }
}