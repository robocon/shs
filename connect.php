<?php

$ServerName = "localhost";
$DatabaseName = "smdb";
$User = "root"; 
$Password = "1234";


$Conn = mysql_connect($ServerName,$User,$Password) or die ("�������ö�Դ��͡Ѻ�����������");

mysql_select_db($DatabaseName,$Conn) or die ("�������ö�Դ��͡Ѻ�ҹ��������");

?>