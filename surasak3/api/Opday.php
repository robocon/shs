<?php
include_once dirname(__FILE__).'/../bootstrap.php';
include_once dirname(__FILE__).'/../includes/JSON.php';
include_once dirname(__FILE__).'/../class_file/class_opday.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$opday = new Opday();
$action = sprintf("%s", $_REQUEST['action']);

if($action==='getOpdayLast6Months'){
    $opday = $opday->getOpdayLast6Months($_REQUEST['hn']);
    $res = array('status'=>400);
    if($opday!==false){
        $res = array('status'=>200, 'data'=>$opday);
    }
    echo $json->encode($res);
    exit;
}