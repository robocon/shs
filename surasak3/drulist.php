<?php
    echo "�ѭ�����Ǫ�ѳ�� ���§������͡�ä��";
?>
&nbsp;&nbsp;&nbsp;<a  href="drulistg.php">���§����������ѭ</a>
<table>
 <tr>
  <th bgcolor=CC9900><font face='Angsana New'>����</th>
  <th bgcolor=CC9900><font face='Angsana New'>���͡�ä��</th>
    <th bgcolor=CC9900><font face='Angsana New'>�������ѭ</th>
  <th bgcolor=CC9900><font face='Angsana New'>�Ҥ�</th>
  <th bgcolor=CC9900><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=CC9900><font face='Angsana New'>�Ը���</th>
  <th bgcolor=CC9900><font face='Angsana New'>�ԡ��?</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT drugcode,tradname,genname,salepri,amount,slcode,part FROM drdglst ORDER BY tradname ASC";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($drugcode, $tradname,$genname,$salepri,$amount,$slcode,$part) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'><a target='bottom'  href=\"drlstpaste.php? 		dcode=$drugcode&amt=$amount&dslip=$slcode\">$tradname</a></td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$slcode</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>

