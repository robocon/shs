<?php
    session_start(); //sDiscdate
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    print "<font face='Angsana New'>��ª��ͤ���㹷���˹�����ѹ��� $sDiscdate<br>";
?>
<table>
 <tr>
  <th>����</th>
  <th>HN</th>
  <th>AN</th>
  <th>����ѡ��</th>
  <th>���¡�͹</th>
  <th>�����ѹ���</th>
  <th>��ҧ����</th>
  <th>���.</th>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT ptname,hn,an,price,paid,cash,debt,idname FROM ipmonrep WHERE dcdate LIKE '$sDiscdate%' ";
    $result = mysql_query($query)
        or die("Query failed ipcard");

    while (list ($ptname,$hn,$an,$price,$paid,$cash,$debt,$idname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td>$ptname</td>\n".
           "  <td>$hn</td>\n".
           "  <td>$an</td>\n".
           "  <td>$price</td>\n".
           "  <td>$paid</td>\n".
           "  <td>$cash</td>\n".
           "  <td>$debt</td>\n".
           "  <td>$idname</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>

<?php
    print "<br>ŧ���� ........................................................ �����§ҹ<br>";
    print "��§ҹ�ѹ��� $Thaidate ";
?>

