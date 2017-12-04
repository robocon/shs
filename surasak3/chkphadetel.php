<table>
 <tr>
  <th bgcolor=6495ED>ลำดับ</th>
  <th bgcolor=6495ED>code</th>
  <th bgcolor=6495ED>วัน-เวลา</th>
  <th bgcolor=6495ED>ชื่อ-สกุล</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>รายการ</th>
 </tr>

<?php
If (!empty($drugcode)){
    include("connect.inc");
   $query="CREATE TEMPORARY TABLE drugrx1 SELECT * FROM drugrx WHERE date LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,opday");
    $query = "SELECT date,hn,drugcode,tradname,amount FROM drugrx1 WHERE drugcode = '$drugcode'";
    $result = mysql_query($query)
        or die("query failed,opcard");
 $n=0;
    while (list ($date,$hn,$drugcode,$tradname,$amount) = mysql_fetch_row ($result)) {
  $n++;
$total=$total+$amount;
        print (" <tr>\n".

   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA>$drugcode</a></td>\n".
           "  <td BGCOLOR=66CDAA>$date</td>\n".
       "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$tradname</td>\n".

           "  <td BGCOLOR=66CDAA>$amount</td>\n".
                   " </tr>\n");
       }  print "รวมรายการจ่าย  $total ";
include("unconnect.inc");
       }
?>
</table>
