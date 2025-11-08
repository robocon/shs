<?php
include_once dirname(__FILE__).'/../bootstrap.php';
include_once dirname(__FILE__).'/../includes/JSON.php';
include_once dirname(__FILE__).'/../class_file/class_opcard.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$opcard = new Opcard();
$action = sprintf("%s", $_REQUEST['action']);
/**
 * ดึงข้อมูลเบื้องต้น
 * @var string $_REQUEST['hn']
 */
if($action==='getOpcard'){
    $data = $opcard->getByHn($_REQUEST['hn'],array('yot','name','surname','mid','idcard','sex','dbirth','ptright'));
    echo $json->encode($data);
    exit;
}elseif ($action==="getFromName") {
    $data = $opcard->getByName($_REQUEST['name'],$_REQUEST['surname'],array('hn'));
    if($data!==false){
        $res = array('data'=>$data,'status'=>200);
    }else{
        $res = array('status'=>400);
    }
    echo $json->encode($res);
    exit;
}
