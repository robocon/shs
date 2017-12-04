<?php
//    $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
    $Thdate = date("d-m-").(date("Y")+543).'   '.date("H:i:s");
    print "รายงานเมื่อ $Thdate<br>";
    print "รายการอาหาร หอผู้ป่วยชาย<br>";
?>
<table>
 <tr>
  <th>เตียง</th>
  <th>ชื่อผู้ป่วย</th>
 <th>โรค</th>
 <th>อาหาร</th>
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
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
<?php
    print "--------------------------------------<br>";
    print "รายการอาหาร หอผู้ป่วยหญิง<br>";
?>
<table>
 <tr>
  <th>เตียง</th>
  <th>ชื่อผู้ป่วย</th>
 <th>โรค</th>
 <th>อาหาร</th>
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
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
<?php
    print "----------------------------------------<br>";
    print "รายการอาหาร หอผู้ป่วยสูตินรี<br>";
?>
<table>
 <tr>
  <th>เตียง</th>
  <th>ชื่อผู้ป่วย</th>
 <th>โรค</th>
 <th>อาหาร</th>
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
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
<?php
    print "----------------------------------------------<br>";
    print "รายการอาหาร หอผู้ป่วยหนัก (ICU)<br>";
?>
<table>
 <tr>
  <th>เตียง</th>
  <th>ชื่อผู้ป่วย</th>
 <th>โรค</th>
 <th>อาหาร</th>
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
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
<?php
    print "---------------------------------------<br>";
    print "รายการอาหาร หอผู้ป่วยพิเศษ<br>";
?>
<table>
 <tr>
  <th>เตียง</th>
  <th>ชื่อผู้ป่วย</th>
 <th>โรค</th>
 <th>อาหาร</th>
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
           "  <td><font face='Angsana New'>$bed</td>\n".
           "  <td><font face='Angsana New'>$ptname</td>\n".
           "  <td><font face='Angsana New'>$diagnos</td>\n".
           "  <td><font face='Angsana New'>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
---------หมดรายการ------------




