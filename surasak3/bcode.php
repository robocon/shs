<table>
 <tr>
  <th bgcolor=6495ED>สารบัญ</th>
  <th bgcolor=6495ED>รหัส</th>
 </tr>
<?php
    include("connect.inc");

    $query = "SELECT title,page FROM content";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($title, $page) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$title</td>\n".
           "  <td BGCOLOR=66CDAA>$page</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>


