<?php
session_start();

$action = isset($_POST['action']) ? trim($_POST['action']) : false ;
if($action == 'close_popup'){
	
	$_SESSION['close_popup'] = true;
}