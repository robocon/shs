<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>���Ҥ������ XN number �ҡ&nbsp; ���ʡ��</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="surname" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"></p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>XN</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>ʡ��</th>
 </tr>

<?php
If (!empty($surname)){
    include("connect.inc");
    global $surname;
    $query = "SELECT hn,xn,name,surname FROM xrayno WHERE surname LIKE '$surname%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$xn,$name,$surname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$xn</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
           " </tr>\n");
        }
include("unconnect.inc");
        }
?>
</table>
