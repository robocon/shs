<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R01&nbsp;�Թʴ";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R02&nbsp;�ԡ��ѧ";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R03&nbsp;�ä�ѡ�ҵ�����ͧ";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R04&nbsp;�Ѱ����ˡԨ";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R05&nbsp;����ѷ(��Ҫ�)";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R06&nbsp;�ú";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R07&nbsp;��Сѹ�ѧ��";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R08&nbsp;��44";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R09&nbsp;30�ҷ(30�ҷ)";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R10&nbsp;30�ҷ";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R11&nbsp;30�ҷ";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R12&nbsp;30�ҷ";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R13&nbsp;30�ҷ";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R14&nbsp;30�ҷ";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R15&nbsp;��Сѹ�آ�Ҿ�ѡ���¹";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R16&nbsp;����͡��";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R17&nbsp;�ŷ���";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R18&nbsp;�ç����ѡ���ä�";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R19&nbsp;�ç��ù��";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡����ػ������ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
	 print "<br><font face='Angsana New'>R20&nbsp;���.��Է������";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>�Է��</th>

  </tr>

<?php
    $detail="�����";
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
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>

</table>
