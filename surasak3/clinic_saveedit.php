<?php
require_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';
$json = new Services_JSON();

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$sql = sprintf("UPDATE `clinic_vip` SET 
`hn` = '%s', 
`ptname` = '%s', 
`an` = '%s'
WHERE `row_id` = '%s'",
$dbi->real_escape_string($_POST['hn']),
$dbi->real_escape_string($_POST['ptname']),
$dbi->real_escape_string($_POST['an']),
$dbi->real_escape_string($_POST['row_id']));
$q = $dbi->query($sql);
if($q!==false){
	$res = array('status'=>200,'message'=>'บันทึกข้อมูลเรียบร้อย');
}else{
	$res = array('status'=>400,'message'=>'ไม่สามารถบันทึกข้อมูลได้ '.$dbi->error);
}
echo $json->encode($res);