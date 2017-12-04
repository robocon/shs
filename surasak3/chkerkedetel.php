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
If (!empty($code)){
    include("connect.inc");
  $query="CREATE TEMPORARY TABLE patdata1 SELECT * FROM patdata WHERE date LIKE '$yrmonth%' and depart = 'EMER' ";
    $result = mysql_query($query) or die("Query failed,opday");

    $query = "SELECT code,date,ptname,hn,detail FROM patdata1 WHERE code = '$code'";
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
