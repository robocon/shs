<?php
 session_start();
//print"$dcode,$amt<br>";

print "<form method='post' action='ddgseek.php'>";
print "�����  <font face='Angsana New'><a target=_BLANK href='drdgcode.php'>������</a>&nbsp;&nbsp;";
print "<input type='text' name='drugcode' size='8' value=$dcode>&nbsp;&nbsp;&nbsp;&nbsp;";
print "�ӹǹ  <input type='text' name='amount' size='4' value=$amt>&nbsp;&nbsp;&nbsp;<a target=_BLANK href='drulist.php'>�ѭ����</a></font>";
print "<p><font face='Angsana New'><a target=_BLANK href='drslcode.php'>�Ը���</a>&nbsp;&nbsp;&nbsp;&nbsp; ";
print "<input type='text' name='slipcode' size='8' value=$dslip>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ";
print "<input type='submit' value='    ��ŧ    ' name='B1'>";
print"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ptrm.php'>�����/RM</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='dgsuit.php'>�ٵ���</a>";
print "</font></p>";
print "</form>";
print "<table>";
print " <tr>";
print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
print " </tr>";

If (!empty($drugcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,salepri FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$salepri) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='top'  href=\"dinfo.php? Dgcode=$drugcode& Amount=$amount& Trade=$tradname & Price=$salepri & Slcode=$slipcode\"><font face='Angsana New'>$drugcode</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }


print "</table>";
?>