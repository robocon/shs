<?php
 
/*
 
*/
    print "��¡���Ѷ���$Thaidate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< �����</a><br>";
    include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>CODE</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>��¡��</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>�Ҥ����</b></th>";
 print "<th bgcolor=CD853F><font face='Angsana New'><b>�Ҥ��ԡ��</b></th>";
 print "<th bgcolor=CD853F><font face='Angsana New'><b>�Ҥ��ԡ�����</b></th>";
 


print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>���</b></th>";
  print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>ź��¡��</b></th>";
    print "</tr>";

    $query = "SELECT  code,detail,price,yprice,nprice FROM labcare order by code ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code,$detail,$price,$yprice,$nprice) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$yprice</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$nprice</td>\n".
            

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"labedit.php? code=$code\">���</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
     "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"lebdele.php? code=$code\">ź</td>\n".
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

