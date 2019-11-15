<?
//กำหนด ชื่อดาต้าเบสเซิร์ฟเวอร์ , ชื่อฐานข้อมูล , ล็อกอิน และ รหัสผ่าน สำหรับติดต่อกับฐานข้อมูลให้กับตัวแปร
$ServerName = "localhost";
$DatabaseName = "smdb";
$User = "root"; 
$Password = "1234";

$SVNAME = "localhost";
$DBNAME = "dbconform";
$USER = "root"; 
$PASS = "1234";

//ติดต่อกับฐานข้อมูลผ่านฟังก์ชัน MySQL
$Conn = mysql_connect($ServerName,$User,$Password) or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");

//เลือกชื่อฐานข้อมูล คือ smdb
mysql_select_db($DatabaseName,$Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");

/*
code เดิม
$link = mysql_pconnect("localhost", "sith", "")or die("Could not connect");
mysql_select_db("smdb")or exit("Could not select database");
*/
/*mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");*/
?>


