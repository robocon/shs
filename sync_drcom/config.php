<?php
include 'base_fun.php';

/**
 * CONNECTION 
 * ����� Query �Ѻ Drcom ���� $drcom �� link_identifier ��
 * mysql_query('// Do some select', $drcom)
 *
 * ���� Query �Ѻ þ. ���� $shs
 * 
 * ��ҹ��� http://php.net/manual/en/function.mysql-query.php
 */
$drcom = mysql_connect('test-mysql','root','1234') or die( set_error_log( mysql_error() ) );
mysql_select_db('sync', $drcom ) or die( set_error_log( mysql_error() ) );
mysql_query("SET NAMES UTF8", $drcom);

$shs = mysql_connect('test-mysql','root','1234') or die( set_error_log( mysql_error() ) );
mysql_select_db('smdb_drcom', $shs) or die( set_error_log( mysql_error() ) );

// !!!! ���ѧ�͹��Ң���Կ����� !!!! �ҧ���ѹ�������ҹ
mysql_query("SET NAMES TIS620", $shs);