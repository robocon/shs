<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'>�ѹ��� $today  ��ª��ͤ�������ѵ����  ���͵�Ǩ���������ä";
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
      <th bgcolor=6495ED>VN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>��¡��</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>
  </tr>

<?php
//    $detail="�����";
    $num=0;
    include("connect.inc");
  
//    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,tvn FROM depart WHERE date LIKE '$today%' and depart='PHYSI' ORDER BY ptname ";
	$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  Group by b.date ,b.hn,a.code";
	
	
	
    $result = mysql_query($query) or die("Query failed ".$query."");

    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$tvn) = mysql_fetch_row ($result)) {
    $num++;
    $time=substr($date,11);
    $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"invdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$an</td>\n".
		   "  <td BGCOLOR=66CDAA>$tvn</td>\n".
           "  <td BGCOLOR=66CDAA>$depart</td>\n".
           "  <td BGCOLOR=66CDAA>$detail</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           "  <td BGCOLOR=66CDAA>$paid</td>\n".
           " </tr>\n");
       }
print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>





