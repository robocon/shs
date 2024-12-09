<?php 

define('HOST', '192.168.131.240');
define('PORT', '3306');
define('DB', 'sm3db-utf8');
define('USER', 'sm3db_user');
define('PASS', 'sm3dbPassword');

// define('HOST', 'localhost');
// define('PORT', '3306');
// define('DB', 'smdb');
// define('USER', 'root');
// define('PASS', '12345678');


$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");