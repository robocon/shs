<?php
    session_start();
    if (isset($sIdname)){} else {die;}
?>
   �ͼ����ª�� (��¡�������) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a target=_BLANK href="foodprn.php">�������¡�������</a>&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><<��Ѻ����</a>
<table>
 <tr>
  <th bgcolor=6495ED>��§</th>
  <th bgcolor=6495ED>���ͼ�����</th>
 <th bgcolor=6495ED>�ä</th>
 <th bgcolor=6495ED>�����</th>
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
           "  <td BGCOLOR=66FFCC>$bed</td>\n".
           "  <td BGCOLOR=66FFCC>$ptname</td>\n".
           "  <td BGCOLOR=66FFCC>$diagnos</td>\n".
           "  <td BGCOLOR=66FFCC>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>

   �ͼ�����˭ԧ (��¡�������)
<table>
 <tr>
  <th bgcolor=6495ED>��§</th>
  <th bgcolor=6495ED>���ͼ�����</th>
 <th bgcolor=6495ED>�ä</th>
 <th bgcolor=6495ED>�����</th>
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
           "  <td BGCOLOR=66FFCC>$bed</td>\n".
           "  <td BGCOLOR=66FFCC>$ptname</td>\n".
           "  <td BGCOLOR=66FFCC>$diagnos</td>\n".
           "  <td BGCOLOR=66FFCC>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>

   �ͼ������ٵԹ�� (��¡�������)
<table>
 <tr>
  <th bgcolor=6495ED>��§</th>
  <th bgcolor=6495ED>���ͼ�����</th>
 <th bgcolor=6495ED>�ä</th>
 <th bgcolor=6495ED>�����</th>
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
           "  <td BGCOLOR=66FFCC>$bed</td>\n".
           "  <td BGCOLOR=66FFCC>$ptname</td>\n".
           "  <td BGCOLOR=66FFCC>$diagnos</td>\n".
           "  <td BGCOLOR=66FFCC>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>

   �ͼ�����˹ѡ (ICU) (��¡�������) 
<table>
 <tr>
  <th bgcolor=6495ED>��§</th>
  <th bgcolor=6495ED>���ͼ�����</th>
 <th bgcolor=6495ED>�ä</th>
 <th bgcolor=6495ED>�����</th>
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
           "  <td BGCOLOR=66FFCC>$bed</td>\n".
           "  <td BGCOLOR=66FFCC>$ptname</td>\n".
           "  <td BGCOLOR=66FFCC>$diagnos</td>\n".
           "  <td BGCOLOR=66FFCC>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>

   �ͼ����¾����  (��¡�������) 
<table>
 <tr>
  <th bgcolor=6495ED>��§</th>
  <th bgcolor=6495ED>���ͼ�����</th>
 <th bgcolor=6495ED>�ä</th>
 <th bgcolor=6495ED>�����</th>
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
           "  <td BGCOLOR=66FFCC>$bed</td>\n".
           "  <td BGCOLOR=66FFCC>$ptname</td>\n".
           "  <td BGCOLOR=66FFCC>$diagnos</td>\n".
           "  <td BGCOLOR=66FFCC>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>





