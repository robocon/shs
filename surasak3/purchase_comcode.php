<p align="center"><strong>���ʺ���ѷ�� ʻ.���ᾷ��</strong></p>
<table align="center">
 <tr>
  <th bgcolor=#66CC99>����</th>
  <th bgcolor=#66CC99>���ͺ���ѷ</th>
  <th bgcolor=#66CC99>�������</th>
  <th bgcolor=#66CC99>���Ѿ��</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT comcode,comname,comaddr,ampur,changwat,tel FROM company WHERE comtype='pc' ORDER BY comcode ASC";
	//echo $query;
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



