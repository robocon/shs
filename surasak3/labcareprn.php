<?php
    echo "หอผู้ป่วย: ค่าบริการทางการพยาบาล<br>";
?>
<table>
 <tr>
  <th bgcolor=CC9900>#</th>
  <th bgcolor=CC9900>รหัส</th>
  <th bgcolor=CC9900>รายการ</th>
  <th bgcolor=CC9900>ราคา</th>
  <th bgcolor=CC9900>แผนก</th>
  <th bgcolor=CC9900>กลุ่ม</th>
 </tr>
<?php
    $num=0;
    include("connect.inc");
// PATHO  XRAY  EMER  SURG  PHYSI  DENTA  WARD  OTHER
    $query = "SELECT code,detail,price,depart,part FROM labcare WHERE depart = 'WARD' ORDER BY code ASC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($code, $detail, $price,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>


