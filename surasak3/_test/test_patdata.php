<?php 
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_patdata.php';

$p = new ClassPatdata();
// $r = $p->getPatdataFromIdno('asdf');
// dump($r);
// $r = $p->getPatdataFromIdno('1234');
// dump($r);
// $r = $p->getPatdataFromIdno('1" or 1=1"');
// dump($r);
// $r = $p->getPatdataFromIdno('  ');
// dump($r);

//#----------------------------------------------------------------
// $r = $p->getPatdataFromId('');
// dump($r);
// $r = $p->getPatdataFromId('999');
// dump($r);
// $r = $p->getPatdataFromId('1" or 1=1 #--"');
// dump($r);
// $r = $p->getPatdataFromId('9106907');
// dump($r);

//#----------------------------------------------------------------
$r = $p->insertOnlyPatdata('5075887',array('ua','cbc'));
dump($r);

// $p->mine()/;