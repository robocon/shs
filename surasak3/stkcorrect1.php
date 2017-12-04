<?php
  include("connect.inc");
   print "<a href='../nindex.htm'><font face='Angsana New'><< ไปเมนู</a><br>";
/////////
//runno  to find date established 0
    $query = "SELECT title,startday FROM runno WHERE title = 'RXAC'";
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

//   $dStartday=(substr($dStartday,0,4)-543).substr($dStartday,4); //วันตั้งค่า 0
   $date2=date("Y-m-d H:i:s");  //วันที่คำนวณ 

   $s = strtotime($date2)-strtotime($dStartday);
//   echo "จำนวนวินาที $s<br>";  //seconds
   $d = intval($s/86400);   //day

   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
//   echo "จำนวนวัน  $d วัน $h ชั่วโมง<br>";

   $days= $d;
   if ($h>12){
         $days=$d+1;
                        }  
print "วันที่เริ่มนับยาจ่ายสะสม $dStartday ถึงปัจจุบันคำนวณได้ $days วัน<br>";       
////////


   $query="SELECT row_id FROM druglst";
   $result = mysql_query($query);
   $xRec = mysql_num_rows($result);
   print "จำนวน records $xRec<br>";

   $_unitpri=0;  //ราคาทุนรวมทั้งหมด
   $_salepri=0;  //ราคาขายรวมทั้งหมด

      print "<table>";
      print " <tr>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>row</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>จำนวนสุทธิ</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ในคลัง</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ในห้องจ่าย</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาขาย</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>กำไร %</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>มูลค่า(ราคาทุน)</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>มูลค่า(ราคาขาย)</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>จ่ายสะสม</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>เหลือ?เดือน</th>";
      print " </tr>";

  for ($n=1; $n<=$xRec; $n++){
        $query = "SELECT * FROM druglst WHERE row_id = $n ";
        $result = mysql_query($query) or die("Query druglst failed");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    if(mysql_num_rows($result)){
          $nRow_id=$row->row_id;
          $cDrugcode=$row->drugcode;
          $cTradname=$row->tradname;
          $nUnitpri = $row->unitpri;
          $nSalepri = $row->salepri;
          $nStock     = $row->stock;
          $nMainstk = $row->mainstk;
          $nRxacc = $row->rxaccum;         
          $nRate  = $row->rxrate;
          $nMonth = $row->stkpmon;
          $nTotalstk = $nStock+$nMainstk;  

          if ($nTotalstk > 0){
	$xUnitpri =$nUnitpri * $nTotalstk;  //รวมตามราคาทุน
	$xSalepri=$nSalepri * $nTotalstk; //รวมตามราคาขาย
	$_unitpri  = $_unitpri+($nUnitpri * $nTotalstk);  //รวมตามราคาทุน
	$_salepri = $_salepri+($nSalepri * $nTotalstk); //รวมตามราคาขาย
                $profit=($nSalepri - $nUnitpri)*100/$nUnitpri;
                $profit=number_format($profit,1);
		}
          else {
	$xUnitpri =0;
	$xSalepri=0;
	$profit=0;
	}
// rate การใช้ยา        
          if ($nRxacc > 0){
                     $nRate      = ($nRxacc/$days)*30;      //จำนวนใช้ต่อเดือน
                     $nRate=number_format($nRate,1);
                     $nMonth    = $nTotalstk/$nRate;           //จะมีเหลือใช้ได้อีกกี่เดือน
                     $nMonth=number_format($nMonth,1);

	  	         }
          else {
	     $nRate   = 0;
	     $nMonth = 0;
	         }
// rate การใช้ยา

        $query ="UPDATE druglst SET  totalstk = $nMainstk+$nStock,
			          rxrate    = $nRate,
			          stkpmon= $nMonth
                       WHERE row_id=$n ";
        $result = mysql_query($query) or die("Query failed,update druglst, $n");
//        echo mysql_errno() . ": " . mysql_error(). "\n";
//        echo "<br>";
//      print "บันทึกข้อมูลเรียบร้อย แถวที่ $n<br><br>";

         print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRow_id</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cDrugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cTradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nTotalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nMainstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nStock</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nUnitpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nSalepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$profit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$xUnitpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$xSalepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRxacc</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nMonth</td>\n".
           " </tr>\n");

      }
  }
print "</table>";

$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
print "<br>คำนวณมูลค่ายาเวชภัณฑ์ทั้งหมด $Thaidate<br>";
$netprofit = $_salepri-$_unitpri;
print "******************************************<br>";
print "คำนวณมูลค่ายาเวชภัณฑ์ทั้งหมด ตามราคาทุน ได้ = $_unitpri บาท <br>";
print "คำนวณมูลค่ายาเวชภัณฑ์ทั้งหมด ตามราคาขายได้ = $_salepri บาท <br>";
print "คำนวณกำไรได้ = $_salepri - $_unitpri = $netprofit บาท <br>";
$profit=$netprofit*100/$_unitpri;
$profit=number_format($profit,1);
print "กำไรเฉลี่ย = $profit  %<br>";
print "<br><a href='../nindex.htm'><< ไปเมนู</a><br>";

include("unconnect.inc");
?>

