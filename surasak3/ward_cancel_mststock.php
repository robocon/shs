<?php
require_once dirname(__FILE__).'/newBootstrap.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$input = file_get_contents('php://input');
$data = $json->decode($input, true);

$bsConn = mysqli_connect(BLOOD_SERVER,BLOOD_USER,BLOOD_PASS,BLOOD_DB);
$bsConn->query("SET NAMES UTF8");

$unit_number = sprintf("%s", $dbi->real_escape_string($data['unit_number']));

$sqlUpdate = "UPDATE mst_stock SET
Flag_Reserved = ''
WHERE Unit_Number = '$unit_number'";
$q = $bsConn->query($sqlUpdate);
if($q!==false){
    $res = array('status'=>200);
}else{
    $res = array('status'=>400,'message'=>$dbi->error);
}
echo $json->encode($res);