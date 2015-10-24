<?php
$connect = mysql_connect("192.168.1.2","demosmdb","") or die ( mysql_error() );
mysql_select_db("smdb", $connect) or die ( mysql_error() );
$test = mysql_query("SET NAMES TIS620", $connect);

$sql = "SHOW TABLES";
$q = mysql_query($sql);
while ($item = mysql_fetch_assoc($q)) {
	# code...
	var_dump($item);
}