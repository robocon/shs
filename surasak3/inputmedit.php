<?php
 
/*
 
*/
    print "รายชื่อผู้ใช้งาน$Thaidate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a><br>";
    include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>ชื่อผู้ใช้</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>ชื่อ-นามสกุล</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>codeแผนก</b></th>";
 print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>แก้ไข</b></th>";
  print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>ลบรายการ</b></th>";
    print "</tr>";

    $query = "SELECT name,idname,menucode FROM inputm order by menucode ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($name,$idname,$menucode) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$idname</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$name</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$menucode</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"inputmedit1.php? idname=$idname\" >แก้ไข</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
     "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"inputmdele.php? idname=$idname\" >ลบ</td>\n".
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

