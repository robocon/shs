<?php

/**
 * 
 */
class Controller
{
	public $user = null;
	public $session = null;
	
	function __construct()
	{	
		// Load helper or etc
		$this->session = $this->load_helper('session_helper');
		$user_helper = $this->load_helper('user_helper');
		$this->user = $user_helper->check_session();
	}
	
	public function load_db(){
		$model = new Model();
		return $model;
	}
	
	public function load_view($name){
		$view = new View($name);
		return $view;
	}
	
	public function load_helper($name){
		
		if(!class_exists($name)){
			require_once(APP_DIR.'helpers/'.$name.'.php');
			$helper = new $name;
			return $helper;
		}
	}
	
	public function domain(){
		$domain = strtolower(getenv('HTTPS')) == 'on' ? 'https' : 'http' . '://' . getenv('HTTP_HOST') . ( ($p = getenv('SERVER_PORT')) != 80 AND $p != 443 ? ":$p" : '' );
		return $domain;
	}
	
	public function redirect($url){
		global $config;
		$url = $this->domain().'/'.$config['base_url'].$url;
		header('Location: '.$url);
	}
}
