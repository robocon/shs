<?php
    session_start();//for security
    if (isset($sIdname)){} else {die;} //for security

    $today="$d-$m-$yr";
    print "�ѹ��� $today  ��ª��ͤ���������� �Ǫ�ѳ��(�ѧ���������Թ) ";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>�Է��</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����</th>
  <th bgcolor=F08080>�ԡ�����</th>
  <th bgcolor=6495ED>�����Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ѻ�ͧ�ҹ͡�ѭ������ѡ��觪ҵ�</th>
  </tr>

<?php
    $detail="�����";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,ptright,hn,an,price,paid,essd,nessdy,nessdn,dsy,dpy,dsn,dpn,row_id,accno,tvn FROM phardep WHERE date LIKE '$today%' and paid=0 ORDER BY ptname";

    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date, $ptname,$ptright,$hn,$an,$price,$paid,$essd,$nessdy,$nessdn,$dsy,$dpy,$dsn,$dpn,$row_id,$accno,$tvn) = mysql_fetch_row ($result)) {
		$num++;
		$time=substr($date,11);
			/*�鷴�ͺ  ���ź��� 
			$total=$essd+$nessdy+$nessdn+$dsy+$dpy+$dsn+$dpn;
			$oppay=$Nessdn+$DSY+ $DSN+$DPN;   //��.�͡�ԡ�����
			$ippay=$Nessdn+ $DSN+$DPN; //��.��ԡ�����
			*/
		$topay=0;
		if (empty($an)){    
			$topay=$nessdn+$dsy+ $dsn+$dpn;   //��.�͡�ԡ�����
				}
		if (!empty($an)){    
			$topay=$nessdn+ $dsn+$dpn; //��.��ԡ�����
				}
//	$nNetprice=number_format($nNetprice,2,'.',',');
			$topay=number_format($topay,2,'.',',');
//        if (empty($paid)){
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"oprxitem.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=FFE4C4><font face='Angsana New'>$topay</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"rxcertify.php? Fulname=$ptname&Nessdy=$nessdy\">�������Ѻ�ͧ��</td>\n".
           " </tr>\n");
//       }
}
    include("unconnect.inc");
?>
</table>




