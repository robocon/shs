
...............................................................................................��ª��ͼ����·�����..............................<br>
<?php
    $today="$d-$m-$yr";
    print "�ѹ��� $today  ��ª��ͤ������§����ӴѺ���ҡ�͹��ѧ";
    print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>VN</th>
<th bgcolor=6495ED>���</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�ä</th>
  <th bgcolor=6495ED>�Է��</th>
  <th bgcolor=6495ED>ᾷ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�͡��</th>
    <th bgcolor=#0099FF><font face='Angsana New'>�����Ѻ�ѵ�</th>
  <th bgcolor=#0099FF><font face='Angsana New'>���Ҩ��ºѵ�</th>
  <th bgcolor=#0099FF><font face='Angsana New'>����ᾷ���Ǩ</th>
    <th bgcolor=#0099FF><font face='Angsana New'>�����Ѻ������</th>
	  <th bgcolor=#0099FF><font face='Angsana New'>���ҵѴ��</th>
	    <th bgcolor=#0099FF><font face='Angsana New'>�������Թ</th>
		  <th bgcolor=#0099FF><font face='Angsana New'>���Ҩ�����</th>
  </tr>

<?php
    $detail="�����";
    include("connect.inc");
  
    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,time1,time2 FROM opday WHERE thidate LIKE '$today%' ";
    $result = mysql_query($query)
        or die("Query failed");
	$j=0;
	$countavg = 0;
    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$time1,$time2) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);


			print (" <tr>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$kew</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</a></td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$toborow</td>\n".
			"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time1</td>\n".
			"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time2</td>\n".
				"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time3</td>\n".
				"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time4</td>\n".
				"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time5</td>\n".
					"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time6</td>\n".
					"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time7</td>\n".
			" </tr>\n");
       }
	   echo "</table>\n";

$list["EX 91"]= "�͡ VN �� ����Ҿ";
$list["EX 92"]= "�͡ VN �� �ѧ���";
$list["EX 92"]= "�ѧ���";
$list["EX01"]= "�ѡ���ä�����������Ҫ���";

$list["EX02"]= "�����©ء�Թ";
$list["EX03"]= "��Ѥ��ç��è��µç";
$list["EX04"]= "�����¹Ѵ";

$list["EX05"]= "���";

$list["EX06"]= "�Ѵ��ͧ����";
$list["EX07"]= "�ѹ�����";
$list["EX10"]= "�����";
$list["EX11"]= "�ѡ���ä�͡�����Ҫ���";
$list["EX12"]= "�͹�ç��Һ��";
$list["EX13"]= "����͹�Ѵ";
$list["EX15"]= "�͡ VN";
$list["EX16"]= "��Ǩ�آ�Ҿ";
$list["EX17"]= "����Ҿ�ӺѴ";
$list["EX19"]= "�͡ VN ����";
$list["EX20"]= "�ǴἹ��";



$sql = "SELECT left(toborow,4) as toborow2,  sum( TIME_TO_SEC( SUBTIME( time2, time1 ) ) ) as time_s, count(toborow) as c_total FROM opday WHERE thidate LIKE '$today%' AND time1 != '' AND time2 != '' AND left(toborow,4) in ('EX01','EX02') group by toborow2 Order by toborow2 ASC ";
$result = Mysql_Query($sql) or die(Mysql_error());
print "<table>";
while($arr = Mysql_fetch_assoc($result)){
	
	$name_ex = trim($arr["toborow2"]);

	$avg = number_format($arr["time_s"]/$arr["c_total"],0);
	print "<tr><td>".$list[$name_ex]."</td><td>".date("H:i:s",mktime(0,0,0+$avg, date("m"), date("d"), date("Y")))."</td></tr>";

}
print "</table>";







    include("unconnect.inc");
?>
</table>




