<?php
    echo "บัญชียาเวชภัณฑ์ เรียงตามชื่อสามัญ";
?>
&nbsp;&nbsp;&nbsp;<a  href="drulist.php">เรียงตามชื่อการค้า</a>
<table>
 <tr>
  <th bgcolor=CC9900><font face='Angsana New'>รหัส</th>
  <th bgcolor=CC9900><font face='Angsana New'>ชื่อการค้า</th>
    <th bgcolor=CC9900><font face='Angsana New'>ชื่อสามัญ</th>
  <th bgcolor=CC9900><font face='Angsana New'>ราคา</th>
  <th bgcolor=CC9900><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CC9900><font face='Angsana New'>วิธีใช้</th>
  <th bgcolor=CC9900><font face='Angsana New'>เบิกได้?</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT drugcode,tradname,genname,salepri,amount,slcode,part FROM drdglst ORDER BY genname ASC";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($drugcode, $tradname,$genname,$salepri,$amount,$slcode,$part) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'><a target='bottom'  href=\"drlstpaste.php? 		dcode=$drugcode&amt=$amount&dslip=$slcode\">$genname</a></td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$slcode</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>

