<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  �����Ǩ���������ä (��ԡ ����=����¡��, Ἱ�=��ʵԡ����)</b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
   <th bgcolor=6495ED>�ӴѺ</th>
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


	<th bgcolor=6495ED>ᾷ��</th>
	
	

  </tr>

<?php
$i=1;
//    $detail="�����";
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright,lab,doctor,idname,tvn FROM depart WHERE date LIKE '$today%' and depart='PATHO'  ";

    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright,$lab,$doctor,$idname,$tvn) = mysql_fetch_row ($result)) {
    $num++;
	
	if(empty($lab) and $price >0 ){
		$bgcolor= "'#FF9966'";
		$pt = "<A HREF=\"runnolab.php? sDate=$date&gRow_id=$row_id\" target=\"_blank\">$ptright</A>";
	}else{
		$bgcolor= "'#66CDAA'";
		$pt = "$ptright";
	}

    $time=substr($date,11);
    $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=".$bgcolor." align='center'>$i</td>\n".
		   "  <td BGCOLOR=".$bgcolor.">$lab</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$time</td>\n".
           "  <td BGCOLOR=".$bgcolor."><a target=_BLANK  href=\"invdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=".$bgcolor.">$hn</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$an</td>\n".
			           "  <td BGCOLOR=".$bgcolor.">$tvn</td>\n".
           "  <td BGCOLOR=".$bgcolor."><a target=_BLANK  href=\"sticker4.php? sDate=$date&gRow_id=$row_id\">$depart</a></td>\n".
           "  <td BGCOLOR=".$bgcolor.">$detail</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$price</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$paid</td>\n".
			"  <td BGCOLOR=".$bgcolor.">".$pt."</td>\n".


   
			   "  <td BGCOLOR=".$bgcolor.">$doctor</td>\n".
			    //  "  <td BGCOLOR=".$bgcolor.">$idname</td>\n".
			" </tr>\n");
			$i++;
       }
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>





