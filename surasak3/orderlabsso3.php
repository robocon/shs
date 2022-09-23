<?php 
require_once 'bootstrap.php';
require_once 'OpdReceive.php';

$dbi = new mysqli(HOST,USER,PASS,DB);

$hn = $_REQUEST['hn'];
$vn = $_REQUEST['vn'];

// $lab_items = implode(',', $_REQUEST['labSelect']);
// dump($_REQUEST['labSelect']);

// $lab_items = array();
// foreach ($_REQUEST['labSelect']  as $key => $value) {
//     $lab_items[] = "'$value'";
// }

// $lab_items = implode(',', $lab_items);
// dump($lab_items);

// exit;

$a = new OpdReceive();
$a->hn = $hn;
$a->vn = $vn; 
$a->clinicalinfo = 'ตรวจสุขภาพประจำปี66';
//     // $a->custom_labnumber = '6509200301';
$a->orderLab($_REQUEST['labSelect']);

echo "บันทึกข้อมูลเรียบร้อย";