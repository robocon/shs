<?php
include_once dirname(__FILE__).'/newBootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$id = sprintf("%s", $dbi->real_escape_string($_POST['id']));
$replacement_units = sprintf("%s", $dbi->real_escape_string($_POST['replacement_units']));
$unit_number = sprintf("%s", $dbi->real_escape_string($_POST['unit_number']));

$sql = "UPDATE `blood_requests` 
SET `active` = 'y', 
`replacement_units` = '$replacement_units', 
`date_active` = CURDATE(), 
`time_active` = DATE_FORMAT(NOW(), '%H:%i:%s'), 
`active_by` = '{$_SESSION['sOfficer']}', 
`unit_number` = '$unit_number' 
WHERE `id` = '$id'";
$q = $dbi->query($sql);
if($q!==false){
    $res = array('success' => 200,'id'=>$id,'message'=>'บันทึกข้อมูลเสร็จสมบูรณ์');
}else{
    $res = array('success' => 400,'message'=>'Error: '.$dbi->error);
}
echo $json->encode($res);