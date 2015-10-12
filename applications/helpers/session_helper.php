<?php
/**
 * 
 */
class Session_helper 
{
	
	public function get($name){
		return $_SESSION[$name];
	}
	
	public function set($key, $val){
		$_SESSION[$key] = $val;
	}
	
	public function destroy(){
		session_destroy();
	}
}
