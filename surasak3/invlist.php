<?php
    $today="$d-$m-$yr";
    print "�ѹ��� $today  ��ª��ͤ�������ѵ����  ���͵�Ǩ���������ä";
    print "<a target=_self  href='../nindex.htm'><<�����</a>";
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
  <th bgcolor=6495ED>��¡��</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
  </tr>

<?php
//    $detail="�����";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno FROM depart WHERE date LIKE '$today%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"invdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</td>\n".
           "  <td BGCOLOR=66CDAA>$detail</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>





