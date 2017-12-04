<?php
    session_start();
    if (isset($sIdname)){} else {die;}
?>
   หอผู้ป่วยชาย (รายการอาหาร) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a target=_BLANK href="foodprn.php">พิมพ์รายการอาหาร</a>&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><<กลับเมนู</a>
<table>
 <tr>
  <th bgcolor=6495ED>เตียง</th>
  <th bgcolor=6495ED>ชื่อผู้ป่วย</th>
 <th bgcolor=6495ED>โรค</th>
 <th bgcolor=6495ED>อาหาร</th>
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

   หอผู้ป่วยหญิง (รายการอาหาร)
<table>
 <tr>
  <th bgcolor=6495ED>เตียง</th>
  <th bgcolor=6495ED>ชื่อผู้ป่วย</th>
 <th bgcolor=6495ED>โรค</th>
 <th bgcolor=6495ED>อาหาร</th>
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

   หอผู้ป่วยสูตินรี (รายการอาหาร)
<table>
 <tr>
  <th bgcolor=6495ED>เตียง</th>
  <th bgcolor=6495ED>ชื่อผู้ป่วย</th>
 <th bgcolor=6495ED>โรค</th>
 <th bgcolor=6495ED>อาหาร</th>
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

   หอผู้ป่วยหนัก (ICU) (รายการอาหาร) 
<table>
 <tr>
  <th bgcolor=6495ED>เตียง</th>
  <th bgcolor=6495ED>ชื่อผู้ป่วย</th>
 <th bgcolor=6495ED>โรค</th>
 <th bgcolor=6495ED>อาหาร</th>
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

   หอผู้ป่วยพิเศษ  (รายการอาหาร) 
<table>
 <tr>
  <th bgcolor=6495ED>เตียง</th>
  <th bgcolor=6495ED>ชื่อผู้ป่วย</th>
 <th bgcolor=6495ED>โรค</th>
 <th bgcolor=6495ED>อาหาร</th>
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





