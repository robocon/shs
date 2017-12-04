<?php
//ใช้เพื่อแก้ไขปัญหาใน druglst  ไม่ได้ใช้ในโปรแกรมจริง
  include("connect.inc");
   print "<a href='../nindex.htm'><< ไปเมนู</a><br>";


   $query="SELECT row_id FROM druglst";
   $result = mysql_query($query);
   $xRec = mysql_num_rows($result);
print "จำนวน records $xRec<br>";
  for ($n=1; $n<=$xRec; $n++){
    $query = "SELECT * FROM druglst WHERE row_id = $n ";
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
          $nStock     = $row->stock;
          $nMainstk = $row->mainstk;
//          $nRxacc = $row->rxaccum;

       if ($nMainstk > 0){

          $nTotalstk = $nStock+$nMainstk;       

print "แถวที่................= $n,$cTradname<br>";
print "ในคลังยา...........= $nMainstk<br>";
print "ในห้องจ่ายยา......= $nStock<br>";
print "จำนวนทั้งสิ้น.......= $nTotalstk<br>";


        $query ="UPDATE druglst SET  mainstk = $nMainstk/2	
                       WHERE row_id=$n ";
        $result = mysql_query($query) or die("Query failed,update druglst, $n");
        echo mysql_errno() . ": " . mysql_error(). "\n";
        echo "<br>";
$nMainstk=$nMainstk/2;
print "ในคลังยา...........= $nMainstk<br>";
print "บันทึกข้อมูลเรียบร้อย แถวที่ $n<br><br>";
}
      }
  }
print "<br>บันทึกข้อมูลทั้งหมดเรียบร้อย<br>";
print "<br><a href='../nindex.htm'><< ไปเมนู</a><br>";

include("unconnect.inc");
?>






