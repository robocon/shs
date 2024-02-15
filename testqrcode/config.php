<?php
define('HOST', '192.168.131.240');
define('PORT', '3306');
define('DB', 'sm3db-utf8');
define('USER', 'sm3db_user');
define('PASS', 'sm3dbPassword');
define('SM3_HOST_URL', 'http://192.168.131.250/sm3/surasak3/');

// define('HOST', 'localhost');
// define('PORT', '3306');
// define('DB', 'smdb');
// define('USER', 'root');
// define('PASS', '12345678');

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "<pre>";
}

$def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');