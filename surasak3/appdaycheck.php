<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ӹǹ���駷��Ѵ���ç��Һ��</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>HN</th>
 <th bgcolor=CD853F>����-ʡ��</th>
  <th bgcolor=CD853F>ᾷ��</th>
  <th bgcolor=CD853F>�ѹ�Ѵ</th>
  <th bgcolor=CD853F>�Ѵ����</th>
  <th bgcolor=CD853F>���ҹѴ</th>
  <th bgcolor=CD853F>�ź</th>
  <th bgcolor=CD853F>�͡�����</th>
  <th bgcolor=CD853F>���</th>
 </tr>

<?php
If (!empty($hn)){

	$month["01"]="���Ҥ�";
    $month["02"]="����Ҿѹ��";
    $month["03"]="�չҤ�";
    $month["04"]="����¹";
    $month["05"]="����Ҥ�";
    $month["06"]="�Զع�¹";
    $month["07"]="�á�Ҥ�";
    $month["08"]="�ԧ�Ҥ�";
    $month["09"]="�ѹ��¹";
    $month["10"]="���Ҥ�";
    $month["11"]="��Ȩԡ�¹";
    $month["12"]="�ѹ�Ҥ�";

	$day_now = date("d");
	$month_now = date("m");
	$year_now = (date("Y")+543);

	$select_day2 = $day_now." ".$month[$month_now]." ".$year_now;

    include("connect.inc");
    global $hn;
    $query = "SELECT row_id, hn,ptname,doctor,appdate,apptime,detail,patho,xray,other,date,(case when appdate = '".$select_day2."' then '#009966' else '#F5DEB3' end),injno FROM appoint WHERE hn = '$hn' ORDER BY date DESC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($row_id,$hn,$ptname,$doctor,$appdate,$apptime,$detail,$patho,$xray,$other,$date,$color,$injno) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR='".$color."'><A HREF=\"appinsert2.php?row_id=".$row_id."\" target=\"_blank\">$hn</A></td>\n".
           "  <td BGCOLOR='".$color."'><A HREF=\"appdayprint.php?row_id=".$row_id."\" target=\"_blank\">$ptname</A></td>\n".
           "  <td BGCOLOR='".$color."'>".substr($doctor,6)."</td>\n".
           "  <td BGCOLOR='".$color."'>$appdate</td>\n".
			"  <td BGCOLOR='".$color."'>$detail</td>\n".
		    "  <td BGCOLOR='".$color."'>$apptime</td>\n".
           "  <td BGCOLOR='".$color."'>$patho</td>\n".
           "  <td BGCOLOR='".$color."'>$xray</td>\n".
           "  <td BGCOLOR='".$color."'>$other$injno</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
