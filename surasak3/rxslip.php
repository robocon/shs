<?php
    session_start();
    $cDcode=$cDrugcode;
    $cTrad=$cTradname;
    $cAmt=$cAmount;
    session_register("cDcode");
    session_register("cTrad");
    session_register("cAmt");
    echo "รหัสวิธีสั่งใช้ยา";
?>
<table>
 <tr>
  <th bgcolor=CC9900>รหัส</th>
  <th bgcolor=CC9900>วิธีใช้</th>
  <th bgcolor=CC9900>วิธีใช้</th>
  <th bgcolor=CC9900>วิธีใช้</th>
  <th bgcolor=CC9900>วิธีใช้</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT slcode,detail1,detail2,detail3,detail4 FROM drugslip ORDER BY slcode ASC";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($slcode, $detail1, $detail2,$detail3,$detail4) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><a target=_blank  href=\"rxsliprn.php? cDetail1=$detail1&cDetail2=$detail2&cDetail3=$detail3&cDetail4=$detail4\">$slcode</a></td>\n".
           "  <td BGCOLOR=99CCFF>$detail1</td>\n".
           "  <td BGCOLOR=99CCFF>$detail2</td>\n".
           "  <td BGCOLOR=99CCFF>$detail3</td>\n".
           "  <td BGCOLOR=99CCFF>$detail4</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>


