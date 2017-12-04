<?php
    session_start();
    include("connect.inc");
  
    print"<table>";
    print" <tr>";
    print"  <th bgcolor=99FF66><font face='Angsana New'>วันที่/เวลา รับยา</th>";
    print"  <th bgcolor=99FF66><font face='Angsana New'>รายการ</th>";
    print"  <th bgcolor=99FF66><font face='Angsana New'>จำนวน</th>";
    print"  <th bgcolor=99FF66><font face='Angsana New'>ราคา</th>";
    print"  <th bgcolor=99FF66><font face='Angsana New'>วิธีใช้</th>";
    print" </tr>";

    $query = "SELECT date,tradname,amount,price,slcode,drugcode,idno FROM drugrx WHERE hn = '$cHn' ";
    $result = mysql_query($query)
        or die("Query failed");

    print "<font face='Angsana New'>$cPtname, HN: $cHn, สิทธิ:$cPtright<br> ";

    while (list ($date,$tradname,$amount,$price,$slcode,$drugcode,$idno) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66FFFF><font face='Angsana New'><a target='top'  href=\"drm.php? rmidno=$idno\">
$date</a></td>\n".
           "  <td BGCOLOR=66FFFF><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66FFFF><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=66FFFF><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66FFFF><font face='Angsana New'>$slcode</td>\n".
           " </tr>\n");
      }
    include("unconnect.inc");
    print"</table>";
?>

