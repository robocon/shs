<?php
    $today="$d-$m-$yr";
    print "วันที่ $today  รายชื่อคนไข้ที่ทำหัตถการ  หรือตรวจวิเคราะห์โรค";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>แผนก</th>
  <th bgcolor=6495ED>รายการ</th>
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
  </tr>

<?php
//    $detail="ค่ายา";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno FROM depart WHERE date LIKE '$today%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"invdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</td>\n".
           "  <td BGCOLOR=66CDAA>$detail</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>





