<?php 
$db = mysql_connect('192.168.1.13', 'remoteuser', '') or die( mysql_error() );
mysql_select_db('smdb', $db) or die( mysql_error() );