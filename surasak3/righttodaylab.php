<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R01�Թʴ</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R02�ԡ��ѧ </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R03�ä�ѡ�ҵ�����ͧ </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R04�Ѱ����ˡԨ </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R05 ����ѷ</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R06�ú </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R07��Сѹ�ѧ�� </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R08 �� 44 </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R09 30 �ҷ (30�ҷ) </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R10  30�ҷ</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R11 30 �ҷ</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R12 </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R13 </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R14 </b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R15  ��Сѹ�آ�Ҿ�ѡ���¹</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R16 �֡�Ҹԡ��</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R17  �ŷ���</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>


</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R18  �ç����ä�</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R19  �ç��ù��</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>

</table>
<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä </b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
	  print "<br><font face='Angsana New' size='2'><b>�Է��   :  R20 ���.���Է������</b>";

    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
    <th bgcolor=6495ED>�Է��</th>

  

  </tr>

<?php
//    $detail="�����";
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
 print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>