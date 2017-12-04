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
           "  <td>$bed</td>\n".
           "  <td>$ptname</td>\n".
           "  <td>$diagnos</td>\n".
           "  <td>$food</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
---------จบรายงาน------------
