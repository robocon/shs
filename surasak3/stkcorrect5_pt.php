<?php
  include("connect.inc");
   print "<a href='../nindex.htm'><font face='Angsana New'><< ไปเมนู</a><br>";
//   print "- คำนวนหาจำนวนสุทธิยาเวชภัณฑ์ (ในคลัง + ในห้องจ่าย)<br>";
//   print "- คำนวนหากำไรของยาเวชภัณฑ์แต่ละตัว <br>";
//   print "- คำนวนหามูลค่ารวม(ราคาทุน)ของยาเวชภัณฑ์ทั้งหมด <br>";
//   print "- คำนวนหามูลค่ารวม(ราคาขาย)ของยาเวชภัณฑ์ทั้งหมด <br>";
//   print "- คำนวนหากำไรเฉลี่ยของยาเวชภัณฑ์ทั้งหมด <br>";
//   print "- คำนวนหาอัตราการใช้ต่อเดือน(ใช้/เดือน) <br>";
//   print "- คำนวนหาจำนวนเดือนที่เหลือยาพอใช้(เหลือ?เดือน) <br>";
///////////////runno  to find date established 0
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
print "วันที่เริ่มนับจ่ายสะสม $dStartday ถึงปัจจุบันคำนวณได้ $days วัน<br>";   
/*  
   $query="SELECT row_id FROM druglst";
   $result = mysql_query($query);
   $xRec = mysql_num_rows($result);
   print "จำนวน records $xRec<br>";
*/
   $_unitpri=0;  //ราคาทุนรวมทั้งหมด
   $_salepri=0;  //ราคาขายรวมทั้งหมด
   $n=0;    //นับจำนวน record
////////////

      print "<table>";
      print " <tr>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>row</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาขาย</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>จำนวนสุทธิคอม</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ในคลังคอม</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ในห้องจ่ายคอม</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ห้องจ่ายย่อยจริง</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>คลังย่อยจริง</th>";

      print "  <th bgcolor=6495ED><font face='Angsana New'>จำนวนสุทธิจริง</th>";
    
      print " </tr>";

        $query = "SELECT row_id,drugcode,tradname,unitpri,salepri,stock,mainstk,rxaccum,rxrate,
                            stkpmon FROM druglst_pt ";
        $result = mysql_query($query) or die("Query druglst failed");

    while(list($row_id,$drugcode,$tradname,$unitpri,$salepri,$stock,$mainstk,$rxaccum,$rxrate,
     $stkpmon) = mysql_fetch_row ($result)) {
		$n++; 
          $nRow_id=$row_id;
          $cDrugcode=$drugcode;
          $cTradname=$tradname;
          $nUnitpri = $unitpri;
          $nSalepri = $salepri;
          $nStock     = $stock;
          $nMainstk = $mainstk;
          $nRxacc = $rxaccum;         
          $nRate  = $rxrate;
          $nMonth = $stkpmon;

          $nTotalstk = $nStock+$nMainstk;  

   //$profit   =99;
   //$xUnitpri =99;
   //$xSalepri =99;

          if ($nTotalstk <> 0 and $nUnitpri <>0 and $nSalepri <> 0 ){
	$xUnitpri =$nUnitpri * $nTotalstk;  //รวมตามราคาทุน
	$xSalepri=$nSalepri * $nTotalstk; //รวมตามราคาขาย
	$_unitpri  = $_unitpri+$xUnitpri ;  //รวมตามราคาทุน
	$_salepri = $_salepri+$xSalepri; //รวมตามราคาขาย
                $profit=($nSalepri - $nUnitpri)*100/$nUnitpri;
   //   print "row_id $nRow_id  ราคาทุนรวม= $_unitpri  ราคาขายรวม=  $_salepri<br>";
		}
          else {
	$xUnitpri =0;
	$xSalepri=0;
	$profit=0;
	}

// rate การใช้ยา        
          if ($nRxacc > 0){
                     $nRate      = ($nRxacc/$days)*30;      //จำนวนใช้ต่อเดือน
                     $nMonth    = $nTotalstk/$nRate;           //จะมีเหลือใช้ได้อีกกี่เดือน
	  	         }
          else {
	     $nRate   = 0;
	     $nMonth = 0;
	         }
// rate การใช้ยา

        $quest ="UPDATE druglst SET  totalstk = $nMainstk+$nStock,
			          rxrate    = $nRate,
			          stkpmon= $nMonth
                       WHERE row_id='$nRow_id' ";
        $ans = mysql_query($quest) ;
if (mysql_errno()<>0){
	print "$nRow_id<br>";
print "Mainstk = $nMainstk<br>";
print "Stock = $nStock<br>";
print " totalstk = $nTotalstk<br>";
print "rxrate =  (Rxacc/days)*30 = $nRxacc/days*30 =  $nRate<br>";
print "stkpmon = Totalstk/Rate = $nTotalstk/$nRate = $nMonth<br>";

	}
//        echo mysql_errno() . ": " . mysql_error(). "\n";
//        echo "<br>";
//place after update
      $profit=number_format($profit,1);
      $nMonth=number_format($nMonth,1);
      $nRate=number_format($nRate,1);
//      print "บันทึกข้อมูลเรียบร้อย แถวที่ $nRow_id<br><br>";

         print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRow_id</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cDrugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cTradname</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nUnitpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nSalepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nTotalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nMainstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nStock</td>\n".
    
         "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
	    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
	    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".

           " </tr>\n");

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

