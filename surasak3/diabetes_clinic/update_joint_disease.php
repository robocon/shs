<?php session_start();
require "../connect.php";
require "../includes/functions.php";

$sql = "SELECT `row_id`,`joint_disease`,`joint_disease_dm`,`joint_disease_nephritic`,`joint_disease_myocardial`,`joint_disease_paralysis`
FROM `hypertension_clinic`";
$q = mysql_query($sql);
// echo "<pre>";
while($item = mysql_fetch_assoc($q)){
	$id = $item['row_id'];
	$test_disease = 0;
	if(trim($item["joint_disease_dm"]) == "Y"
	OR trim($item["joint_disease_nephritic"]) == "Y"
	OR trim($item["joint_disease_myocardial"]) == "Y"
	OR trim($item["joint_disease_paralysis"]) == "Y"){
		$test_disease = 1;
	}
	
	// var_dump($id.' --> '.$test_disease);
	$update_query = "UPDATE `hypertension_clinic` SET `joint_disease`='$test_disease' WHERE `row_id`='$id';";
	// var_dump($update_query);
	mysql_query($update_query);
}

$sql = "SELECT `id`,`joint_disease`,`joint_disease_dm`,`joint_disease_nephritic`,`joint_disease_myocardial`,`joint_disease_paralysis`
FROM `hypertension_history`";
$q = mysql_query($sql);
// echo "<pre>";
while($item = mysql_fetch_assoc($q)){
	$id = $item['id'];
	$test_disease = 0;
	if(trim($item["joint_disease_dm"]) == "Y"
	OR trim($item["joint_disease_nephritic"]) == "Y"
	OR trim($item["joint_disease_myocardial"]) == "Y"
	OR trim($item["joint_disease_paralysis"]) == "Y"){
		$test_disease = 1;
	}
	
	// var_dump($id.' --> '.$test_disease);
	$update_query = "UPDATE `hypertension_history` SET `joint_disease`='$test_disease' WHERE `id`='$id';";
	// var_dump($update_query);
	mysql_query($update_query);
}