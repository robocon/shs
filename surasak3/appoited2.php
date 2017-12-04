<?php
    $appd=$appdate.' '.$appmo.' '.$thiyr;
    print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจ</b><br>";
    print "<b>แผนก</b> $depcode <br>"; 
    print "<b>นัดมาวันที่</b> $appd ";
//    print ".........<input type=button onclick='history.back()' value=' << กลับไป '>";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
    <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>
	    <th bgcolor=6495ED><font face='Angsana New'>เจ้าหน้าที่</th>
  <th bgcolor=6495ED>มา?</th>
  <th bgcolor=6495ED>แก้ไข</th>
  <th bgcolor=6495ED>ยกเลิก</th>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT hn,ptname,appdate,apptime,came,row_id,age,depcode,officer FROM appoint WHERE appdate = '$appd' and depcode = '$depcode'  ";
    $result = mysql_query($query)
        or die("Query failed");
    $num=0;
    while (list ($hn,$ptname,$appdate,$apptime,$came,$row_id,$age,$depcode,$officer) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
		       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depcode</td>\n".
			         "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$came</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"editappoi.php? cRow=$row_id&cAppdate=$appdate&cApptime=$apptime\">แก้ไข</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"delappoi.php? cRow=$row_id\">ยกเลิก</a></td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




