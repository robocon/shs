<?php
    echo "���ʺ���ѷ��";
?>
<table>
 <tr>
  <th bgcolor=CC9900>����</th>
  <th bgcolor=CC9900>���ͺ���ѷ</th>
  <th bgcolor=CC9900>�������</th>
  <th bgcolor=CC9900>���Ѿ��</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT comcode,comname,comaddr,ampur,changwat,tel FROM company ORDER BY comcode ASC";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($comcode, $comname,$comaddr,$ampur,$changwat,$tel) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=#FFCC99>$comcode</td>\n".
           "  <td BGCOLOR=#FFCC99>$comname</td>\n".
		   "  <td BGCOLOR=#FFCC99>$comaddr $ampur $changwat</td>\n".
		   "  <td BGCOLOR=#FFCC99>$tel</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>



