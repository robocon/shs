<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);
    $appd=$appdate.' '.$appmo.' '.$thiyr;
    print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจ</b><br>";
    print "<b>แพทย์:</b> $doctor <br>"; 
  
    print "<b>นัดมาวันที่</b> $appd<br> ";
   print "วัน/เวลาทำการตรวจสอบ....$Thaidate"; 
    print ".........<input type=button onclick='history.back()' value=' << กลับไป '>.....</a>";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>

  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
  <th bgcolor=6495ED>ผลการค้นหาประวัติ</th>
  <th bgcolor=6495ED>พิมพ์ใบสั่งยา?</th>
  <th bgcolor=6495ED>หมายเหตุ</th>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT hn,ptname,apptime,came,row_id,age FROM appoint WHERE appdate = '$appd' and doctor = '$doctor' ORDER BY apptime ";
    $result = mysql_query($query)
        or die("Query failed");
    $num=0;
    while (list ($hn,$ptname,$apptime,$came,$row_id,$age) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>ค้นพบ////ไม่พบ</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>พิมพ์////ไม่พิมพ์</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>...................................................</a></td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




