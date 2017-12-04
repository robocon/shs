<?php
    session_start();
    $cDrname=substr($sOfficer,6);
    print"บัญชียาส่วนตัวของ นพ.$cDrname<br>";
    print "<font face='Angsana New' size='3'>แก้ไข,เพิ่มเติม  วิธีใช้ยา จำนวนเม็ดที่สั่ง&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคาขาย</th>
  <th bgcolor=6495ED><font face='Angsana New'>บัญชี</th>
  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>
  <th bgcolor=CD853F><font face='Angsana New'>รหัสวิธีใช้</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวนสั่ง</th>
  <th bgcolor=6495ED><font face='Angsana New'>แก้ไข</th>
  <th bgcolor=6495ED><font face='Angsana New'>ลบทิ้ง</th>
 </tr>

<?php
    include("connect.inc");
    $n=0;
    $cDoctor=substr($sOfficer,0,5);
    $query = "SELECT drugcode,tradname,genname,unit,salepri,part,drugtype,slcode,amount,doctor,row_id FROM drdglst
                    WHERE doctor ='$cDoctor' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$unit,$salepri,$part,$drugtype,$slcode,$amount,$doctor,$row_id) =     mysql_fetch_row ($result)) {
        $n++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugtype</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$slcode</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"drdgedit.php? Dgcode=$drugcode\">แก้ไข</a></td>\n".
           "  <td BGCOLOR=66CDAA><a href=\"drdgdele.php? Delrow=$row_id\">ลบทิ้ง</a></td>\n". 	
           " </tr>\n");
          }
   include("unconnect.inc");
?>
</table>



