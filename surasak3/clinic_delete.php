<?php
require_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';
$json = new Services_JSON();

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$row_id = $_GET['row_id'];
$strSQL = sprintf("UPDATE `clinic_vip` SET `status` ='N' WHERE `row_id` = '%s'", $dbi->real_escape_string($row_id));
$q = $dbi->query($strSQL);
if($q!==false){
	$res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
}else{
	$res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ '.$dbi->error);
}
echo $json->encode($res);