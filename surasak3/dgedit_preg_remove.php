<?php 
require_once 'bootstrap.php';
include 'includes/JSON.php';
$json = new Services_JSON();

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");
$id = sprintf("%s", $_GET['id']);

if(empty($id)){
    echo $json->encode(array('status'=>400, 'message'=>'invalid data'));
    exit;
}

$sql = "DELETE FROM drug_pregnancy WHERE id = '$id';";
$save = $dbi->query($sql);

if(empty($dbi->error)){
    $res = array('status'=>200, 'message' => 'บันทึกข้อมูลเรียบร้อย');
}else{
    $res = array('status'=>400, 'message' => 'บันทึกข้อมูลไม่สำเร็จ '.$dbi->error);
}

echo $json->encode($res);