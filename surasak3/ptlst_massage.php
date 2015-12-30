<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'>วันที่ $today  รายชื่อคนไข้ที่ทำหัตถการ  หรือตรวจวิเคราะห์โรค";
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
      <th bgcolor=6495ED>VN</th>
  <th bgcolor=6495ED>แผนก</th>
  <th bgcolor=6495ED>รายการ</th>
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
  </tr>

<?php
//    $detail="ค่ายา";
    $num=0;
    include("connect.inc");
  
//    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,tvn FROM depart WHERE date LIKE '$today%' and depart='PHYSI' ORDER BY ptname ";
	$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  Group by b.date ,b.hn,a.code";
	
	
	
    $result = mysql_query($query) or die("Query failed ".$query."");

    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$tvn) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
    $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"invdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
		   "  <td BGCOLOR=66CDAA>$tvn</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</td>\n".
           "  <td BGCOLOR=66CDAA>$detail</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
           " </tr>\n");
       }
print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>





