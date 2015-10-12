<?php
/**
 * 
 */
class Mainpage extends Controller
{
	
	function base()
	{
		if( $this->user === false ){
			$view = $this->load_view('mainpage');
			$view->render();
		}else{
			$this->redirect('hellos');
		}
	}
	
	function login(){
		
		if( $this->user === true ){
			$this->redirect('hellos');
		}
		
		$db = $this->load_db();
		$sql = "SELECT * FROM `inputm` 
		WHERE `idname` = :test_idname 
		AND `pword` = :test_pword 
		AND `status` = 'y'";
		$db->select($sql, array(':test_idname' => $_POST['username'], ':test_pword' => $_POST['password']));
		$user = $db->get_item();
		
		if($user !== false){
			
			$_SESSION['sIdname'] = $user['idname'];
			$_SESSION['sPword'] = $user['pword'];
			$_SESSION['smenucode'] = $user['menucode'];
			$_SESSION['sOfficer'] = $user['name'];
			$_SESSION['sRowid'] = $user['row_id'];
			$_SESSION['sLevel'] = $user['level'];
		
			$this->redirect('hellos');
		}
		
	}
}
