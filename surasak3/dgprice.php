<?php
    $Thaidate=date("d/m/").(date("Y")+543);
    print  "ราคายา เวชภัณฑ์ และอุปกรณ์การแพทย์ $Thaidate<br> ";
    print "<font face='Angsana New'>ดูตามรหัส<br>";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">รหัสยา ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="drugcode" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ตกลง     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>
&nbsp;&nbsp;&nbsp;<a target=_BLANK href="dgprigp.php">ยาเวชภัณฑ์ และอุปกรณ์การแพทย์ทั้งหมด</a>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>    
  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>
  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>
 </tr>

<?php
If (!empty($drugcode)){
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

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE drugcode LIKE '$drugcode%' ";
     $result = mysql_query($query)
        or die("Query failed");

//    print "รหัสยาเวชภัณฑ์และอุปกรณ์<br> ";
    print "<font face='Angsana New'>DDL =   ยาในบัญชียาหลักแห่งชาติ เบิกได้<br> ";
    print "<font face='Angsana New'>DDY =   ยานอกบัญชียาหลักแห่งชาติ เบิกได้<br> ";
    print "<font face='Angsana New'>DDN =   ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้<br> ";
    print "<font face='Angsana New'>DPY =   อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน)<br> ";
    print "<font face='Angsana New'>DPN =   อุปกรณ์ ที่เบิกไม่ได้ <br>  ";
    print "<font face='Angsana New'>DSY =   เวชภัณฑ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน)<br> ";
    print "<font face='Angsana New'>DSN =   เวชภัณฑ์ ที่เบิกไม่ได้ ";

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>

 