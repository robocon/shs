<?php
    $today="$d-$m-$yr";
    print "วันที่ $today  ผลอ่าน การตรวจของแผนกรังสี   ";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>อ่าน?</th>
  <th bgcolor=CD853F><font face='Angsana New'>HN</th>
  <th bgcolor=CD853F><font face='Angsana New'>AN</th>
  <th bgcolor=CD853F><font face='Angsana New'>ผลการอ่าน</th>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>ภาพ</th>
  <th bgcolor=CD853F><font face='Angsana New'>แพทย์</th>
 </tr>

<?php
    include("connect.inc");

    $query = "SELECT copy,hn,an,ptname,detail,picture,doctor,date,report,row_id FROM patdata WHERE date Like '$today%' and depart='XRAY'";
    $result = mysql_query($query)
        or die("Query failed patdata");
    while (list ($copy,$hn,$an,$ptname,$detail,$picture,$doctor,$date,$report,$row_id) = mysql_fetch_row ($result)) {
        print (" <tr>\n".

           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$copy</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK  href=\"xryread.php? sDate=$date&cHn=$hn&cAn=$an&cName=$ptname&cDoctor=$doctor
		  &cDetail=$detail&nRow_id=$row_id\">$ptname</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK  href=\"xrread1.php? sDate=$date&cHn=$hn&cAn=$an&cName=$ptname&cDoctor=$doctor
		  &cDetail=$detail&nRow_id=$row_id\">$detail</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK  href=\"seepict.php? sPicture=$picture\">$picture</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$doctor</td>\n".
           " </tr>\n");
      }
    include("unconnect.inc");
?>
</table>

