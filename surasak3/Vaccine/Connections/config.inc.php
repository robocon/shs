
<?php

/*
$host = "BAJITA-PC" ; 
$username = "sa" ; 
$password = "pumin" ;
$db = "project_qa" ;  */



$host = "localhost" ; 
$username = "root" ; 
$password = "1234" ;
$db = "member_news" ; 

$connect = mysql_connect($host,$username,$password) ;

mysql_select_db($db) ;
/*$host2 = "172.168.1.254" ; 
$username2 = "root" ; 
$password2 = "1234" ;
$db2 = "smdb" ; 
mysql_select_db($db2) ;
$connect2 = mysql_connect($host2,$username2,$password2) ;*/

/*mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");*/

mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");

/////////////////////////databese///////////////////////






?>
