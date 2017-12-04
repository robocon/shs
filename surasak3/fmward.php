<?php
    session_start();
    if (isset($sIdname)){} else {die;}
?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size:18px;
}
-->
</style>
   <span class="font1">หอผู้ป่วยชาย (รายการอาหาร) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a target="_blank" href="ffwprn_new.php?id=41">พิมพ์รายการอาหาร</a>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="ffwprn_new2.php?id=41">พิมพ์บัตรอาหาร</a>
   &nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><<กลับเมนู</a>
   </span>
<table class="font1">
  <tr>
    <th bgcolor=6495ED class="font1">เตียง</th>
    <th bgcolor=6495ED class="font1">ชื่อผู้ป่วย</th>
    <th bgcolor=6495ED class="font1">โรค</th>
    <th bgcolor=6495ED class="font1">อาหาร</th>
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

