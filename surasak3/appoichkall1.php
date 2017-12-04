<?php
  $appd=$appdate.' '.$appmo.' '.$thiyr;
  
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE appoint SELECT * FROM appoint WHERE appdate = '$appd' ";
    $result = mysql_query($query) or die("Query failed,appoint");
//    echo mysql_errno() . ": " . mysql_error(). "\n";
//    echo "<br>";
////////////////////////
    print "<table>";
    print " <tr>";
    print "  <th>รายชื่อผู้ป่วยนัดประจำวันที่</th>";
    print " </tr>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=CD853F>แพทย์</th>";
    print "  <th bgcolor=CD853F>จำนวนคน</th>";
    print " </tr>";
//ประเภท ก
      $query="SELECT * FROM appoint WHERE doctor LIKE 'MD01%'";
      $result = mysql_query($query);
      $MD01 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>MD01</td>\n".
              "<td bgcolor=F5DEB3>$MD01</td>\n".
              " </tr>\n");

     
///////

     $G=$G31+$G32+$G33+$G34+$G35+$G36+$G37+$G38+$G39;
        print("<tr>\n".
                "<td bgcolor=CCCCCC>........................รวมประเภท ค</td>\n".
                "<td bgcolor=CCCCCC>$G</td>\n".
                " </tr>\n");

     $Gnet=$Gnet+$G;
        print("<tr>\n".
                "<td bgcolor=AAAAAA>........................รวมทั้งสิ้น</td>\n".
                "<td bgcolor=AAAAAA>$Gnet</td>\n".
                " </tr>\n");

        print("<tr>\n".
                "<td bgcolor=AAAAAA>........................จำนวนระเบียน</td>\n".
                "<td bgcolor=AAAAAA>$Grecords</td>\n".  
                " </tr>\n");

    include("unconnect.inc");
?>