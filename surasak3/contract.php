<?php
  include("connect.inc");
   print "<a href='../nindex.htm'><font face='Angsana New'><< �����</a><br>";
   print "- ��§ҹ���Ǫ�ѳ������ contract <br>";
   $n=0;    //�Ѻ�ӹǹ record
////////////

      print "<table>";
      print " <tr>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>%contract</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>����ѷ</th>";
      print " </tr>";

        $query = "SELECT drugcode,tradname,contract,comname FROM druglst where contract >0 ";
        $result = mysql_query($query) or die("Query druglst failed");
 //       echo mysql_errno() . ": " . mysql_error(). "\n";
//        echo "<br>";

    while(list($drugcode,$tradname,$contract,$comname) = mysql_fetch_row ($result)) {
		$n++; 
         print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$contract</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".

           " </tr>\n");

      }

print "</table>";

print "<br><a href='../nindex.htm'><< �����</a><br>";

include("unconnect.inc");