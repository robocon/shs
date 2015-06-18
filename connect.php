<?php

$ServerName = "localhost";
$DatabaseName = "smdb";
$User = "root"; 
$Password = "1234";


$Conn = mysql_connect($ServerName,$User,$Password) or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");

mysql_select_db($DatabaseName,$Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");

?>