<?php
    session_start();
    echo "การสั่งยาตามสูตรที่กำหนดไว้";
?>
<table>
 <tr>
  <th bgcolor=CC9900>สูตร</th>
  <th bgcolor=CC9900>รายการ</th>
  <th bgcolor=CC9900>ราคา</th>
  <th bgcolor=CC9900>จำนวน</th>
  <th bgcolor=CC9900>วิธีใช้</th>
 </tr>
<?php
    $dr=substr($sOfficer,0,5);
    include("connect.inc");
    $query = "SELECT suitcode,detail,price,amount,slipcode,depart FROM labsuit WHERE depart = 'PHAR' and idname LIKE '$dr%' ORDER BY suitcode ASC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($suitcode, $detail, $price,$amount,$slipcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><a target='top'  href=\"dgsuitinfo.php? Dgcode=$suitcode\">$suitcode</a></td>\n".
           "  <td BGCOLOR=99CCFF>$detail</td>\n".
           "  <td BGCOLOR=99CCFF>$price</td>\n".
           "  <td BGCOLOR=99CCFF>$amount</td>\n".
           "  <td BGCOLOR=99CCFF>$slipcode</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>


