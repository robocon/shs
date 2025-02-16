<?php
session_start();
$_SESSION = array();

session_destroy();
setcookie('shsLogin', '', -1, '/'); 
setcookie('shsLoginUser', '', -1, '/'); 

$_SESSION['x-msg'] = 'ออกจากระบบเรียบร้อย';
header("Location: login_page.php");