<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);
    $appd=$appdate.' '.$appmo.' '.$thiyr;
    print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ</b><br>";
    print "<b>ᾷ��:</b> $doctor <br>"; 
  
    print "<b>�Ѵ���ѹ���</b> $appd<br> ";
   print "�ѹ/���ҷӡ�õ�Ǩ�ͺ....$Thaidate"; 
    print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>.....</a>";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>

  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED>�š�ä��һ���ѵ�</th>
  <th bgcolor=6495ED>�����������?</th>
  <th bgcolor=6495ED>�����˵�</th>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT hn,ptname,apptime,came,row_id,age FROM appoint WHERE appdate = '$appd' and doctor = '$doctor' ORDER BY apptime ";
    $result = mysql_query($query)
        or die("Query failed");
    $num=0;
    while (list ($hn,$ptname,$apptime,$came,$row_id,$age) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>�鹾�////��辺</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>�����////�������</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>...................................................</a></td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




