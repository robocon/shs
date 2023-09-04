<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'bootstrap.php';
require_once 'class_file/class_depart.php';
require_once 'class_file/class_patdata.php';
require_once 'class_file/class_opacc.php';
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
$lab_items = array('CBC-sso','UA-sso','CR','BS','LIPID');
$officer = 'พี่พัชรี';
$cashok = 'ผู้ปฏิบัติงาน กฟภ.';
$depart = 'PATHO';
$nLab_orderhead = '9999';
$date = '2566-12-10';

$opday = new Opday();
$opdayToday = $opday->getThisDay($hn);
if($opdayToday===false){
    $opday->createOpday($hn);
}
$test = false;

$departObj = new ClassDepart();
// $testItem = $depart->getDepart('2565-12-10', '54-2753');

// 
// $departId = $departObj->insertOnlyDepart($hn, $detail, $diag, $lab_items, $officer, $cashok, $nLab_orderhead, $patho);
// dump($departId);

// $departId = '4407111';
$patdata = new ClassPatdata();
// $test = $patdata->getPatdata('4407111');
// $insertPatdata = $patdata->insertOnlyPatdata($departId, $lab_items);
// dump($insertPatdata);


$xray_items = array('41001');
$officer = 'จนท.xray';
$depart = 'XRAY';
// $departId = $departObj->insertOnlyDepart($hn, $detail, $diag, $xray_items, $officer, $cashok, $nLab_orderhead, $patho);
// dump($departId);
// $departId = '4407112';
// $test = $patdata->getPatdata('4407112');
// $insertPatdata = $patdata->insertOnlyPatdata($departId, $xray_items);
// dump($insertPatdata);

$opacc = new ClassOpacc();
// $test = $opacc->getOpacc($date, $hn);
dump($test);

exit;
?>