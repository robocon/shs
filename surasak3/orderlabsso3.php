<?php 
require_once 'bootstrap.php';
require_once 'class_file/OpdReceive.php';

$dbi = new mysqli(HOST,USER,PASS,DB);

$hn = $_REQUEST['hn'];
$vn = $_REQUEST['vn'];

$a = new OpdReceive();
$a->hn = $hn;
$a->vn = $vn; 
$a->clinicalinfo = 'ตรวจสุขภาพประจำปี66';
//     // $a->custom_labnumber = '6509200301';
$a->orderLab($_REQUEST['labSelect']);

echo "บันทึกข้อมูลเรียบร้อย";