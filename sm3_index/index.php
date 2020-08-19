<?php 
// landing from http://192.168.1.2
if( preg_match('(Windows)', $_SERVER['HTTP_USER_AGENT']) > 0 ){
	header('Location: sm3/nindex.htm');
}else{
	header('Location: sm3/surasak3/login_mobile.php');
}
?>