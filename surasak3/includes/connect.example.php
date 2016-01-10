<?php
$Conn = mysql_connect("LOCALHOST","USERNAME","PASSWORD");
mysql_select_db("YOUR_DB_NAME", $Conn);
mysql_query("SET NAMES TIS620", $Conn);