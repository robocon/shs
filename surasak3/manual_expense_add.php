<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_depart.php';
require_once 'class_file/class_patdata.php';
require_once 'class_file/class_opacc.php';
require_once 'class_file/class_resulthead.php';
require_once 'class_file/opday.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$date = (date('Y')+543).date('-m-d');
$hn = sprintf("%s", $_GET['hn']);
$depart = sprintf("%s", $_GET['depart']);

$sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`ptright`, 
c.`vn` 
FROM (
    SELECT trim(`hn`) AS `hn`, GROUP_CONCAT(`item_sso`) AS lab_items,labnumber 
    FROM `chk_lab_items` 
    WHERE `part` = 'เทศบาลเมืองเขลางค์นคร 66 ก.ย.' 
    AND hn = '$hn' 
    GROUP BY hn 
) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
LEFT JOIN (
    SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,toborow FROM opday WHERE thidate LIKE '$date%'
) AS c ON a.`hn` = c.`hn`";

$q = $dbi->query($sql);
$a = $q->fetch_assoc();

$detail = 'ค่าตรวจวิเคราะห์โรค';
$diag = 'ตรวจสุขภาพ';

$lab_items = explode(',', $a['lab_items']);
$labOfficer = $_GET['officer'];
$cashok = 'กฟผ';
$nLab_orderhead = '';

if(empty($a['vn'])){
    echo "ทะเบียน ยังไม่ได้ออก VN";
}else{
    $dep = new ClassDepart();
    $departId = $dep->insertOnlyDepart($hn, $detail, $diag, $lab_items, $labOfficer, $cashok, $nLab_orderhead, $depart);
    $departIdList[] = $departId;
    dump($departId);

    $patdata = new ClassPatdata();
    $insertPatdata = $patdata->insertOnlyPatdata($departId, $lab_items);
    dump($insertPatdata);

    $opacc = new ClassOpacc();
    $officer = 'นางสาว พวงเพ็ชร หอมแก่นจันทร์';
    $credit = 'กฟผ';
    $opaccInsert = $opacc->insertOpacc($departIdList, $detail, $officer, $credit);
    dump($opaccInsert);
}