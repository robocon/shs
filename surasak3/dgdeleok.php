<?php
  session_start();
  include("connect.inc");
  $query = "delete from druglst where row_id ='$cDgrow'";
  $result = mysql_query($query) or die("�������öź��¡���͡�ҡ��¡����");
  print " ź $cDgcode,$cDgtrad �͡�ҡ�ѭ�����Ǫ�ѳ�����º����: <br>";
  print "  �Դ˹�ҵ�ҧ���   ���ǵ�Ǩ�ͺ�š��ź��������";
   session_unregister("cDgrow");
   session_unregister("cDgcode");
   session_unregister("cDgtrad");
   include("unconnect.inc");
?>



