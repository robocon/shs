<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'bootstrap.php';
require_once 'class_file/class_depart.php';
require_once 'class_file/class_patdata.php';
require_once 'class_file/opday.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

var_dump("EGAT-DEPART");

// $sql = "SELECT b.* 
// FROM( 
//     SELECT HN,exam_no,idcard,CONCAT(name,' ',surname) AS ptname FROM opcardchk WHERE part = 'บริษัท รักษาความปลอดภัย เอเอสเอ็ม แมเนจเมนท์ จำกัด (โรงไฟฟ้าแม่เมาะ) ส.ค.66' 
// ) AS a LEFT JOIN (
//     SELECT row_id,thidate,hn,vn,ptname FROM opday WHERE thidate LIKE '2566-08-31%'
// ) AS b ON b.hn = a.hn";
// $q = $dbi->query($sql);
// if ($q->num_rows > 0) {
//     while ($a = $q->fetch_assoc()) { 
//         dump($a);
//     }
// }

$hn = '60-1641';
$detail = 'test ตรวจสุขภาพประจำปี';
$diag = 'test diag ตรวจสุขภาพ';
$lab_items = array('ua','cbc');
$officer = 'พี่พัชรี';
$cashok = 'ผู้ปฏิบัติงาน กฟภ.';
$depart = 'PATHO';
$nLab_orderhead = '9999';

$opday = new Opday();
$opdayToday = $opday->getThisDay($hn);
if($opdayToday===false){
    $opday->createOpday($hn);
}
$test = false;

$depart = new Depart();
// $testItem = $depart->getDepart('2565-12-10', '54-2753');

// $test = $depart->insertOnlyDepart($hn, $detail, $diag, $lab_items, $officer, $cashok, $nLab_orderhead, $patho);
$patdata = new Patdata();
$test = $patdata->getPatdata('4349642');

$xray_items = array('41001');
$officer = 'จนท.xray';
$depart = 'XRAY';
// $test = $depart->insertOnlyDepart($hn, $detail, $diag, $lab_items, $officer, $cashok, $nLab_orderhead, $patho);
dump($test);

exit;
?>