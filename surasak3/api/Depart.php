<?php
include_once dirname(__FILE__).'/../bootstrap.php';
include_once dirname(__FILE__).'/../includes/JSON.php';

require_once dirname(__FILE__).'/../class_file/class_depart.php';
require_once dirname(__FILE__).'/../class_file/class_patdata2.php';
require_once dirname(__FILE__).'/../class_file/class_opacc2.php';
require_once dirname(__FILE__).'/../class_file/class_opday.php';

$jsonData = file_get_contents('php://input');

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$action = sprintf("%s", $_REQUEST['action']);

if($action==='saveExpense'){
    $post = $json->decode($jsonData);

    $date = $post['date'];
    $hn = $post['hn'];
    $depart = $post['depart'];

    $detail = $post['detail'];
    $diag = $post['diag'];
    $lab_items = array($post['code']);
    $labOfficer = $post['officer'];
    $credit = $post['cashok'];
    $nLab_orderhead = '';
    $moneyOfficer = $post['money'];

    $doctor = $post['doctor'];

    $opacc = new ClassOpacc();
    $resOpacc = $opacc->getOpacc($date, $hn, 'PATHO');
    
    if($resOpacc!==false){
        $res=array('status'=>400,'msg'=>$hn.' บันทึกข้อมูลไปแล้ว');
    }else{

        $dep = new ClassDepart();
        $departId = $dep->insertOnlyDepart($hn, $detail, $diag, $lab_items, $labOfficer, $credit, $nLab_orderhead, $depart, $date, $doctor);
        $departIdList[] = $departId;
        dump("insertOnlyDepart");
        dump($departId);
        echo "<hr>";

        $patdata = new ClassPatdata();
        $insertPatdata = $patdata->insertOnlyPatdata($departId, $lab_items);
        dump("insertOnlyPatdata");
        dump($insertPatdata);
        echo "<hr>";

        $opaccInsert = $opacc->insertOpacc($departIdList, $detail, $moneyOfficer, $credit);
        dump("insertOpacc");
        dump($opaccInsert);
        echo "<hr>";

        echo "<h3>บันทึกข้อมูลเรียบร้อย</h3>";
    }

    $json->encode($res);
    exit;
}