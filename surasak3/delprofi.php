<?php
  session_start();
  include("connect.inc");
	$query = "delete from dgprofile where row_id ='$cRow_id'";
	$result = mysql_query($query) or die("�������öź��¡����");
	print " ź��¡���͡�ҡ  drug profile ���º����: <br>";
	print " �Դ˹�ҵ�ҧ���, refresh drug profile, ��Ǩ�ͺ�š��ź��������";
  include("unconnect.inc");
  session_unregister("cRow_id");
?>



