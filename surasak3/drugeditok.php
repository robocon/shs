<?php
session_start();
include("connect.inc");
        $query ="UPDATE druglst SET bcode = '$bcode',slcode = '$slcode',drugnote = '$drugnote',drugtype = '$drugtype' ,had = '$had'  WHERE drugcode = '$sDgcode' ";
        $result = mysql_query($query)or die("Query failed,update druglst");
if ($result){
        print "������ :$sDgcode<br>";
        print "����͹������� :$drugnote<br>";
        print "�����Ը��� :$slcode<br>";
        print "������úѭ :$bcode<br>";
        print "�������� :$drugtype<br>";
        print "�ѹ�֡���������º����<br>";
	}	
   else { 
        print "<br><br><br>�������ö����� !<br>";
           }
include("unconnect.inc");
?>







