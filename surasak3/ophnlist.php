<?php
    $today="$d-$m-$yr";
    print "�ѹ��� $today  ��ª��ͤ������§���  HN ";
    print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
//    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor="#6699FF" text="#FFFFFF">#</th>
  <th bgcolor="#6699FF" text="#FFFFFF">VN</th>
  <th bgcolor="#6699FF" text="#FFFFFF">HN</th>
  <th bgcolor="#6699FF" text="#FFFFFF">����</th>
  <th bgcolor="#6699FF" text="#FFFFFF">AN</th>
  <th bgcolor="#6699FF" text="#FFFFFF">�ä</th>
  <th bgcolor="#6699FF" text="#FFFFFF">ᾷ��</th>
  </tr>

<?php
    $detail="�����";
    $num=0;
    include("connect.inc");
 
    $query = "SELECT vn,hn,ptname,an,diag,doctor FROM opday WHERE thdatehn LIKE '$today%' ORDER BY thdatehn  ASC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($vn,$hn,$ptname,$an,$diag,$doctor) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR='#33CCFF' text='#FFFFFF'><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR='#33CCFF' text='#FFFFFF'><font face='Angsana New'>$vn</td>\n".
           "  <td BGCOLOR='#33CCFF' text='#FFFFFF'><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR='#33CCFF' text='#FFFFFF'><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR='#33CCFF' text='#FFFFFF'><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR='#33CCFF' text='#FFFFFF'><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR='#33CCFF' text='#FFFFFF'><font face='Angsana New'>$doctor</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




