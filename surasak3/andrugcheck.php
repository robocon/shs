<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ������ҵ�� an</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; an&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="an" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>

<table>
 <tr>

  <th bgcolor=CD853F>�ѹ����</th>
 <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>����</th>
  <th bgcolor=CD853F>��¡��</th>
  <th bgcolor=CD853F>�ӹǹ</th>
  <th bgcolor=CD853F>���˹�ҷ��</th>
 </tr>

<?php
If (!empty($an)){
    include("connect.inc");
    global $an;
    $query = "SELECT date,an,code,detail,amount,idname FROM ipacc WHERE an = '$an' and depart = 'PHAR' " ;
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$an,$code,$detail,$amount,$idname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".

           "  <td BGCOLOR=F5DEB3>$date</td>\n".
           "  <td BGCOLOR=F5DEB3>$an</td>\n".
      "  <td BGCOLOR=F5DEB3>$code</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$detail</td>\n".
      "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$idname</td>\n".
   
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
