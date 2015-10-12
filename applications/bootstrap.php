<?php

// Include BASE System
require(APP_DIR.'system/config.php');
require(APP_DIR.'system/model.php');
require(APP_DIR.'system/view.php');
require(APP_DIR.'system/controller.php');

function bootstrap(){
	global $config;
	
	// Remove subfolder
	$request_uri = trim(str_replace($config['base_url'],'',$_SERVER['REQUEST_URI']), '/');
	
	// Default class and method name
	$controller = 'mainpage';
	$method = 'base';
	
	if( !empty($request_uri) ){
		$controller = $request_uri;
		if( strpos($request_uri, '/') > 0 ){
			list($controller, $method, $params) = explode('/', $request_uri, 3);
		}
	}
	
	// explode params and add it into method
	if(!empty($params)){
		$params = explode('/', $params);
	}else{
		$params = array();
	}
	
	$path = APP_DIR.'controllers/'.$controller.'.php';
	
	// Check path
	if(file_exists($path) !== false){
		require_once($path);
		
	}else{
		require_once(APP_DIR.'controllers/'.$config['error_controller'].'.php');
		$controller = 'Error';
		$method = 'base';
	}
	
	$controller_name = ucfirst($controller);
	
	if(class_exists($controller_name)){
		$obj = new $controller_name();
		call_user_func_array(array($obj, $method), $params);
	}
	
}