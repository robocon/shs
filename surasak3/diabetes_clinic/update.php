<?php 
define('NEW_SITE', true);
include '../bootstrap.php';
// date_footcare date_nutrition

// $sql = "SELECT `row_id`,`dateN`,`date_footcare` FROM `diabetes_clinic` ";
// $q = mysql_query($sql);
// while($item = mysql_fetch_assoc($q)){
	
// 	$id = $item['row_id'];
// 	$date = $item['dateN'];
	
// 	$sql = "UPDATE `diabetes_clinic` SET `date_footcare` = '$date', `date_nutrition` = '$date'
// 	WHERE `row_id` = '$id';";
// 	$update = mysql_query($sql);
// 	// var_dump($update);
	
// 	$sql = "UPDATE `diabetes_clinic` SET `date_footcare` = '$date', `date_nutrition` = '$date'
// 	WHERE `row_id` = '$id';";
// 	$update = mysql_query($sql);
// 	// var_dump($update);
	
// } 


$sql = "SELECT `row_id`,`dateN`,`date_footcare` FROM `diabetes_clinic_history` ";
$q = mysql_query($sql);
while($item = mysql_fetch_assoc($q)){
	
	$id = $item['row_id'];
	$date = $item['dateN'];
	
	$sql = "UPDATE `diabetes_clinic_history` SET `date_footcare` = '$date', `date_nutrition` = '$date'
	WHERE `row_id` = '$id';";
	$update = mysql_query($sql);
	// var_dump($update);
	
	$sql = "UPDATE `diabetes_clinic_history` SET `date_footcare` = '$date', `date_nutrition` = '$date'
	WHERE `row_id` = '$id';";
	$update = mysql_query($sql);
	// var_dump($update);
	
} 