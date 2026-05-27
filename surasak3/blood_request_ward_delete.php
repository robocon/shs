<?php
require_once dirname(__FILE__) . '/newBootstrap.php';
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$input = file_get_contents('php://input');
$data = $json->decode($input, true);
$id = sprintf("%s", $dbi->real_escape_string($data['id']));
$sql = "UPDATE `blood_requests` SET `step` = '0' WHERE `id` = $id";
$result = $dbi->query($sql);
if($result){
    $res = array('status' => 200);
}else{
    $res = array('status' => 400);
}
echo $json->encode($res);