<?php
 
/*
 
*/
    print "��ª��ͼ����ҹ$Thaidate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< �����</a><br>";
    include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>���ͼ����</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>����-���ʡ��</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>codeἹ�</b></th>";
 print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>���</b></th>";
  print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>ź��¡��</b></th>";
    print "</tr>";

    $query = "SELECT name,idname,menucode FROM inputm order by menucode ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($name,$idname,$menucode) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$idname</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$name</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$menucode</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"inputmedit1.php? idname=$idname\" >���</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
     "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"inputmdele.php? idname=$idname\" >ź</td>\n".
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

