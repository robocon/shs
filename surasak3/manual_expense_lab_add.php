<?php 
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_depart.php';
require_once dirname(__FILE__).'/class_file/class_patdata2.php';
require_once dirname(__FILE__).'/class_file/class_opacc2.php';
require_once dirname(__FILE__).'/class_file/class_resulthead2.php';
require_once dirname(__FILE__).'/class_file/class_opday.php';

// require_once 'manual_expense_config.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$date = (date('Y')+543).date('-m-d');
if(!empty($_GET['date'])){
    $date = $_GET['date'];
}
$hn = sprintf("%s", $_GET['hn']);
$depart = sprintf("%s", $_GET['depart']);
$labOfficer = sprintf("%s", $_GET['officer']);
$moneyOfficer = sprintf("%s", $_GET['moneyOfficer']);
$credit = sprintf("%s", $_GET['credit']);
$companyPart = sprintf("%s", $_GET['companyPart']);

$thdatehn = date('d-m-').(date('Y')+543).$hn;
if(!empty($_GET['date'])){
    list($y,$m,$d) = explode('-', $_GET['date']);
    $thdatehn = "$d-$m-$y".$hn;
}

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
    SELECT * FROM `manual_expense` WHERE `part` = '$companyPart' AND hn = '$hn' 
) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
LEFT JOIN (
    SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,`toborow` FROM `opday` WHERE `thdatehn` = '$thdatehn'
) AS c ON a.`hn` = c.`hn`
GROUP BY a.hn
ORDER BY a.id ASC";

$q = $dbi->query($sql);
$a = $q->fetch_assoc();

$detail = 'ค่าตรวจวิเคราะห์โรค';
$diag = 'ตรวจสุขภาพ';

$lab_items = explode(',', $a['lab_items']);
$labOfficer = $_GET['officer'];
// $cashok = 'กฟผ';
$nLab_orderhead = '';

if(empty($a['vn'])){
    echo "<h3>ทะเบียน ยังไม่ได้ออก VN</h3>";
}else{

    $opacc = new ClassOpacc();
    $resOpacc = $opacc->getOpacc($date, $hn, 'PATHO', $credit);
    if($resOpacc!==false){
        echo '<h3>เคยบันทึกข้อมูล LAB ไปแล้ว</h3>';
        dump($resOpacc);
        exit;
    }else{

        $dep = new ClassDepart();
        $departId = $dep->insertOnlyDepart($hn, $detail, $diag, $lab_items, $labOfficer, $credit, $nLab_orderhead, $depart, $date);
        $departIdList[] = $departId;
        dump('depart id'.$departId);

        $patdata = new ClassPatdata();
        $insertPatdata = $patdata->insertOnlyPatdata($departId, $lab_items, $date);
        dump('patdata ');
        dump($insertPatdata);

        $opaccInsert = $opacc->insertOpacc($departIdList, $detail, $moneyOfficer, $credit, $date);
        dump('opacc');
        dump($opaccInsert);

        echo "<h3>บันทึกข้อมูลเรียบร้อย</h3>";
    }
    
}