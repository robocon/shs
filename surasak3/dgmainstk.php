<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ��¡�������� ";
    print "(��ԡ�������ͷ���ҡ��,  ��ԡ�����Թ����ͨ�������餹������ŧ����)";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
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
  </tr>

<?php
    $detail="�����";
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake FROM phardep WHERE date LIKE '$today%' ORDER BY ptname ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"rxdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"dgtake.php? sDate=$date&sHn=$hn&nRow_id=$row_id&sPtname=$ptname\">$paid</a></td>\n".
           "  <td BGCOLOR=66CDAA>$dgtake</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




