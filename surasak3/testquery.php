<?php

$t = microtime(true);

$Conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $Conn) or die( mysql_error() );
mysql_query("SET NAMES UTF8", $Conn);
// mysql_query("SET character_set_results=utf8");
// mysql_query("SET character_set_client=utf8");
// mysql_query("SET character_set_connection=utf8");

$q = mysql_query("SELECT * FROM `resultdetail` ORDER BY `autonumber` DESC LIMIT 100000;");
$i = 0;
while($item = mysql_fetch_assoc($q)){
	var_dump($item['autonumber']);
	$i++;
}
// var_dump($i);
$time = microtime(true) - $t;
var_dump($time);
exit;