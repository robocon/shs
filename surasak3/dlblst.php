<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  ᾷ�������¡�õ�Ǩ���������ä (��ԡ ����=����¡��, Ἱ�=��ʵԡ����)</b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b></font>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ԹԨ����ä</th>
  <th bgcolor=6495ED><font face='Angsana New'>����Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����Թ</th>
    <th bgcolor=6495ED><font face='Angsana New'>�Է��</th>
    <th bgcolor=6495ED><font face='Angsana New'>ᾷ��</th>
 </tr>

<?php
//    $detail="�����";
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




