<?php
 
/*
 
*/
    print "รายชื่อแพทย์ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a><br>";
    include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>ชื่อแพทย์</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>สถานะ</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>codeแผนก</b></th>";
 print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>แก้ไข</b></th>";
//  print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
  //  print " <th bgcolor=CD853F><font face='Angsana New'><b>ลบรายการ</b></th>";
    print "</tr>";

    $query = "SELECT name,status,menucode FROM doctor order by name ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($name,$status,$menucode) = mysql_fetch_row ($result)) {

if($status=='n'){$color='#FF6666';}else{$color='F5DEB3';};

        print ("<tr>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$name</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$status</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$menucode</td>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'></td>\n".
        "  <td bgcolor=$color><font face='Angsana New'><a target=_BLANK href=\"doctoredit1.php? idname=$idname\" >แก้ไข</td>\n".
 //       "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
    // "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"inputmdele.php? idname=$idname\" >ลบ</td>\n".
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

