<?php
    $today="$thiyr-$appmo";
    print " $today<br>"; 
    print "<b>แพทย์:</b> $doctor <br>"; 
    print "<font face='Angsana New'><b>รายชื่อคนไข้ตรวจเดือน $appmo / $thiyr ........<input type=button onclick='history.back()' value=' << กลับไป '></b><br>";
//    print ".........<input type=button onclick='history.back()' value=' << กลับไป '>";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>วัน-เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>โรค</th>
  </tr>

<?php
    include("connect.inc");
    $query = "SELECT thidate,hn,ptname,an,diag FROM opday WHERE thidate LIKE '$today%'  and doctor = '$doctor' ";
    $result = mysql_query($query)
        or die("Query failed");
    $num=0;
    while (list ( $thidate,$hn,$ptname,$an,$diag ) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$thidate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




