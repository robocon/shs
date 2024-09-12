<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$username = sprintf("%s", $_GET['username']);
$tab = sprintf("%s", $_GET['tab']);
$hn = sprintf("%s", $_GET['hn']);
$sql = "INSERT INTO `open_tab` (`id`, `username`, `date`, `tab`, `hn`) VALUES (NULL, '$username', NOW(), '$tab', '$hn');";
$q = $dbi->query($sql);
