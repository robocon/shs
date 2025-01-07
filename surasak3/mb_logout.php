<?php 
session_start();
$_SESSION = array();

session_destroy();
setcookie('shsLogin', '', -1, '/'); 
setcookie('shsLoginUser', '', -1, '/'); 
header("Location: login_page.php");
?>