<?php
    session_start();
    session_destroy();
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>���Ҥ������ HN number �ҡ&nbsp; XN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; XN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="xn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"></p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>XN</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>ʡ��</th>
 </tr>

<?php
If (!empty($xn)){
    include("connect.inc");
    global $xn;
    $query = "SELECT xn,hn,name,surname FROM xrayno WHERE xn = '$xn'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($xn,$hn,$name,$surname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$xn</td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
