<?php
    print"ตรวจสอบยาเวชภัณฑ์ของแต่ละบริษัทในคลังของโรงพยาบาล<br> ";
	print"ลบทิ้ง? คือลบออกจากบัญชียาเวชภัณฑ์ของโรงพยาบาล<br>";
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
  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา ED</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคาขาย</th>
  <th bgcolor=6495ED><font face='Angsana New'>กำไร(%)</th>
  <th bgcolor=6495ED><font face='Angsana New'>วางระดับ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ในคลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ห้องยา</th>
  <th bgcolor=6495ED><font face='Angsana New'>รวมทั้งหมด</th>  
  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>
  <th bgcolor=6495ED><font face='Angsana New'>เหลือ?เดือน</th>
  <th bgcolor=6495ED><font face='Angsana New'>packing</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา/pack</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา+vat/pack</th>
  <th bgcolor=CD853F><font face='Angsana New'>ลบทิ้ง?</th>
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

$date=date('Y-m-d');
$lastmonth=date('Y-m-d', strtotime("-3 month"));
//echo $lastmonth;

    $query = "SELECT drugcode,tradname,unitpri,edpri,salepri,minimum,totalstk,mainstk,stock,rxrate,stkpmon,pack,packpri,comname,row_id FROM druglst  WHERE comcode = '$comcode' ";  
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
//        $cComname=$row->comname;
        print "<font face='Angsana New' size='5'>$comcode :$cComname <br>";
//        print "<font face='Angsana New' size='2'>จ่ายสะสมเริ่มนับเมื่อ $dStartday (ถ้าต้องการตั้งค่า 0 ไปที่เมนู set 0 การจ่ายยา)<br>";
        print "<font face='Angsana New' size='2'>ใช้/เดือน คืออัตราการจ่ายต่อเดือน <br>";
        print "เหลือ ? เดือน คือยังมีเหลือใช้ได้กี่เดือน (เหลือสุทธิ/อัตราการจ่ายต่อเดือน)";

        $query = "SELECT drugcode,tradname,unitpri,edpri,salepri,minimum,totalstk,mainstk,stock,rxrate,stkpmon,
		pack,packpri,packpri_vat,row_id,comname FROM druglst  WHERE comcode = '$comcode' ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($drugcode,$tradname,$unitpri,$edpri,$salepri,$minimum,$totalstk,$mainstk,$stock,
	$rxrate,$stkpmon,$pack,$packpri,$packpri_vat,$row_id
	) = mysql_fetch_row ($result)) {
            $n++;
            $profit=($salepri - $unitpri)*100/$unitpri;
            $profit=number_format($profit,1);


		$sql1="select sum(stkcut) as amount from stktranx where drugcode ='$drugcode' and getdate between '$lastmonth' and '$date' ";
		//echo $sql1;
		$query1=mysql_query($sql1);
		list($amount)=mysql_fetch_array($query1);
		
		$rxrate3m=$amount/3;
		
            print (" <tr>\n".
               "  <td bgcolor=6495ED>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$edpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$profit</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$minimum</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
			   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>".(number_format($rxrate3m,2))."</td>\n".  //ใช้/เดือน
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkpmon</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$pack</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri_vat</td>\n".
               "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"dgdele.php? Delrow=$row_id&Dgcode=$drugcode&Dgtrad=$tradname\">ลบ</td>\n".
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


 