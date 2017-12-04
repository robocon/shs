<?php
    session_start();
    session_unregister("xNetpri");
    $xNetpri=$sNetpri;
    $Pocomrow=$nRow_id;
    session_register("Pocomrow");
    session_register("xNetpri");
    if (isset($sIdname)){} else {die;} //for security 
 ?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>หน่วยนับ</th>
   <th bgcolor=CD853F><font face='Angsana New'>ขนาดบรรจุ</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวนวางระดับ</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวนคงคลัง</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคาไม่รวมVAT</th>
   <th bgcolor=CD853F><font face='Angsana New'>จำนวนสั่ง</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคารวม</th>
  <th bgcolor=CD853F><font face='Angsana New'>แถม</th>
  <th bgcolor=CD853F><font face='Angsana New'>spec</th>
  <th bgcolor=CD853F><font face='Angsana New'>ลบ</th>
 </tr>
<?php
    $x=0;
    $sNetprice=0;
    include("connect.inc");

    $query = "SELECT drugcode,tradname,packing,pack,minimum,totalstk,packpri,amount,price,free,specno,row_id FROM poitems WHERE idno = '$nRow_id' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($drugcode,$tradname,$packing,$pack,$minimum,$totalstk,$packpri,$amount,$price,$free,$specno,$row_id) = mysql_fetch_row ($result)) {
	$x++;
	$sNetprice=$sNetprice+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$x</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK  href=\"packedit.php?  sRow_id=$row_id&sDrugcode=$drugcode\">$tradname</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$packing</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$pack</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$minimum</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$packpri</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$free</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$specno</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK  href=\"poitemdel.php?  Delrow=$row_id&sDrugcode=$drugcode&sTradname=$tradname&sPrice=$price\">ลบ</a></td>\n".
           " </tr>\n");
      }
    include("unconnect.inc");
    print "<font face='Angsana New'>$cComname;จำนวน $x รายการ;รวมงิน  $sNetprice บาท .....<b>(คลิกรายการเพื่อแก้ไขข้อมูล)</b><br>";
?>
</table>


