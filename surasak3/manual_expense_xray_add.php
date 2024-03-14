<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_depart.php';
require_once 'class_file/class_patdata.php';
require_once 'class_file/class_opacc.php';
require_once 'class_file/class_resulthead.php';
require_once 'class_file/opday.php';

require_once 'manual_expense_config.php';

$date = (date('Y')+543).date('-m-d');
$hn = sprintf("%s", $_GET['hn']);
$depart = sprintf("%s", $_GET['depart']);

// $sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`ptright`, 
// c.`vn` 
// FROM (
//     SELECT trim(`hn`) AS `hn`, GROUP_CONCAT(`item_sso`) AS lab_items,labnumber 
//     FROM `chk_lab_items` 
//     WHERE `part` = 'เทศบาลเมืองเขลางค์นคร 66 ก.ย.' 
//     AND hn = '$hn' 
//     GROUP BY hn 
// ) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
// LEFT JOIN (
//     SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,toborow FROM opday WHERE thidate LIKE '$date%'
// ) AS c ON a.`hn` = c.`hn`";

$sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`ptright`, 
c.`vn` 
FROM (
    SELECT * FROM `manual_expense` WHERE `part` = '".COMPANY_PART."' AND hn = '$hn' 
) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
LEFT JOIN (
    SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,toborow FROM opday WHERE thidate LIKE '$date%'
) AS c ON a.`hn` = c.`hn`
GROUP BY a.hn
ORDER BY a.id ASC";

$q = $dbi->query($sql);
$a = $q->fetch_assoc();

$detail = 'ค่าตรวจวิเคราะห์โรค';
$diag = 'ตรวจสุขภาพ';

$xray_items = array('41001-CHK');
$xrayOfficer = $_GET['officer'];
$moneyOfficer = sprintf("%s", $_GET['moneyOfficer']);
$credit = sprintf("%s", $_GET['credit']);

$nLab_orderhead = '';

if(empty($a['vn'])){
    echo "ทะเบียน ยังไม่ได้ออก VN";
}else{

    $opacc = new ClassOpacc();
    $resOpacc = $opacc->getOpacc($date, $hn, 'XRAY');
    if($resOpacc!==false){
        echo '<h1>มีข้อมูลแล้ว</h1>';
        dump($resOpacc);
        exit;
    }


    $dep = new ClassDepart();
    $departId = $dep->insertOnlyDepart($hn, $detail, $diag, $xray_items, $xrayOfficer, $credit, $nLab_orderhead, $depart);
    $departIdList[] = $departId;
    dump($departId);

    $patdata = new ClassPatdata();
    $insertPatdata = $patdata->insertOnlyPatdata($departId, $xray_items);
    dump($insertPatdata);

    // $officer = 'นาง นทีพร เรียงสุข';
    // $credit = 'กฟผ';
    $opaccInsert = $opacc->insertOpacc($departIdList, $detail, $moneyOfficer, $credit);
    dump($opaccInsert);
}