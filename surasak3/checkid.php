<?php
   print"<br><b>��ª��ͼ����·���� �Ţ�ѵû�Шӵ�ǻ�ЪҪ���ӡѹ</b>";
 print"<br><b>��ԡ��� �Ţ�ѵû�Шӵ�ǻ�ЪҪ� ��Ǩ����Ң����ū�ӡѹ�������</b>";
print "&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a><br>";

 include("connect.inc");
   $query="SELECT  idcard,hn,name,surname,address ,COUNT(*) AS duplicate FROM opcard   GROUP BY idcard HAVING duplicate > 1";
   $result = mysql_query($query);
     $n=0;
 while (list ($idcard,$hn,$name,$surname,$adderss,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n,</td>\n".
              // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
      "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard</a></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>HN: $hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>����: $name</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>ʡ��: $surname</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ���駷���� = $duplicate</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");

    print"<br><b>��ª��ͼ����·���� ����-ʡ�ū�ӡѹ</b>";
 print"<br><b>��ԡ��� ���� ��Ǩ����Ң����ū�ӡѹ�������</b>";
print "&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a><br>";

 include("connect.inc");
   $query="SELECT  idcard,hn,name,surname,address,concat(name,surname),COUNT(*) AS duplicate FROM opcard    GROUP BY concat(name,surname)  HAVING duplicate > 1";
   $result = mysql_query($query);
     $n=0;
 while (list ($idcard,$hn,$name,$surname,$adderss,$fullname,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n,</td>\n".
              // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</a></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>HN: $hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checknamechk.php? fullname=$fullname\">����: $name</a></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>ʡ��: $surname</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ���駷���� = $duplicate</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");
 
?>

