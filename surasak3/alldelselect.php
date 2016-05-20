<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  เลือกคลิกรายการที่ต้องการยกเลิก หรือส่งข้อมูลเข้าบัญชีผู้ป่วยใน ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=#669999>#</th>
  <th bgcolor=#669999>เวลา</th>
  <th bgcolor=#669999>ชื่อ</th>
  <th bgcolor=#669999>HN</th>
  <th bgcolor=#669999>AN</th>
  <th bgcolor=#669999>รายการ</th>
  <th bgcolor=#669999>ราคารวม</th>
  <th bgcolor=#669999>จ่ายเงิน</th>
  </tr>

<?php
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,detail,price,paid,row_id,accno FROM depart WHERE  date LIKE '$today%' and (tvn ='$vn' or an ='$vn')";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$detail,$price,$paid,$row_id,$accno) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
        print (" <tr>\n".
           "  <td BGCOLOR=#C0C0C0>$num</td>\n".
           "  <td BGCOLOR=#C0C0C0>$time</td>\n".
           "  <td BGCOLOR=#C0C0C0><a target=_BLANK  href=\"labdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=#C0C0C0>$hn</td>\n".
           "  <td BGCOLOR=#C0C0C0>$an</td>\n".
           "  <td BGCOLOR=#C0C0C0>$detail</td>\n".
           "  <td BGCOLOR=#C0C0C0>$price</td>\n".
           "  <td BGCOLOR=#C0C0C0>$paid</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




