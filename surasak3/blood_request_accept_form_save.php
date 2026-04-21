<?php
include_once dirname(__FILE__).'/newBootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

echo $json->encode(array('success' => 200,'id'=>9999,'message'=>'บันทึกข้อมูลเสร็จสมบูรณ์'));