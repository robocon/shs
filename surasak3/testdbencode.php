<?php 
include 'bootstrap.php';

// Load Databse
// DB::load();

// $items = DB::select("SELECT * FROM `opcard` LIMTI 30");
// foreach ($items as $key => $value) {
// 	var_dump($value);
// }

echo "<hr>";

$q = mysql_query("SELECT * FROM `opcard` LIMIT 30");
while ($a = mysql_fetch_assoc($q)) {
	var_dump($a);
}