<?php
    session_start();
    echo "�������ҵ���ٵ÷���˹����";
?>
<table>
 <tr>
  <th bgcolor=CC9900>�ٵ�</th>
  <th bgcolor=CC9900>��¡��</th>
  <th bgcolor=CC9900>�Ҥ�</th>
  <th bgcolor=CC9900>�ӹǹ</th>
  <th bgcolor=CC9900>�Ը���</th>
 </tr>
<?php
    $dr=substr($sOfficer,0,5);
    include("connect.inc");
    $query = "SELECT suitcode,detail,price,amount,slipcode,depart FROM labsuit WHERE depart = 'PHAR' and idname LIKE '$dr%' ORDER BY suitcode ASC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($suitcode, $detail, $price,$amount,$slipcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><a target='top'  href=\"dgsuitinfo.php? Dgcode=$suitcode\">$suitcode</a></td>\n".
           "  <td BGCOLOR=99CCFF>$detail</td>\n".
           "  <td BGCOLOR=99CCFF>$price</td>\n".
           "  <td BGCOLOR=99CCFF>$amount</td>\n".
           "  <td BGCOLOR=99CCFF>$slipcode</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>


