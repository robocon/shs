<?php

    $today="$d-$m-$yr";

    print "<font face='Angsana New' size='3'>�ѹ��� $today  ��ª��ͤ�������ѵ����  ���͵�Ǩ���������ä";

    print "&nbsp;&nbsp;&nbsp<input type=button onclick='history.back()' value='<< ��Ѻ�'>";

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
  <th bgcolor=6495ED>�Է��</th>

  </tr>



<?php

//    $detail="�����";

    $num=0;

    include("connect.inc");

  

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright,tvn FROM depart WHERE date LIKE '$today%' and depart='XRAY'  ";

    $result = mysql_query($query)
	or die("Query failed");
    //$query = "SELECT ptright FROM opcard WHERE hn='$hn'";
   // $result = mysql_query($query)

    //    or die("Query failed");



    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright,$tvn) = mysql_fetch_row ($result)) {

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
	    "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");

       }
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");

?>

</table>



 







