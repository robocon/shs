<?php
    $appd=$appdate.' '.$appmo.' '.$thiyr;
    print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ</b><br>";
    print "<b>Ἱ�</b> $detail <br>"; 
    print "<b>�Ѵ���ѹ���</b> $appd ";
//    print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
    <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>
    <th bgcolor=6495ED><font face='Angsana New'>DIAG ��͹�Ѵ</th>
	    <th bgcolor=6495ED><font face='Angsana New'>���˹�ҷ��</th>
  <th bgcolor=6495ED>��?</th>
  <th bgcolor=6495ED>���</th>
  <th bgcolor=6495ED>¡��ԡ</th>
  <th bgcolor=6495ED>�����</th>
  </tr>

<?php
    include("connect.inc");
		
	if($_SESSION["sIdname"] == "�ѧ���")
		$where = " AND apptime != '¡��ԡ��ùѴ' ";

    $query = "SELECT hn,ptname,appdate,apptime,diag,came,row_id,age,depcode,officer FROM appoint WHERE appdate = '$appd' and detail = '$detail'  $where order by apptime ASC ";
    $result = mysql_query($query)
        or die("Query failed");
    $num=0;
    while (list ($hn,$ptname,$appdate,$apptime,$diag,$came,$row_id,$age,$depcode,$officer) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
		       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depcode</td>\n".
			    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
			         "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$came</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"editappoi.php? cRow=$row_id&cAppdate=$appdate&cApptime=$apptime\">���</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"delappoi.php? cRow=$row_id\">¡��ԡ</a></td>\n".
		   "  <td BGCOLOR=66CDAA><font face='Angsana New'><A HREF=\"appinsert2.php?row_id=".$row_id."\" target=\"_blank\">�����</a></td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




