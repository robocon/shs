<?php
    session_start();//for security
    if (isset($sIdname)){} else {die;} //for security
    $today="$d-$m-$yr";
    print "�ѹ��� $today  ������ѵ�������͵�Ǩ���������ä(��ҧ�����Թ)";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�Է��</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>��¡��</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=F08080>�ԡ�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  </tr>

<?php
//    $detail="�����";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,ptright,depart,detail,price,sumnprice,paid,row_id,accno FROM depart WHERE date LIKE '$today%'  ORDER BY ptname";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$ptright,$depart,$detail,$price,$sumnprice,$paid,$row_id,$accno) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
//        if ($paid=='0'){
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"opitem.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=FFE4C4><font face='Angsana New'>$sumnprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$paid</td>\n".
           " </tr>\n");
//       }
       }
    include("unconnect.inc");
?>
</table>






