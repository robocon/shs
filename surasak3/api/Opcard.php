<?php
include_once dirname(__FILE__).'/../bootstrap.php';
include_once dirname(__FILE__).'/../includes/JSON.php';
include_once dirname(__FILE__).'/../class_file/class_opcard.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$opcard = new Opcard();
$action = sprintf("%s", $_REQUEST['action']);
if($action==='getOpcard'){
    $data = $opcard->getByHn($_REQUEST['hn'],array('yot','name','surname','mid','idcard','sex','dbirth'));
    echo $json->encode($data);
    exit;
}
