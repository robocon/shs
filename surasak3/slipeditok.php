<?php
session_start();
include("connect.inc");
        $query ="UPDATE drugslip SET detail1 = '$rxdetail1',
              			            detail2 = '$rxdetail2',
			            detail3 = '$rxdetail3',
			            detail4 = '$rxdetail4'
                       WHERE slcode = '$sSlcode' ";
        $result = mysql_query($query)
                       or die("Query failed,update drugslip");
if ($result){
        print "����     :$sSlcode<br>";
        print "�Ƿ�� 1:$rxdetail1<br>";
        print "�Ƿ�� 2:$rxdetail2<br>";
        print "�Ƿ�� 3:$rxdetail3<br>";
        print "�Ƿ�� 4:$rxdetail4<br>";
        print "�ѹ�֡���������º����<br>";
	}	
   else { 
        print "<br><br><br>�������ö����� !<br>";
           }
include("unconnect.inc");
?>







