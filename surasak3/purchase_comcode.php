<p align="center"><strong>รหัสบริษัทยา สป.สายแพทย์</strong></p>
<table align="center">
 <tr>
  <th bgcolor=#66CC99>รหัส</th>
  <th bgcolor=#66CC99>ชื่อบริษัท</th>
  <th bgcolor=#66CC99>ที่อยู่</th>
  <th bgcolor=#66CC99>โทรศัพท์</th>
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



