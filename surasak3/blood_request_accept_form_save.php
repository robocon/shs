<?php
include_once dirname(__FILE__).'/newBootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$id = sprintf("%s", $dbi->real_escape_string($_POST['id']));
$replacement_units = sprintf("%s", $dbi->real_escape_string($_POST['replacement_units']));

$sql = "UPDATE `blood_requests` SET `active` = 'y', `replacement_units` = '$replacement_units', `date_active` = CURDATE() WHERE `id` = '$id'";
$q = $dbi->query($sql);
echo $json->encode(array('success' => 200,'id'=>$id,'message'=>'บันทึกข้อมูลเสร็จสมบูรณ์'));