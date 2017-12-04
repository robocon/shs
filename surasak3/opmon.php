<?php
//    session_start();
    $today="$d-$m-$yr";
    print "วันที่ $today  บัญชีรายรับผู้ป่วยนอก ";
    print "&nbsp;&nbsp;&nbsp<a target=_BLANK  href='opmonrep.php'>สรุปเงินรายรับ</a>";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>แผนก</th>
  <th bgcolor=6495ED>รายการ</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
  <th bgcolor=6495ED>จนท.เก็บเงิน</th>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT date_format(date,'%H:%i'),hn,an,depart,detail,paid,idname FROM opacc WHERE date LIKE '$today%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$hn,$an,$depart,$detail,$paid,$idname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$date</td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</td>\n".
           "  <td BGCOLOR=66CDAA>$detail</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
           "  <td BGCOLOR=66CDAA>$idname</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




