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

// 
// SELECT hn, GROUP_CONCAT(item_sso) FROM `chk_lab_items` where part = 'เทศบาลเมืองเขลางค์นคร 66 ก.ย.' group by hn;


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
$detail = 'ค่าตรวจวิเคราะห์โรค';
$diag = 'ตรวจสุขภาพ';
$lab_items = array('CBC-sso','UA-sso','CR','BS','LIPID');
$officer = 'พัชรี คำฟู';
$cashok = 'กฟผ';
$depart = 'PATHO';
$nLab_orderhead = '9999';
$date = '2566-12-10';

$opday = new Opday();
$opdayToday = $opday->getThisDay($hn);
if($opdayToday===false){
    $opday->createOpday($hn);
}
$test = false;

$testDepartIdList = array();

$departObj = new ClassDepart();
// $testItem = $depart->getDepart('2565-12-10', '54-2753');

// 
// $testDepartId = $departObj->insertOnlyDepart($hn, $detail, $diag, $lab_items, $officer, $cashok, $nLab_orderhead, $patho);
// dump($testDepartId);

$testDepartId = '4580576';
$departIdList[] = $departId;
$patdata = new ClassPatdata();
// $test = $patdata->getPatdata('4407111');
// $insertPatdata = $patdata->insertOnlyPatdata($departId, $lab_items);
// dump($insertPatdata);


$xray_items = array('41001');
$officer = 'เมธินี พลเมฆ';
$depart = 'XRAY';
// $departId = $departObj->insertOnlyDepart($hn, $detail, $diag, $xray_items, $officer, $cashok, $nLab_orderhead, $patho);
// dump($departId);
$departId = '4580576';
$departIdList[] = $departId;
// $test = $patdata->getPatdata('4407112');
// $insertPatdata = $patdata->insertOnlyPatdata($departId, $xray_items);
// dump($insertPatdata);

$opacc = new ClassOpacc();
// $test = $opacc->getOpacc($date, $hn);
// $detail = 'ค่าตรวจวิเคราะห์โรค';
$officer = 'นางสาว พวงเพ็ชร หอมแก่นจันทร์';
$credit = 'กฟผ';
// $test = $opacc->insertOpacc($departIdList, $detail, $officer, $credit);
// dump($test);

$data = array(
    'price' => '199.98',
    'sumyprice' => '99.99',
    'sumnprice' => '99,99',
    'paid' => '199.98',
    'idname'=>'วนิดา v3233'
);





$testDepartId = '4657498';

// $res = $departObj->setDepartManual($data, $testDepartId);
// dump($res);
$updateItem = array('BS','LIPID','CR','LFT',);
// $fieldUpdate = array('detail' =>'ทดสอบค่าบริการ');
// $testRes = $departObj->updateDepartFromList($updateItem, $testDepartId, $fieldUpdate);
// dump($testRes);

// $testRes = $departObj->getPrice($updateItem);
// dump($testRes);


// $itemFromPatdata = $patdata->getPatdata($testDepartId);
// // dump($itemFromPatdata);
foreach ($updateItem as $key => $value) { 

    $pat = $patdata->getDataFromIdnoAndCode($testDepartId, $value, array('row_id'));
    $lab = $departObj->getLabcareFromCode($value);
    $updateData = array(
        'price'=>$lab['price'],
        'yprice'=>$lab['yprice'],
        'nprice'=>$lab['nprice']
    );
    // $savePatdata = $patdata->updatePatdata($updateData, $pat['row_id']);
    // dump($savePatdata);
}

$opaccId = '5752525';
$updateData = array(
    'price' => '99.99',
    'paid' => '99.99'
);
$opUpdate = $opacc->updateOpacc($updateData, $opaccId);
dump($opUpdate);

$opItem = $opacc->findOpaccFromId($opaccId);
dump($opItem);

exit;
?>