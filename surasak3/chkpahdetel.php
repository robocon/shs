<table>
 <tr>
  <th bgcolor=6495ED>�ӴѺ</th>
  <th bgcolor=6495ED>code</th>
  <th bgcolor=6495ED>�ѹ-����</th>
  <th bgcolor=6495ED>����-ʡ��</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>��¡��</th>
 </tr>

<?php
If (!empty($code)){
    include("connect.inc");
   $query="CREATE TEMPORARY TABLE drugrx1 SELECT * FROM drugrx WHERE date LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,opday");
    $query = "SELECT date,hn,drugcode,treadname,amount FROM patdata1 WHERE drugcode = '$drugcode'";
    $result = mysql_query($query)
        or die("query failed,opcard");
 $n=0;
    while (list ($code,$date,$ptname,$hn,$detail) = mysql_fetch_row ($result)) {
  $n++;
        print (" <tr>\n".

   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA>$code</a></td>\n".
           "  <td BGCOLOR=66CDAA>$date</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</td>\n".
       "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$detail</td>\n".
                   " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
