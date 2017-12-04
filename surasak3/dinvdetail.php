<?php
    session_start();

    session_unregister("sRow_id");
    $sRow_id=$nRow_id;
    session_register("sRow_id");

    $dDate=$sDate;
    include("connect.inc");
  
    $query = "SELECT * FROM ddepart WHERE date = '$dDate'";
    $result = mysql_query($query)
        or die("Query failed");
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }
    $sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sDepart=$row->depart;
    $sDetail=$row->detail;  
    $sNetprice=$row->price;
    $sDiag=$row->diag;
    $cPaid=$sNetprice;

    print"<table>";
    print"<tr>";
    print"<th bgcolor=CD853F>รายการ</th>";
    print"<th bgcolor=CD853F>จำนวน</th>";
    print"<th bgcolor=CD853F>ราคา</th>";
    print"</tr>";

    $query = "SELECT detail,amount,price FROM dpatdata WHERE date = '$dDate' ";
    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "วันที่ $d/$m/$y<br>";
    print "$sPtname, HN: $sHn<br> ";
    print "โรค: $sDiag<br>";

    while (list ($detail,$amount, $price) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$detail</td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           " </tr>\n");
      }
    include("unconnect.inc");
    print"</table>";
    print "รวมงิน  $sNetprice บาท<br>";
    print "แพทย์ :$sDoctor<br>";
    print"<br><a  href='dlabok.php'>ตรวจถูกต้อง & ตกลง</a>";
    ?>


