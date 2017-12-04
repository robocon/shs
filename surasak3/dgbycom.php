<?php
    print  "ตรวจสอบยาเวชภัณฑ์ในคลังยาตาม รหัสยา<br> ";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="comcode.php">รหัสบริษัท ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="comcode" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ตกลง     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>รหัสยา</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>

  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ในคลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ห้องยา</th>
  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>
  <th bgcolor=6495ED><font face='Angsana New'>เหลือ?เดือน</th>

  <th bgcolor=6495ED><font face='Angsana New'>ระดับ1/2เดือน</th>
  <th bgcolor=6495ED><font face='Angsana New'>ระดับ3เดือน</th>
 </tr>

<?php
  $n=0;
If (!empty($comcode)){
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

    $query = "SELECT drugcode,tradname,totalstk,mainstk,stock,rxrate,stkpmon,pack,packpri,comname FROM druglst  WHERE comcode = '$comcode' ";  
    $result = mysql_query($query) or die("Query failed");
	 for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	       }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }
        $cComname=$row->comname;
    if(mysql_num_rows($result)){
        print "<font face='Angsana New' size='5'>$comcode :$cComname <br>";
        print "<font face='Angsana New' size='2'>ใช้/เดือน คืออัตราการจ่ายต่อเดือน <br>";
        print "เหลือ ? เดือน คือยังมีเหลือใช้ได้กี่เดือน (เหลือสุทธิ/อัตราการจ่ายต่อเดือน)";

        $query = "SELECT drugcode,tradname,totalstk,mainstk,stock,rxrate,stkpmon,pack,packpri,comname FROM druglst  WHERE comcode = '$comcode' ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($drugcode,$tradname,$totalstk,$mainstk,$stock,
	$rxrate,$stkpmon,$pack,$packing
	) = mysql_fetch_row ($result)) {
            $n++;
            $halfmonth=$rxrate*.5;
            $trimonth    =$rxrate*3;
            print (" <tr>\n".
               "  <td bgcolor=6495ED>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".

               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkpmon</td>\n".

               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$halfmonth</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$trimonth</td>\n".
               " </tr>\n");
               }
	}
    else {
           die("ไม่พบรหัส $comcode ");
           }

   include("unconnect.inc");
          }
?>

</table>


 