<?php
    $today="$thiyr-$appmo";
    print " $today<br>"; 
    print "<b>ᾷ��:</b> $doctor <br>"; 
    print "<font face='Angsana New'><b>��ª��ͤ����Ǩ��͹ $appmo / $thiyr ........<input type=button onclick='history.back()' value=' << ��Ѻ� '></b><br>";
//    print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>�ѹ-����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�ä</th>
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




