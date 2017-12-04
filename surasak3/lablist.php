<?php
    session_start();
    echo "$cTitle";
?>
<table>
 <tr>
  <th bgcolor=CC9900>รหัส</th>
  <th bgcolor=CC9900>รายการ</th>
  <th bgcolor=CC9900>ราคา</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT code,detail,price,depart FROM labcare WHERE depart = '$cDepart' ORDER BY code ASC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($code, $detail, $price) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF>$code</a></td>\n".
           "  <td BGCOLOR=99CCFF><a target='top'  href=\"dlistinfo.php? vCode=$code\">$detail</td>\n".
           "  <td BGCOLOR=99CCFF>$price</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>


