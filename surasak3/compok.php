<?php
include("connect.inc");
/*
  comcode  comname  comaddr   ampur  changwat   tel
*/

      $sql = "INSERT INTO company(comcode,comname,comaddr,
	            ampur,changwat,tel,fax,comtype)VALUES('$comcode','$comname',
    	           '$comaddr','$ampur','$changwat','$tel','$fax','$type');";
     $result = mysql_query($sql);
if ($result){
        print "���ʺ���ѷ  :$comcode<br>";
        print "���ͺ���ѷ    :$comname<br>";
        print "����������ѷ  :$comaddr<br>";
        print "ࢵ/����� :$ampur<br>";
        print "�ѧ��Ѵ     :$changwat<br>";
        print "���Ѿ��       :$tel<br>";
		print "�����        :$fax<br>";
        print "�ѹ�֡���������º����<br>";
	}	
   else { 
        print "<br><br><br>���ʺ���ѷ  :$comcode  ��Ӣͧ��� �ô���<br>";
           }
include("unconnect.inc");
?>








