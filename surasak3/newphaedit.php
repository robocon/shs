<?php
 
/*
 
*/
    print "��䢻�С��˹����ͧ������ $Thaidate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< �����</a><br>";
    include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>��ͤ���</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>���</b></th>";
     print "</tr>";

    $query = "SELECT  newpha FROM newpha  ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($newpha) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$newpha</td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"newphaedit1.php? newpha=$newpha\">���</td>\n".

 
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

