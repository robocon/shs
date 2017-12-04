<?php
  include("connect.inc");
    print "<a href='../nindex.htm'><< ไปเมนู</a><br>";

//runno  to find date established
    $query = "SELECT title,startday FROM runno WHERE title = 'RXAC'";
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

    $dStartday=$row->startday;

    $query ="UPDATE runno SET startday = now() WHERE title='RXAC'";
    $result = mysql_query($query) or die("Query failed");
    echo mysql_errno() . ": " . mysql_error(). "\n";
    echo "<br>";
//end  runno  to establish date
print "เริ่มใช้เมื่อ $dStartday<br>";

   $query="SELECT row_id FROM druglst Order by row_id DESC limit 0,1 ";
   $result = mysql_query($query);
   list($xRec) = mysql_fetch_row($result);


print "จำนวน records $xRec<br>";
  for ($n=1; $n<=$xRec; $n++){
    $query = "SELECT tradname,rxaccum FROM druglst WHERE row_id = $n ";
    $result = mysql_query($query) or die("Query druglst failed");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    if(mysql_num_rows($result)){
          $cTradname=$row->tradname;
          $nRxaccum = $row->rxaccum;

print "แถวที่................= $n,$cTradname<br>";
print "rxaccum..........= $nRxaccum<br>";

        $query ="UPDATE druglst SET  rxaccum = 0
                       WHERE row_id=$n ";
        $result = mysql_query($query) or die("Query failed,update druglst, $n");
        echo mysql_errno() . ": " . mysql_error(). "\n";
        echo "<br>";
print "rxaccum ตั้งค่า 0 เรียบร้อย, แถวที่ $n<br><br>";

      }
  }
print "<br>rxaccumทั้งหมด ตั้งค่า 0 เรียบร้อย<br>";
print "<br><a href='../nindex.htm'><< ไปเมนู</a><br>";

include("unconnect.inc");
?>








