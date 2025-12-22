<?php
error_reporting(1);
ini_set('display_errors', 1);

require_once dirname(__FILE__).'/../bootstrap.php';
// require_once dirname(__FILE__).'/../class_file/class_depart.php';
require_once dirname(__FILE__).'/../class_file/class_patdata2.php';
require_once dirname(__FILE__).'/../class_file/class_opacc2.php';

$p = new ClassPatdata();
$o = new ClassOpacc();

// $d = new ClassDepart();
$id = '5165337';
$test = $p->delDepartFromRowId($id);

// $test = $d->delDepartFromRowId($id);
dump($test);
if($test===true){
    $test = $p->delPatdataFromIdno($id);
    dump($test);
}else{
    dump("ไม่เจอ $id");
}