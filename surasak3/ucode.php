<?php
//    session_start();
    echo "����˹��µ�ҧ�";
?>
<table>
 <tr>
  <th bgcolor=CC9900>����</th>
  <th bgcolor=CC9900>����˹���</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT depcode,depname FROM stkbill";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($depcode, $depname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF>$slipcode</td>\n".
           "  <td BGCOLOR=99CCFF>$detail1</td>\n".
           "  <td BGCOLOR=99CCFF>$detail2</td>\n".
           "  <td BGCOLOR=99CCFF>$detail3</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>


