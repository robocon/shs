<?php
    session_start();
    echo "รหัสวิธีสั่งใช้ยา";
?>
<table>
 <tr>
  <th bgcolor=#CC9900>รหัส</th>
  <th bgcolor=#CC9900>วิธีใช้</th>
  <th bgcolor=#CC9900>วิธีใช้</th>
  <th bgcolor=#CC9900>วิธีใช้</th>
  <th bgcolor=#CC9900>วิธีใช้</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT slcode,detail1,detail2,detail3,detail4 FROM drugslip ORDER BY slcode ASC";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($slcode, $detail1, $detail2,$detail3,$detail4) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=#CCCC00>$slcode</a></td>\n".
           "  <td BGCOLOR=#CCCC00>$detail1</td>\n".
           "  <td BGCOLOR=#CCCC00>$detail2</td>\n".
           "  <td BGCOLOR=#CCCC00>$detail3</td>\n".
           "  <td BGCOLOR=#CCCC00>$detail4</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>


