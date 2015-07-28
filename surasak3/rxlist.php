<?php
global $d, $m, $yr;
    $today="$d-$m-$yr";
	
    print "<font face='Angsana New'>วันที่ $today  รายการใบสั่งยา ";
    print "(คลิกชื่อเพื่อทำสลากยา,  คลิกจ่ายเงินเมื่อจ่ายยาให้คนไข้เพื่อลงเวลา)";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "&nbsp<a target=_self  href='rx1date.php'>ดูคนใหม่</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>ค่ายา</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
  <th bgcolor=6495ED>จ่ายยา</th>
    <th bgcolor=6495ED>สิทธิ</th>
 <th bgcolor=6495ED>เจ้าหน้าที่</th>

  </tr>

<?php
    $detail="ค่ายา";
    $num=0;
    include("connect.inc");

//if($hn!='';){$hn1='and hn='$hn'';};

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright,phapt FROM phardep WHERE date LIKE '$today%'  ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright,$phapt) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
    $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"rxdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"dgtake.php? sDate=$date&sHn=$hn&nRow_id=$row_id&sPtname=$ptname\">$price</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"dgtake.php? sDate=$date&sHn=$hn&nRow_id=$row_id&sPtname=$ptname\">$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".

	
			         "  <td BGCOLOR=66CDAA>$ptright</td>\n".
 "  <td BGCOLOR=66CDAA>$phapt</td>\n".

           " </tr>\n");
       }
print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>




