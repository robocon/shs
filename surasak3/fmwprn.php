<?php
//    $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
    $Thdate = date("d-m-").(date("Y")+543).'   '.date("H:i:s");
    print "��§ҹ����� $Thdate<br>";
    print "��¡������� �ͼ����ª��<br>";
?>
<table>
 <tr>
  <th>��§</th>
  <th>���ͼ�����</th>
 <th>�ä</th>
 <th>�����</th>
 </tr>
<?php
    include("connect.inc");
 
    $query = "SELECT bed,ptname,diagnos,food,bedcode
                     FROM bed WHERE bedcode LIKE '41%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$ptname,$diagnos,$food,
                      $bedcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td>$bed</td>\n".
           "  <td>$ptname</td>\n".
           "  <td>$diagnos</td>\n".
           "  <td>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
---------����§ҹ------------
