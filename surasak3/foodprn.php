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
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
<?php
    print "--------------------------------------<br>";
    print "��¡������� �ͼ�����˭ԧ<br>";
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
                     FROM bed WHERE bedcode LIKE '42%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$ptname,$diagnos,$food,
                      $bedcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
<?php
    print "----------------------------------------<br>";
    print "��¡������� �ͼ������ٵԹ��<br>";
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
                     FROM bed WHERE bedcode LIKE '43%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$ptname,$diagnos,$food,
                      $bedcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
<?php
    print "----------------------------------------------<br>";
    print "��¡������� �ͼ�����˹ѡ (ICU)<br>";
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
                     FROM bed WHERE bedcode LIKE '44%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$ptname,$diagnos,$food,
                      $bedcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
<?php
    print "---------------------------------------<br>";
    print "��¡������� �ͼ����¾����<br>";
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
                     FROM bed WHERE bedcode LIKE '45%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$ptname,$diagnos,$food,
                      $bedcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
---------�����¡��------------




