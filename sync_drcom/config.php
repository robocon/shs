<?php
include 'base_fun.php';

/**
 * CONNECTION 
 * ถ้าใช้ Query กับ Drcom จะใช้ $drcom เป็น link_identifier เช่น
 * mysql_query('// Do some select', $drcom)
 *
 * แต่ถ้า Query กับ รพ. จะเป็น $shs
 * 
 * อ่านต่อ http://php.net/manual/en/function.mysql-query.php
 */
$drcom = mysql_connect('test-mysql','root','1234') or die( set_error_log( mysql_error() ) );
mysql_select_db('sync', $drcom ) or die( set_error_log( mysql_error() ) );
mysql_query("SET NAMES UTF8", $drcom);

$shs = mysql_connect('test-mysql','root','1234') or die( set_error_log( mysql_error() ) );
mysql_select_db('smdb_drcom', $shs) or die( set_error_log( mysql_error() ) );

// !!!! ระวังตอนเอาขึ้นเซิฟเวอร์ !!!! บางทีมันจะไม่อ่าน
mysql_query("SET NAMES TIS620", $shs);