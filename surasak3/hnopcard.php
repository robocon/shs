<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ٺѵõ�Ǩ�ä (opdcard)</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"></p>
</form>
  <a target=_self  href='../nindex.htm'><<�����</a>
<table>
 <tr>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>��</th>
  <th bgcolor=CD853F>����</th>
  <th bgcolor=CD853F>ʡ��</th>
 </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,yot,name,surname FROM opcard WHERE hn = '$hn'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"seopcard.php? cHn=$hn&cYot=$yot & cName=$name &cSurname=$surname\">$hn</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$yot</td>\n".
           "  <td BGCOLOR=F5DEB3>$name</td>\n".
           "  <td BGCOLOR=F5DEB3>$surname</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
