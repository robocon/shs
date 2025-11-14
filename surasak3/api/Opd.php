<?php
include_once dirname(__FILE__).'/../bootstrap.php';
include_once dirname(__FILE__).'/../includes/JSON.php';
include_once dirname(__FILE__).'/../class_file/class_opcard.php';
include_once dirname(__FILE__).'/../class_file/class_diabetes.php';
include_once dirname(__FILE__).'/../class_file/class_runno.php';
$jsonData = file_get_contents('php://input');

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$opcard = new Opcard();
$dm = new Diabetes();
$no = new Runno();

$action = sprintf("%s", $_REQUEST['action']);

if($action==='saveRetinal'){

    $post = $json->decode($jsonData);
    $item = $dm->getDiabetesFromHn($post['hn']);

    $res = array('status'=>200, 'msg'=>'บันทึกข้อมูลเรียบร้อย');
    $error_list = array();
    // ถ้ายังไม่มี dmNumber ให้เพิ่มเข้าไปใน diabetic_clinic ก่อน 
    if($item===false){
        $runno = $no->getRunno('diabetes');
        $resInsertDiabetes = $dm->insertRetinalDiabetes($runno, $post);
        if($resInsertDiabetes!==false){
            $no->nextRunno = $runno;
            $no->setNextRunno();
            $dmNumber = $res['dm_no'] = $resInsertDiabetes;
        }else{
            $error_list['insert_retinal_diabetes'] = $resInsertDiabetes;
            $res['status']=400;
        }
    }else{
        $dmNumber = $item['dm_no'];
    }

    // เช็กดูว่าวันนี้มี history แล้วรึยัง ถ้ายังไม่มีค่อยเพิ่ม
    $his = $dm->findDiabetesHistoryToday($post['hn']);
    if($his===false){
        $insertHistoryId = $dm->insertRetinalDiabetesHistory($dmNumber, $post);
        if($insertHistoryId!==false){
            $res['dm_history_id'] = $insertHistoryId;
        }else{
            $error_list['insert_diabetes_history'] = $insertHistoryId;
            $res['status']=400;
        }
    }else{
        $res['dm_history_id'] = $his;
    }

    $updateDm = $dm->updateRetinalDiabetes($dmNumber,$item['dateN'], $post);
    $res['update_dm_no'] = $updateDm;

    $retinal = $dm->findRetinalExamFromDateHn(date('Y-m-d').$post['hn']);
    if($retinal===false){
        $insertRetinal = $dm->insertRetinalExam($dmNumber, $post);
        if($insertRetinal!==false){
            $res['retinal_id'] = $insertRetinal;
        }else{
            $error_list['insert_retinal'] = $insertRetinal;
            $res['status']=400;
        }
    }else{
        $dm->updateRetinalExam($post);
    }
    
    if(count($error_list)>0){
        $res['error']=$error_list;
    }
    echo $json->encode($res);
    exit;
}