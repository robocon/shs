<?php
    session_start();
    echo "$cTitle";
?>
<table>
 <tr>
  <th bgcolor=CC9900>�ٵ�</th>
  <th bgcolor=CC9900>��¡��</th>
  <th bgcolor=CC9900>�Ҥ�</th>
 </tr>
<?php
    $dr=substr($sOfficer,0,5);
    include("connect.inc");
    $query = "SELECT suitcode,detail,price,depart FROM labsuit WHERE depart = '$cDepart'  and idname LIKE     '$dr%' ORDER BY suitcode ASC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($suitcode, $detail, $price) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><a target='top'  href=\"dsuitinfo.php? vSuitcode=$suitcode\">$suitcode</a></td>\n".
           "  <td BGCOLOR=99CCFF>$detail</td>\n".
           "  <td BGCOLOR=99CCFF>$price</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>


