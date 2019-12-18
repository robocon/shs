#!/usr/bin/php
<?php

$conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $conn) or die( mysql_error() );

// à«çµ»Õ§ºãËÁè
$year_prefix = (int) substr((date("Y") + 543), 2) + 1;

$sql = "UPDATE `runno`
SET
`prefix` = '$year_prefix/',
`runno` = '0'
WHERE title = 'referno' ;";
$update_referno = mysql_query($sql) or die( mysql_error() );
var_dump($update_referno);

$sql = "UPDATE `runno`
SET
`prefix` = '$year_prefix',
`runno` = '0'
WHERE title = 'death' ;";
$update_death = mysql_query($sql) or die( mysql_error() );
var_dump($update_death);

$sql = "UPDATE `runno` SET `prefix` = '$year_prefix', `runno` = '0' WHERE title = 'y_chekup' ;";
$update_y_chekup = mysql_query($sql) or die( mysql_error() );
var_dump($update_y_chekup);

$sql = "UPDATE `runno` SET `prefix` = '$year_prefix', `runno` = '0' WHERE title = 'c_chekup' ;";
$update_c_chekup = mysql_query($sql) or die( mysql_error() );
var_dump($update_c_chekup);

$sql = "UPDATE `runno` SET `prefix` = '$year_prefix', `runno` = '0' WHERE title = 's_chekup' ;";
$update_s_chekup = mysql_query($sql) or die( mysql_error() );
var_dump($update_s_chekup);