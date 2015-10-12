<?php
/* SHS v0.4 */
session_start();

define('ROOT_DIR', realpath(dirname(__FILE__)).'/');
define('APP_DIR', ROOT_DIR.'applications/');

require(APP_DIR.'bootstrap.php');

global $config;
define('BASE_URL', $config['base_url']);

// Run base from bootstrap
bootstrap();
?>