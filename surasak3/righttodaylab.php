<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R01เงินสด</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R01%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R02เบิกคลัง </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R02%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R03โรครักษาต่อเนื่อง </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R03%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R04รัฐวิสาหกิจ </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R04%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R05 บริษัท</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R05%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R06พรบ </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R06%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R07ประกันสังคม </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R07%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R08 กท 44 </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R08%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R09 30 บาท (30บาท) </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R09%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R10  30บาท</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R10%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R11 30 บาท</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R11%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R12 </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R12%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R13 </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R13%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R14 </b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R14%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R15  ประกันสุขถาพนักเรียน</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R15%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11); 
$totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R16 ศึกษาธิการ</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R16%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R17  พลทหาร</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R17%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
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
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R18  โครงการโรคไต</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R18%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
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
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R19  โครงการนภา</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R19%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
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
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>สิทธิ   :  R20 ปกส.ใช้สิทธิสามี</b>";

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
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>

  

  </tr>

<?php
//    $detail="ค่ายา";
$totalpri=0;
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright FROM depart WHERE date LIKE '$today%' and ptright LIKE 'R20%'  ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
 $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</a></td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
			     "  <td BGCOLOR=66CDAA>$ptright</td>\n".


           " </tr>\n");
       }
 print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>