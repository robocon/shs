<?php
define('NOTIFY_HOST', 'HTTP_SERVER_FOR_NOTIFY');
define('NOTIFY_HOST_CAMERA', 'FOR_HTTPS_ONLY');

define('DEV', true);
if(defined('DEV')===false){
    $ServerName = "IP_SERVER";
    $DatabaseName = "DATABASE_NAME";
    $User = "DATABASE_USERNAME"; 
    $Password = "DATABASE_PASSWORD";
    $Port = 3306;
}else{
    $ServerName = "LOCALHOST";
    $DatabaseName = "LOCAL_DATABASE_NAME";
    $User = "LOCAL_USERNAME"; 
    $Password = "LOCAL_PASSWORD";
    $Port = 3306;
}
$Conn = mysql_connect($ServerName,$User,$Password) or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");

mysql_select_db($DatabaseName,$Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");
mysql_query("SET CHARACTER SET utf8 ");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client='utf8'");
mysql_query("SET character_set_connection='utf8'");
mysql_query("collation_connection = utf8_unicode_ci");
mysql_query("collation_database = utf8_unicode_ci");
mysql_query("collation_server = utf8_unicode_ci");

$dbi = new mysqli($ServerName,$User,$Password,$DatabaseName,$Port);
?>