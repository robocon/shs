<?php
include("connect.inc");
     $sql = "INSERT INTO inputm(name,idname,pword,menucode,status)
                  VALUES('$name','$idname','$pword','$menucode','$status');";
      $result = mysql_query($sql);
      if (mysql_errno() == 0){
           print "<br><br><br>";
           print "=����-���ʡ��      :$name<br>";
           print "���ʼ����   :$idname<br>";
           print "���ʼ�ҹ :$pword<br>";
           print "Ἱ�     :$menucode<br>";

           print "�ѹ�֡���������º����";
			}
      else { 
           print "<br><br><br>����  :$idname  ��Ӣͧ��� �ô���<br>";
              }
include("unconnect.inc");
?>


