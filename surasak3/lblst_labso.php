<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>�ѹ��� $today  ����ҵ�Ǩ�آ�Ҿ��Шӻշ���</b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<�����</a></b>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>VN</th>
  <th bgcolor=6495ED>�ѧ�Ѵ</th>
  <!--<th bgcolor=6495ED>��¡��</th>
  <th bgcolor=6495ED>����Թ</th>
  <th bgcolor=6495ED>�����Թ</th>-->
    <th bgcolor=6495ED>�Է��</th>
	<th bgcolor=6495ED>ᾷ��</th>
	<th bgcolor=6495ED>��ᾷ���ѹ���</th>
	

  </tr>

<?php
//    $detail="�����";
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright,lab,doctor,idname,tvn FROM depart WHERE date LIKE '$today%' and depart='PATHO' and ptright like 'R22%' ";

    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright,$lab,$doctor,$idname,$tvn) = mysql_fetch_row ($result)) {
    $num++;
	
	$sql1="SELECT camp  FROM `opcard` WHERE hn='$hn' ";
	$result1 = mysql_query($sql1);
	$arrcamp=mysql_fetch_assoc($result1);
	

	
		$bgcolor= "'#66CDAA'";
		
	
    $time=substr($date,11);
        print (" <tr>\n".
           "  <td BGCOLOR=".$bgcolor."> $num</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$time</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$ptname</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$hn</td>\n".
		   "  <td BGCOLOR=".$bgcolor.">$tvn</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$arrcamp[camp]</td>\n".
		   "  <td BGCOLOR=".$bgcolor.">$ptright</td>\n".
		   "  <td BGCOLOR=".$bgcolor.">$doctor</td>\n".
		   "  <td BGCOLOR=".$bgcolor."></td>\n".
			" </tr>\n");
	}
    include("unconnect.inc");
?>
</table>





