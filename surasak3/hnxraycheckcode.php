<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ���X-RAY</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>

<table>
 <tr>
   <th bgcolor=CD853F>�ѹ�������</th>
  <th bgcolor=CD853F>HN</th>
 <th bgcolor=CD853F>VN</th>
  <th bgcolor=CD853F>����-ʡ��</th>
  <th bgcolor=CD853F>��¡��</th>
  <th bgcolor=CD853F>���� XRAY</th>
<th bgcolor=CD853F>ᾷ��</th>

 </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT date,hn,vn,yot,name,sname,detail,doctor,xrayno FROM xray_doctor WHERE hn = '$hn' ORDER BY date DESC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$hn,$vn,$yot,$name,$sname,$detail,$doctor,$xrayno) = mysql_fetch_row ($result)) {
		$ptname=$yot.''.$name.''.$sname;


        print (" <tr>\n".
			  "  <td BGCOLOR=F5DEB3>$date</td>\n".
           "  <td BGCOLOR=F5DEB3>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3>$vn</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3>$detail</td>\n".
			     "  <td BGCOLOR=#FF99CC>$xrayno</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$doctor</a></td>\n".
			
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
