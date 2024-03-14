<?php
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_xray.php';
// require_once dirname(__FILE__).'/../class_file/class_opday.php';
// require dirname(__FILE__).'/../class_file/class_opcard.php';

$hn = '65-6173';
$stanceList = array('CXR','CHEST CHECK UP');
$xray = new Xray();
$xray->officer = 'ทดสอบระบบ';
$xray->digital = 1;
$test = $xray->addXrayOnlyItem($hn, $stanceList);

var_dump($test);

// $opday = new Opday();
// $test = $opday->getThisDay('49-1366');
// dump($test);

// $opcard = new Opcard();
// $test = $opcard->getByHn('49-1366');
// dump($test);