<?php
    print  "ตรวจสอบยาเวชภัณฑ์ในคลังยาตาม ชื่อการค้า<br> ";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="dgtrad.php">ชื่อการค้า ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="tradname" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ตกลง     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>

  <th bgcolor=CC9900><font face='Angsana New'>ทุน</th>
  <th bgcolor=CC9900><font face='Angsana New'>ขาย</th>
  <th bgcolor=CC9900><font face='Angsana New'>กำไร(%)</th>
  <th bgcolor=CC9900><font face='Angsana New'>เบิกได้?</th>

  <th bgcolor=6495ED><font face='Angsana New'>จ่ายสะสม</th>
  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ในคลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ในห้องยา</th>
  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>
  <th bgcolor=6495ED><font face='Angsana New'>เหลือ?เดือน</th>
 </tr>

<?php
If (!empty($tradname)){
    include("connect.inc");
    //runno  to find date established
    $query = "SELECT title,startday FROM runno WHERE title = 'RX1D'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $dStartday=$row->startday;

    $query = "SELECT drugcode,tradname,unitpri,salepri,part,rx1day,totalstk,mainstk,stock,rxrate,stkpmon FROM druglst  WHERE tradname LIKE '$tradname%' ";
     $result = mysql_query($query)
        or die("Query failed");
    print "<font face='Angsana New'>จ่ายสะสมเริ่มนับเมื่อ $dStartday (ถ้าต้องการตั้งค่า 0 ไปที่เมนู set 0 การจ่ายยา)<br>";
    print "ใช้/เดือน คืออัตราการจ่ายต่อเดือน <br>";
    print "เหลือ ? เดือน คือยังมีเหลือใช้ได้กี่เดือน (เหลือสุทธิ/อัตราการจ่ายต่อเดือน)";
    while (list ($drugcode, $tradname,$unitpri,$salepri,$part,$rx1day,$totalstk,$mainstk,$stock,$rxrate,$stkpmon) = mysql_fetch_row ($result)) {
        if ($unitpri <>0 and $salepri <> 0 ){
            $profit=($salepri - $unitpri)*100/$unitpri;
            $profit=number_format($profit,1);
		}
        else {
	$xUnitpri =0;
	$xSalepri=0;
	$profit=0;
	}
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".

           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unitpri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$profit</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$part</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rx1day</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkpmon</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>


 