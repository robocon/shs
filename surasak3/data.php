<?php
require_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';
$json = new Services_JSON();

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

//กรณีมี Error เกิดขึ้น
if ($dbi->connect_error) {
	die('Error : ('. $dbi->connect_errno .') '. $dbi->connect_error);
}

//เรียกข้อมูลจาก ตาราง chart 
$get_data = $dbi->query("SELECT province as name, (men + wemen) as y FROM `chart` ");

while($data = $get_data->fetch_assoc()){
	
	$result[] = $data;
}
	
echo $json->encode( $result, JSON_NUMERIC_CHECK);
?>