<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  แพทย์สั่งรายการตรวจวิเคราะห์โรค (คลิก ชื่อ=ดูรายการ, แผนก=ทำสติกเกอร์)</b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>เวลา</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>
  <th bgcolor=6495ED><font face='Angsana New'>วินิจฉัยโรค</th>
  <th bgcolor=6495ED><font face='Angsana New'>รวมเงิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>จ่ายเงิน</th>
    <th bgcolor=6495ED><font face='Angsana New'>สิทธิ</th>
    <th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
 </tr>

<?php
//    $detail="ค่ายา";
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,depart,detail,price,paid,row_id,accno,ptright,doctor FROM ddepart WHERE date LIKE '$today%' and depart='PATHO'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$depart,$detail,$price,$paid,$row_id,$accno,$ptright,$doctor) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"dinvdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"dsticker.php? sDate=$date\">$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$paid</td>\n".
	     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
   	     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
		 " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




