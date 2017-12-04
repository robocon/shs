<?php
    session_start();//for security
    if (isset($sIdname)){} else {die;} //for security
    $today="$d-$m-$yr";
    print "วันที่ $today  คนไข้ทำหัตถการหรือตรวจวิเคราะห์โรค(ค้างจ่ายเงิน)";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED>แผนก</th>
  <th bgcolor=6495ED>รายการ</th>
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=F08080>เบิกไม่ได้</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
  </tr>

<?php
//    $detail="ค่ายา";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,ptright,depart,detail,price,sumnprice,paid,row_id,accno FROM depart WHERE date LIKE '$today%'  ORDER BY ptname";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$ptright,$depart,$detail,$price,$sumnprice,$paid,$row_id,$accno) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
//        if ($paid=='0'){
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"opitem.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=FFE4C4><font face='Angsana New'>$sumnprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$paid</td>\n".
           " </tr>\n");
//       }
       }
    include("unconnect.inc");
?>
</table>






