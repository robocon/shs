<?php
include_once dirname(__FILE__).'/../bootstrap.php';
include_once dirname(__FILE__).'/../includes/JSON.php';
include_once dirname(__FILE__).'/../class_file/class_labcare.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$lab = new Labcare();
$action = sprintf("%s", $_REQUEST['action']);

if($action==='listLabItems'){
    $lab = $lab->getLabCode($_REQUEST['labcode']);
    $res = array('status'=>400);
    if($lab!==false){
        $res = array('status'=>200, 'data'=>$lab);
    }
    echo $json->encode($res);
    exit;
}