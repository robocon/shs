<?
//��˹� ���ʹҵ������������� , ���Ͱҹ������ , ��͡�Թ ��� ���ʼ�ҹ ����Ѻ�Դ��͡Ѻ�ҹ���������Ѻ�����
$ServerName = "localhost";
$DatabaseName = "smdb";
$User = "root"; 
$Password = "1234";

//�Դ��͡Ѻ�ҹ�����ż�ҹ�ѧ��ѹ MySQL
$Conn = mysql_connect($ServerName,$User,$Password) or die ("�������ö�Դ��͡Ѻ�����������");

//���͡���Ͱҹ������ ��� smdb
mysql_select_db($DatabaseName,$Conn) or die ("�������ö�Դ��͡Ѻ�ҹ��������");


mysql_query("SET character_set_results=utf-8");
mysql_query("SET character_set_client=utf-8");
mysql_query("SET character_set_connection=utf-8")
/*
code ���
$link = mysql_pconnect("localhost", "sith", "")
        or die("Could not connect");

    mysql_select_db("smdb")
        or exit("Could not select database");
*/
?>


