<?php
/**
 * This file is using for UTF-8 encoding only
 */
session_start();
define('NEW_SITE', true);
require "bootstrap.php";

$action = isset($_POST['action']) ? trim($_POST['action']) : false ;
if($action == 'close_popup'){
	
	$_SESSION['close_popup'] = true;
	
}else if($action == 'find_drug_interaction'){
	
	header('Content-Type: text/html; charset=utf-8');
	
	$word = isset($_POST['word']) ? trim($_POST['word']) : false ;
	if(empty($word)){
		exit;
	}
	
	$sql = "
SELECT `row_id`,`drugcode`,`genname`,`tradname` FROM `druglst` WHERE `genname` LIKE '%$word%';
	";
	
	$query = mysql_query($sql);
	$pre_res = array();
	while($item = mysql_fetch_assoc($query)){
		
		$pre_res[] = '{"row_id":"'.$item['row_id'].'","code":"'.trim($item['drugcode']).'","genname":"'.$item['genname'].'","tradname":"'.$item['tradname'].'"}';
	}
	
	if(empty($pre_res)){
		echo '[]';
		exit;
	}
	
	$res = implode(',', $pre_res);
	
	// @todo
	// - add header json encode if PHP enable json
	echo "[$res]";
	exit;
	
}


