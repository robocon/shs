<table>
 <tr>
  <th bgcolor=6495ED>��úѭ</th>
 </tr>
<?php
    include("connect.inc");

    print "<font face='Angsana New' size='5'>&nbsp;&nbsp;���͡����������ʹ���¡���� &nbsp;&nbsp;&nbsp <a target=_self                 href='../nindex.htm'> <<�˹�Ҩ���ѡ</a></font>";

    $query = "SELECT title,page FROM content";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($title, $page) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target=_self  href=\"dpage.php? cTitle=$title& cPage=$page\">$title</a></td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>


