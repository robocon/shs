<?php
    print  "ตรวจสอบยาเวชภัณฑ์ในคลังยาใหญ่ที่มีจำนวน = 0  <br> ";
?>
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
  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>
  <th bgcolor=CD853F><font face='Angsana New'>ในคลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ห้องยา</th>
  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>
  <th bgcolor=6495ED><font face='Angsana New'>เหลือ?เดือน</th>
  <th bgcolor=6495ED><font face='Angsana New'>packing</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา/pack</th>
 </tr>

<?php
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

    $query = "SELECT drugcode,tradname,unitpri,edpri,salepri,minimum,totalstk,mainstk,stock,rxrate,stkpmon,pack,packpri,comname FROM druglst  WHERE mainstk = 0 order by drugcode ";  
    $result = mysql_query($query) or die("Query failed");

	 for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	       }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }

    if(mysql_num_rows($result)){
        $cComname=$row->comname;
        $n=0;
//        print "<font face='Angsana New' size='5'>$comcode :$cComname <br>";
//        print "<font face='Angsana New' size='2'>จ่ายสะสมเริ่มนับเมื่อ $dStartday (ถ้าต้องการตั้งค่า 0 ไปที่เมนู set 0 การจ่ายยา)<br>";
        print "<font face='Angsana New' size='2'>ใช้/เดือน คืออัตราการจ่ายต่อเดือน <br>";
        print "เหลือ ? เดือน คือยังมีเหลือใช้ได้กี่เดือน (เหลือสุทธิ/อัตราการจ่ายต่อเดือน)";
        while (list ($drugcode,$tradname,$unitpri,$edpri,$salepri,$minimum,$totalstk,$mainstk,$stock,
	$rxrate,$stkpmon,$pack,$packing
	) = mysql_fetch_row ($result)) {
            $n++;
        if($unitpri>0){
            $profit=($salepri - $unitpri)*100/$unitpri;
            $profit=number_format($profit,1);
		}
            print (" <tr>\n".
               "  <td bgcolor=6495ED><font face='Angsana New'>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$edpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$profit</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$minimum</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$mainstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkpmon</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$pack</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packing</td>\n".
               " </tr>\n");
               }
	}
    else {
           die("ไม่พบยาที่มีจำนวน =0 ในคลังยาใหญ่ ");
           }

   include("unconnect.inc");
?>

</table>


 