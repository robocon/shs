<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการใบสั่งยาจากแพทย์ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>&nbsp;&nbsp;<A HREF=\"dt_stikeropd.php?d=$d&m=$m&yr=$yr\">Refresh</A>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>เวลา</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>ค่ายา</th>
    <th bgcolor=6495ED><font face='Angsana New'>สิทธิ</th>
    <th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
 </tr>

<?php
    $detail="ค่ายา";
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,price,row_id,accno,ptright,doctor FROM dphardep WHERE ( whokey='DR' or whokey like 'HD%')  and date LIKE '$today%' ORDER BY row_id DESC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"dt_printstikeropd.php?id=$row_id\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><A target=_BLANK HREF=\"dt_printstikerappoint.php?hn=".urlencode($hn)."\">$hn</A></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
		   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
   		   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
		   " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




