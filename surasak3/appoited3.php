<?php
    $appd=$appdate.' '.$appmo.' '.$thiyr;
    print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ ".$detail."</b></font><br>";

    print "<b>�Ѵ���ѹ���</b> $appd ";
//    print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";
?>
<table width="90%">
	<tr>
		<th bgcolor=6495ED><font face='Angsana New'>�ѹ��͹��</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>����</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>HN</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>�������Ѿ��</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>�ѹ��͹�շ���Ѻ��</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>ᾷ��</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>�Ѵ������</font></th>
        <th bgcolor=6495ED><font face='Angsana New'>¡��ԡ</font></th>
	</tr>

<?php
    include("connect.inc");
		
		if($detail == "FU13 ��ͧ������"){
			$where = " OR detail = 'FU20 ��ͧ������(��Թԡ�����)' ";
		}else if($detail == "FU20 ��ͧ������(��Թԡ�����)"){
			$where = " OR detail = 'FU13 ��ͧ������' ";
		}

    $query = "SELECT a.row_id, date_format(a.date,'%d-%m-%Y'), a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, a.came, b.phone  FROM appoint as a INNER JOIN opcard as b ON a.hn = b.hn WHERE appdate like '%".$appd."' AND apptime != '¡��ԡ��ùѴ' and (detail = '$detail' $where ) Order by appdate ASC ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
    while (list ($row_id, $date, $officer, $hn, $ptname, $age, $doctor, $appdate, $apptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode, $came, $phone) = mysql_fetch_row ($result)) {
        $num++;
		if($num %2 ==0)
			$bgcolor = "#FFFFBB";
		else
			$bgcolor = "#FFFFFF";

		if($detail == "FU20 ��ͧ������(��Թԡ�����)"){
			$style = " style='color:#FF0000;' ";
		}else{
			$style = " style='color:#000000;' ";
		}

        print (" <tr bgcolor='".$bgcolor."'>\n".
"<td align='center'><font face='Angsana New'>$appdate<BR>$apptime </font></td>\n".
"<td><font face='Angsana New'>$ptname</font></td>\n".
"<td><font face='Angsana New'>$hn</font></td>\n".
"<td><font face='Angsana New'>$phone</font></td>\n".
"<td><font face='Angsana New'>$date</font></td>\n".
"<td><font face='Angsana New'>".substr($doctor,5)."</font></td>\n".
"<td ".$style." ><font face='Angsana New'>".substr($detail,4)."<BR>$detail2</font></td>\n".

"  <td><font face='Angsana New'><a target=_BLANK  href=\"delappoi.php? cRow=$row_id\">¡��ԡ</a></font></td>\n".

           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




