<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

 //   print "รายชื่อผู้ป่วยในทั้งหมด ณ วันที่ $Thaidate &nbsp;&nbsp;<a target=_self  href='ipptchk1.php'><<  ตรวจสอบห้องว่าง</a>&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a><br>";
    include("connect.inc");
   $query = "SELECT  depart,new,datetime FROM new  ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($depare,$new,$datetime) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$new</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$datetime</td>\n".

           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>
