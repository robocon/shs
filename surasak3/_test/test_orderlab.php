<?php 
error_reporting(1);
ini_set('display_errors', 1);

require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_orderhead.php';
// require_once dirname(__FILE__).'/../class_file/class_orderdetail.php';
$oh = new Orderhead();

// $labnumber = $oh->getLabnumber();

$data['hn'] = '58-2733';
// $data['labnumber'] = $labnumber;
$data['patientname'] = 'กิตงาย';
$data['sex'] = 'm';
$data['dob'] = '1985-08-30';
$data['clinicalinfo'] = '00000';
$data['labitems'] = array('tissue-AFB','tissue-GMS','tissue-PAS');
$data['comment'] = 'ทดสอบ OUTLAB';
// $data['labitems'] = array('cbc','ua');
$data['clinicalinfo'] = implode(',', $data['labitems']);

$is_nhealth = '0';
foreach ($data['labitems'] as $v) {
    $a = $oh->getLabcare($v);
    if($a['labtype']=='OUT'){
        $is_nhealth = '1';
    }
}

$data['is_nhealth'] = $is_nhealth;

$insertOrderhead = $oh->insertOrderhead($data);
dump($insertOrderhead);
$orderhead_labnumber = $insertOrderhead;

$data['labnumber'] = $orderhead_labnumber['labnumber'];

$insertOrderdetail = $oh->insertOrderdetail($data);
dump($insertOrderdetail);