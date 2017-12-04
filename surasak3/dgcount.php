<?php
  $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
  print "<font face='Angsana New' size='3'>ตรวจนับยาเวชภัณฑ์ในคลังยา ในห้องจ่ายยา <br>";
  print "<font face='Angsana New'>วันที่รายงาน : $Thaidate";
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">รหัสยา ?</a>&nbsp;&nbsp;
<input type="text" name="drugcode" size="10">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="  ตกลง  " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>ห้องจ่าย</th>
  <th bgcolor=6495ED><font face='Angsana New'>ในคลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>สุทธิ</th>
  <th bgcolor=6495ED><font face='Angsana New'>หมายเหตุ</th>

 </tr>

<?php
If (!empty($drugcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,unit,stock,mainstk,totalstk FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$unit,$stock,$mainstk,$totalstk) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".

           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>


