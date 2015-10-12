<?php
/**
 * 
 */
class User_helper 
{
	public function check_session(){
		
		if( !isset($_SESSION['sIdname']) ){
			return false;
		}
		return true;
	}
}
