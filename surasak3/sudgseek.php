<?php
 session_start();
 print "ชื่อสูตร :$cSuitname<br>";
 print "รหัสสูตร :$cSuitcode<br>";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">รหัสยา</a>&nbsp;&nbsp;
<input type="text" name="drugcode" size="8">&nbsp;&nbsp;&nbsp;&nbsp;
  จำนวน  <input type="text" name="amount" size="4">&nbsp;</font>
  <p><font face="Angsana New"><a target=_BLANK href="slipcode.php">วิธีใช้</a>&nbsp;&nbsp;&nbsp;&nbsp; 
<input type="text" name="slipcode" size="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
<input type="submit" value="   ตกลง   " name="B1">
</font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>
 </tr>

<?php
If (!empty($drugcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,salepri FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$salepri) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='right'  href=\"suinfo.php? Dgcode=$drugcode& Amount=$amount& Trade=$tradname & Price=$salepri & Slcode=$slipcode\"><font face='Angsana New'>$drugcode</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>
