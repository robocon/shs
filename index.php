<?php
/* SHS v0.4 */
// session_start();

// define('ROOT_DIR', realpath(dirname(__FILE__)).'/');
// define('APP_DIR', ROOT_DIR.'applications/');

// require(APP_DIR.'bootstrap.php');

// global $config;
// define('BASE_URL', $config['base_url']);

// // Run base from bootstrap
// bootstrap();

// landing from http://192.168.1.2/sm3
if( preg_match('(Windows)', $_SERVER['HTTP_USER_AGENT']) > 0 ){
    header('Location: nindex.htm');
}else{
    header('Location: surasak3/login_mobile.php');
}
?>