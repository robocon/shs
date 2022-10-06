<?php
$Conn = mysql_connect("YOUR_HOST", "YOUR_USER", "YOUR_PASSWORD") or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");
mysql_select_db("YOUR_DB", $Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");

mysql_query("SET CHARACTER SET utf8 ");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client='utf8'");
mysql_query("SET character_set_connection='utf8'");
mysql_query("collation_connection = utf8_unicode_ci");
mysql_query("collation_database = utf8_unicode_ci");
mysql_query("collation_server = utf8_unicode_ci");
