<?
//กำหนด ชื่อดาต้าเบสเซิร์ฟเวอร์ , ชื่อฐานข้อมูล , ล็อกอิน และ รหัสผ่าน สำหรับติดต่อกับฐานข้อมูลให้กับตัวแปร
$ServerName = "192.168.131.240";
$DatabaseName = "sm3db-utf8";
$User = "sm3db_user"; 
$Password = "sm3dbPassword";

//ติดต่อกับฐานข้อมูลผ่านฟังก์ชัน MySQL
$Conn = mysql_connect($ServerName,$User,$Password) or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");

//เลือกชื่อฐานข้อมูล คือ smdb
mysql_select_db($DatabaseName,$Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");
mysql_query("SET CHARACTER SET utf8 ");

/*
code เดิม
$link = mysql_pconnect("localhost", "sith", "")
        or die("Could not connect");

    mysql_select_db("smdb")
        or exit("Could not select database");
*/
?>


