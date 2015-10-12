<?php
/**
 * 
 */
class Hellos extends Controller
{
	
	public function base(){
		var_dump(__FUNCTION__);
		var_dump($_SESSION);
		exit;
	}
	
	public function hello(){
		
		var_dump($this->user);
		
		$db = $this->load_db();
		$sql = "SELECT * FROM `inputm` WHERE `status` = :status;";
		$db->select($sql, array(':status' => 'Y'));
		$items = $db->get_items();
		
		$view = $this->load_view('hello');
		
		$view->set_val(array('items' => $items));
		$view->render();
	}
}