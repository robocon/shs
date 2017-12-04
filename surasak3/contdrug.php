<?php
    session_start();
  //  print  "<font face='Angsana New'><b>[CONTINUE]</b>...เฉพาะรายการที่ใช้ (ON)  &nbsp;&nbsp;&nbsp;<a  href='contall.php'>(ดูรายการทั้ง	หมด)</a>&nbsp;&nbsp;&nbsp;<a target=_blank href='contrxa.php'>พิมพ์ใบเบิกยา</a> ";
	print  "<font face='Angsana New'><b>[CONTINUE]</b>...เฉพาะรายการที่ใช้ (ON)  &nbsp;&nbsp;&nbsp;<a  href='contall.php'>(ดูรายการทั้ง	หมด)</a>&nbsp;&nbsp;&nbsp; ";
?>
<table>
 <tr>
  <th bgcolor=9999CC><font face='Angsana New'>#</th>
   <th bgcolor=9999CC><font face='Angsana New'>วันที่</th>
   <th bgcolor=9999CC><font face='Angsana New'>รายการ</th>
   <th bgcolor=9999CC><font face='Angsana New'>หน่วยนับ</th>
   <th bgcolor=9999CC><font face='Angsana New'>วิธิใช้</th>
   <th bgcolor=9999CC><font face='Angsana New'>จำนวน</th>
   <th bgcolor=9999CC><font face='Angsana New'>สถานะ</th>
   <th bgcolor=9999CC><font face='Angsana New'>วันที่ OFF</th>
   <th bgcolor=9999CC><font face='Angsana New'>แก้ไข?</th>
 </tr>
<?php
    $n=0;
    include("connect.inc");
        //an,part,idno,totalamt,totalpri,statcon,onoff,officer
        $query = "SELECT   date,tradname,unit,slcode,amount,onoff,dateoff ,row_id
                         FROM dgprofile  WHERE an = '$cAn' and statcon='CONT' and onoff='ON' ORDER BY date ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($date,$tradname,$unit,$slcode,$amount,$onoff,$dateoff,$row_id
	) = mysql_fetch_row ($result)) {
            $n++;
            $date=substr($date,0,10);
            $dateoff=substr($dateoff,0,10);
            print (" <tr>\n".
               "  <td bgcolor=99CCCC>$n</td>\n".
               "  <td bgcolor=99CCCC><font face='Angsana New'>$date</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$unit</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$slcode</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$amount</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$onoff</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$dateoff</td>\n".
           //    "  <td bgcolor=99CCCC><font face='Angsana New'><a target=_BLANK href=\"drugoff.php? Delrow=$row_id\">แก้ไข</td>\n".
               " </tr>\n");
               }
   include("unconnect.inc");
?>
</table>


 