<?php
include("connect.inc");
     $sql = "INSERT INTO labcare(code,depart,detail,price,yprice,nprice,part)
                  VALUES('$code','$depart','$detail','$price','$yprice','$nprice','$part');";
      $result = mysql_query($sql);
      if (mysql_errno() == 0){
           print "<br><br><br>";
           print "����      :$code<br>";
           print "Ἱ�   :$depart<br>";
           print "��¡�� :$detail<br>";
           print "�Ҥ����     :$price<br>";
print "�Ҥ��ԡ��    :$yprice<br>";
print "�Ҥ��ԡ�����     :$nprice<br>";
           print "������ :$part<br>";
           print "�ѹ�֡���������º����";
			}
      else { 
           print "<br><br><br>����  :$code  ��Ӣͧ��� �ô���<br>";
              }
include("unconnect.inc");
?>


