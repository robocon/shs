<?php
session_start();
include("connect.inc");
        $query ="UPDATE drdglst SET slcode = '$slcode',
              			          amount = '$amount'
                       WHERE drugcode = '$sDgcode' ";
        $result = mysql_query($query)
                       or die("Query failed,update drdglst");
if ($result){
        print "������ :$sDgcode<br>";
//        print "���͡�ä�� :$cTrad<br>";
        print "�����Ը��� :$slcode<br>";
        print "�ӹǹ����� :$amount<br>";
        print "�ѹ�֡���������º����<br>";
	}	
   else { 
        print "<br><br><br>�������ö����� !<br>";
           }
include("unconnect.inc");
?>







