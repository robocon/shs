<?php
require_once dirname(__FILE__).'/newBootstrap.php';

$op = new Opcard();
$a = $op->getByHn('58-6733');
dump($a);

// $dep = new Depart();
// $d = $dep->getDepart('2569-03-07', '49-99999');
// dump($d);

// $pat = new Patdata();
// $p = $pat->getPatdata('5510870');
// dump($p);

$drug = new Drug();
// dump($drug);
// 
// $d = $drug->findLikeDrugcode('para');
// dump($d);
// $d = $drug->getDruglst('1PARA500-N');
$hn = '54-5513';
$drugItems = array('1VOLT-C','1OMEP','1ORKE-N','4MET25','1ALFA');
dump($hn);
dump($drugItems);
$d = $drug->drugLeft($hn,$drugItems);
dump($d);