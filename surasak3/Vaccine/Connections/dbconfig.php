<?php

$conn;

$server = "192.168.131.240"; // มักเป็น localhost (กรณี Host ที่คุณใช้ไม่ได้กำหนดเป็นค่าอย่างอื่น)
$user = "sm3db_user"; // Username ในการติดต่อฐานข้อมูล
$pass = "sm3dbPassword"; // Password ในการติดต่อฐานข้อมูล
$dbname = "sm3db-utf8"; // ชื่อฐานข้อมูลที่ได้สร้างไว้

function conndb() {
  global $conn;
  global $server;
  global $user;
  global $pass;
  global $dbname;
  $conn = mysql_connect($server,$user,$pass);
mysql_select_db($dbname) ;
mysql_db_query($dbname,"SET NAMES tis-620");
  if (!$conn)
    die("ไม่สามารถติดต่อกับ MySQL ได้");

  mysql_select_db($dbname,$conn)
    or die("ไม่สามารถเลือกใช้งานฐานข้อมูลได้");
    mysql_query("SET NAMES UTF8");
}

function closedb() {
  global $conn;
  mysql_close($conn);
}

?>
