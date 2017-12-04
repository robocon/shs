<?php
/*
    $mward  = '41';
    $fward    = '42';
    $gward   = '43';
    $icuward = '44';
    $vipward =  '45';
*/
 print "<b>ค่ารักษาพยาบาลผู้ป่วยในทั้งหมด</b>&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ipdcost.php'>รวมเงินผู้ป่วยทุกคน</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a><br>";
    print "<font face='Angsana New'>** คลิกชื่อ -> คำนวนค่ารักษาพยาบาล  (ไม่รวมค่าห้องค่าอาหารเนื่องจากยังไม่จำหน่าย)<br>";  
    include("connect.inc");

    $ward='41'; //mward
    print "หอผู้ป่วยชาย<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>เตียง</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>ชื่อผู้ป่วย</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>โรค</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>สิทธิการรักษา</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>ราคา</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>จ่าย</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>ค้างจ่าย</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>แพทย์</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>วันคำนวน</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,doctor,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$doctor,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_blank  href=\"ipaccrep.php? cAn=$an&cAccno=$accno&cPtname=$ptname&cHn=$hn&cBed=$bed&cPtright=$ptright\">$ptname</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$doctor</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";
// $fward    = '42';
    $ward='42'; //mward
    print "หอผู้ป่วยหญิง<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>เตียง</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>ชื่อผู้ป่วย</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>โรค</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>สิทธิการรักษา</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>ราคา</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>จ่าย</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>ค้างจ่าย</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>แพทย์</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>วันคำนวน</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,doctor,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$doctor,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'><a target=_blank  href=\"ipaccrep.php? cAn=$an&cAccno=$accno&cPtname=$ptname&cHn=$hn&cBed=$bed&cPtright=$ptright\">$ptname</a></td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$doctor</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";

// $gward   = '43';
    $ward='43'; //mward
    print "หอผู้ป่วยสูติ-นรี<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>เตียง</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>ชื่อผู้ป่วย</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>โรค</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>สิทธิการรักษา</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>ราคา</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>จ่าย</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>ค้างจ่าย</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>แพทย์</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>วันคำนวน</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,doctor,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$doctor,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'><a target=_blank  href=\"ipaccrep.php? cAn=$an&cAccno=$accno&cPtname=$ptname&cHn=$hn&cBed=$bed&cPtright=$ptright\">$ptname</a></td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$doctor</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
// $icuward = '44';
    $ward='44'; //mward
    print "หอผู้ป่วยวิกฤต(ICU)<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>เตียง</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>ชื่อผู้ป่วย</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>โรค</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>สิทธิการรักษา</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>ราคา</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>จ่าย</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>ค้างจ่าย</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>แพทย์</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>วันคำนวน</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,doctor,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$doctor,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_blank  href=\"ipaccrep.php? cAn=$an&cAccno=$accno&cPtname=$ptname&cHn=$hn&cBed=$bed&cPtright=$ptright\">$ptname</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$doctor</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
// $vipward =  '45';
    $ward='45'; //mward
    print "หอผู้ป่วยพิเศษ<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>เตียง</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>ชื่อผู้ป่วย</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>โรค</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>สิทธิการรักษา</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>ราคา</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>จ่าย</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>ค้างจ่าย</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>แพทย์</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>วันคำนวน</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,doctor,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$doctor,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_blank  href=\"ipaccrep.php? cAn=$an&cAccno=$accno&cPtname=$ptname&cHn=$hn&cBed=$bed&cPtright=$ptright\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
    include("unconnect.inc");
?>
