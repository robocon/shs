<?php
    session_start();
    if (isset($sIdname)){} else {die;}
?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size:18px;
}
-->
</style>
   <span class="font1">�ͼ����ª�� (��¡�������) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a target="_blank" href="ffwprn_new.php?id=41">�������¡�������</a>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="ffwprn_new2.php?id=41">�����ѵ������</a>
   &nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><<��Ѻ����</a>
   </span>
<table class="font1">
  <tr>
    <th bgcolor=6495ED class="font1">��§</th>
    <th bgcolor=6495ED class="font1">���ͼ�����</th>
    <th bgcolor=6495ED class="font1">�ä</th>
    <th bgcolor=6495ED class="font1">�����</th>
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

