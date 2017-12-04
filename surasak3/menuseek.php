<?php
 
/*
 
*/
    print "รายการเมนู$Thaidate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a><br>";
    include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>MENU</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>โปรแกรม</b></th>";
  print "<th bgcolor=CD853F><font face='Angsana New'><b>แผนก</b></th>";
  


    print "</tr>";

    $query = "SELECT  menu,script,menucode FROM menulst  ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($menu,$script,$menucode) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$menu</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$script</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$menucode</td>\n".
           
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

