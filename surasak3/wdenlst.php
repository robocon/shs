<?php
    $today="$d-$m-$yr";
    print "วันที่ $today  คนไข้ประกันสังคมที่ทำหัตถการหรือตรวจวิเคราะห์โรค";
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
  <th bgcolor=6495ED>รหัส</th>
  <th bgcolor=6495ED>รายการ</th>
  <th bgcolor=6495ED>รวมเงิน</th>
   <th bgcolor=6495ED>สิทธิ</th>
  </tr>

<?php
//    $detail="ค่ายา";
    $num=0;
    $netprice=0;
    include("connect.inc");
      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE                          '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$code,$detail,$price,$row_id,$ptright) = mysql_fetch_row ($result)) {
                 $num++;
 	$netprice = $netprice+$price;
                $time=substr($date,11);
    	     print (" <tr>\n".
	              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
	              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
	              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
 	              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
 	              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
	              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
 	              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
 	              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
	              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
	              " </tr>\n");
       }
    include("unconnect.inc");
  print "<br>รวมค่าบริการทั้งสิ้น  $netprice บาท";
?>
</table>





