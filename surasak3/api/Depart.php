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
    $hn = trim($post['hn']);
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
    $resOpacc = $opacc->getOpacc($date, $hn, $depart);
    $res=array('status'=>400,'msg'=>$hn.' บันทึกข้อมูลไปแล้ว');
    if($resOpacc==false){
        $resData = array();
        $dep = new ClassDepart();
        $departId = $dep->insertOnlyDepart($hn, $detail, $diag, $lab_items, $labOfficer, $credit, $nLab_orderhead, $depart, $date, $doctor);
        $departIdList[] = $departId;
        $resData['depart'] = $departId;

        $patdata = new ClassPatdata();
        $insertPatdata = $patdata->insertOnlyPatdata($departId, $lab_items, $date);
        $resData['patdata'] = $insertPatdata;

        $opaccInsert = $opacc->insertOpacc($departIdList, $detail, $moneyOfficer, $credit, $date);
        $resData['opacc'] = $opaccInsert;

        $res=array('status'=>200, 'msg'=>'บันทึกข้อมูลเรียบร้อย', 'data'=>$resData);
    }

    echo $json->encode($res);
    exit;
}elseif ($action==='getDepartFromHn') {
    $dep = new ClassDepart();
    
    $departItems = $dep->getDepart($_POST['date'], $_POST['hn']);
    $res=array('status'=>400,'msg'=>'ไม่พบข้อมูล');
    if($departItems!==false){
        $res=array('status'=>200,'data'=>$departItems);
    }
    echo $json->encode($res);
    exit;
}elseif ($action==='updateVnDepart') {

    $post = $json->decode($jsonData);

// hn
// dateFrom
// vnFrom
// dateTo
// vnTo

    $dep = new ClassDepart();
    $patdata = new ClassPatdata();
    $opacc = new ClassOpacc();

    foreach ($post['depart'] as $departId) {
        
        $dItem = $dep->getDepartFromId($departId);
        if(count($dItem)>0){
            
            list($oldDate, $oldTime) = explode(' ', $dItem['date']);
            $newDate = $post['dateTo'].' '.$oldTime;
            $dep->setDepartManual(array('txdate'=>$newDate, 'tvn'=>$post['vnTo']), $departId);

            $patdata->updateFromIdno(array('date'=>$newDate), $departId);

        }

        $oItems = $opacc->findOpaccFromTxdate($dItem['date']);
        if($oItems!==false){
            
            foreach ($oItems as $oItem) {
                $opaccId = $oItem['row_id'];
                list($opaccDate, $opaccTime) = explode(' ', $oItem['date']);
                $newOpaccDate = $post['dateTo'].' '.$opaccTime;
                $opacc->updateOpacc(array('date'=>$newOpaccDate, 'txdate'=>$newDate, 'vn'=>$post['vnTo']), $opaccId);
            }
        }

    }
    
    exit;
}