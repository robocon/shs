<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R01&nbsp;เงินสด";
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

  </tr>

<?php
    $detail="ค่ายา";
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R01%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R02&nbsp;เบิกคลัง";
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

  </tr>

<?php
    $detail="ค่ายา";
    $num=0;
$totalpri=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R02%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R03&nbsp;โรครักษาต่อเนื่อง";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R03%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R04&nbsp;รัฐวิสาหกิจ";
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

  </tr>

<?php
    $detail="ค่ายา";
    $num=0;
$totalpri=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R04%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R05&nbsp;บริษัท(มหาชน)";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R05%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R06&nbsp;พรบ";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R06%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R07&nbsp;ประกันสังคม";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R07%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R08&nbsp;กท44";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R08%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R09&nbsp;30บาท(30บาท)";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R09%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R10&nbsp;30บาท";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R10%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R11&nbsp;30บาท";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R11%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R12&nbsp;30บาท";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R12%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R13&nbsp;30บาท";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R13%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R14&nbsp;30บาท";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R14%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R15&nbsp;ประกันสุขภาพนักเรียน";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R15%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R16&nbsp;ครูเอกชน";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R16%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R17&nbsp;พลทหาร";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R17%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);

 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R18&nbsp;โครงการรักษาโรคไต";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R18%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);

 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R19&nbsp;โครงการนภา";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R19%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);

 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R20&nbsp;ปกส.ใชสิทธิสามี";
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

  </tr>

<?php
    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R20%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);

 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>

</table>
