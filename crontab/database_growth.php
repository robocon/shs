#!/usr/bin/php
<?php
$conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('stats', $conn) or die( mysql_error() );

$sql = "INSERT INTO stats.tables 
SELECT DATE(NOW()),
       TABLE_SCHEMA,
       TABLE_NAME,
       ENGINE,
       TABLE_ROWS,
       DATA_LENGTH,
       INDEX_LENGTH,
       DATA_FREE,
       AUTO_INCREMENT
FROM   INFORMATION_SCHEMA.TABLES 
WHERE TABLE_SCHEMA = 'smdb';";

mysql_query($sql);