<?php
    echo "รหัสยาเวชภัณฑ์";
?>
<table>
 <tr>
  <th bgcolor=CC9900>รหัส</th>
  <th bgcolor=CC9900>ชื่อการค้า</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT drugcode,tradname FROM druglst ORDER BY drugcode ASC";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF>$drugcode</a></td>\n".
           "  <td BGCOLOR=99CCFF>$tradname</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>

