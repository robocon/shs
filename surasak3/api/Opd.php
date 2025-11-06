<?php
include_once dirname(__FILE__).'/../bootstrap.php';
include_once dirname(__FILE__).'/../includes/JSON.php';
include_once dirname(__FILE__).'/../class_file/class_opcard.php';
include_once dirname(__FILE__).'/../class_file/class_diabetes.php';

$jsonData = file_get_contents('php://input');

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$opcard = new Opcard();
$diabetes = new Diabetes();
$action = sprintf("%s", $_REQUEST['action']);

if($action==='saveRetinal'){

    $post = $json->decode($jsonData);
    
    $dmNumber = $diabetes->getDmNumber($post['hn']);
    // ถ้ายังไม่มี dmNumber ให้เพิ่มเข้าไปใน diabetic_clinicก่อน 
    dump($dmNumber);
    if($dmNumber===false){
        
    }


    $diabetes->insertHistory($post);

    // $diabetes->saveDiabetes($post);
    exit;
}