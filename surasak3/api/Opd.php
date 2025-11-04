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

if($action==='saveDiabetes'){

    $post = $json->decode($jsonData);
    $diabetes->saveDiabetes($post);
    exit;
}