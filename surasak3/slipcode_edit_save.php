<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';
if(empty($_SESSION['sOfficer'])){
	include 'pageNotFound.php';
	exit;
}

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$input = file_get_contents('php://input');
$data = $json->decode($input);

if(!empty($data['id'])){
	$sql = sprintf("UPDATE `drugslip` SET `amount` = '%s' WHERE `row_id`='%s' ", 
		$dbi->real_escape_string($data['amount']),
		$dbi->real_escape_string($data['id'])
	); 
	$q = $dbi->query($sql);
	if($q!==false){
		$res = array('status'=>200, 'msg'=>'save successful');
	}else{
		$res = array('status'=>400, 'msg'=>'Error: '.$dbi->error);
	}
}
echo $json->encode($res);