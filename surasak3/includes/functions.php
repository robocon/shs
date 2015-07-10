<?php

// define php version id e.g. 50217 is PHP Version 5.2.17
if (!defined('PHP_VERSION_ID')) {
	$version = explode('.', PHP_VERSION);
	define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

/**
 * Clean single quote and double quote with mysql escape string ... some thing like Injection
 *
 * Example
 * 
 * $sql = clean_query(
 * 		"SELECT * FROM XXX WHERE `id` = ':id' AND `pass` = ':pass';", 
 * 		array(':id' => 'test', ':pass' => '1234'));
 */
function clean_sql($sql, $args){

	foreach($args as $key => $arg){
		$pure_arg = mysql_real_escape_string($arg);
		$sql = str_replace($key, $pure_arg, $sql);
	}
	
	return $sql;
}

/**
 * Debug in pre tag 
 */
function dump($args){
	echo '<pre>';
	var_dump($args);
	echo '</pre>';
}

/**
 * Check user from $_SESSION['sRowid']
 */
function authen(){
	$auth = isset($_SESSION['sRowid']) ? $_SESSION['sRowid'] : false ;
	return $auth;
}

/**
 *
 */
function post2null($args, $method = 'post'){
	
	if(is_array($args)){
		$items = array();
		foreach($args as $key => $val){
			$items[$key] = filter2null($key, $method);
		}
	}
	return $items;
}

function filter2null($name, $method_type = 'post'){
	
	$method = ( $method_type === 'post' ) ? $_POST : $_GET ;
	$item = isset($method[$name]) ? trim($method[$name]) : null ;
	return $item;
}

/**
 * Filter from white lists
 */
function filter_post($items){
	foreach($items as $name){
		
		if(isset($_POST[$name])){
			$_POST[$name] = strip_tags(trim($_POST[$name]));
		}else{
			$_POST[$name] = null;
		}
	}
	return $_POST;
}