<input type="button" onclick="history.back();" value="       ��Ѻ      " /><br />
   ���͡���ͼ����·��������� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<table>
 <tr>
  <th bgcolor=CD853F>��§</th>
 <th bgcolor=CD853F>���ͼ�����</th>
 </tr>
<?php
    include("connect.inc");
 
    $query = "SELECT bed,ptname,bedcode FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$ptname,$bedcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$bed</td>\n".
           "  <td BGCOLOR=F5DEB3><a href=\"okchgwa.php?outbcode=$bedcode\" onclick=\"return confirm('�׹�ѹ���������§');\">$ptname</a></td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>

