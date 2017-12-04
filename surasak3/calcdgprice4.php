<?php
/*
แก้ราคายาใหม่ตามกรม บช.กลาง 1 ธค.2549,update druglst table
table druglst
	เปลี่ยน salepri ---> oldsalepri
	เพิ่ม   calsalepri  double  10,2 null
	เพิ่ม  salepri   double  10,2 null
run --->  calcdgprice4.php
*/
$n=0;
  include("connect.inc");
      print "<table>";
      print " <tr>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>row</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>จำนวนสุทธิ</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาขาย</th>";
      print "  <th bgcolor=CD853F><font face='Angsana New'>ราคาขายใหม่</th>";
      print "  <th bgcolor=CD853F><font face='Angsana New'>ราคาขายใหม่ปรับ</th>";
      print " </tr>";

        $query = "SELECT row_id,drugcode,tradname,unitpri,oldsalepri,totalstk FROM druglst ";
        $result = mysql_query($query) or die("Query druglst failed");

    while(list($row_id,$drugcode,$tradname,$unitpri,$oldsalepri,$totalstk) = mysql_fetch_row ($result)) {
		$n++; 
          $nRow_id=$row_id;
          $cDrugcode=$drugcode;
          $cTradname=$tradname;
          $nUnitpri = $unitpri;
          $oldSalepri = $oldsalepri;
          $nTotalstk = $totalstk;  

/////คิดราคายาใหม่
if ($nUnitpri >= .01 & $nUnitpri <= .20){
	$nSalepri = .50;
	}
if ($nUnitpri >= .21 & $nUnitpri <= .50){
	$nSalepri = 1.00;
	}
if ($nUnitpri >= .50 & $nUnitpri <= 1){
	$nSalepri = 1.50;
	}
if ($nUnitpri >= 1.01 & $nUnitpri <= 10){
	$nSalepri = 1.50+1.25*($nUnitpri-1);
	}
if ($nUnitpri >= 10.01 & $nUnitpri <= 100){
	$nSalepri = 13+1.20*($nUnitpri-10);
	}
if ($nUnitpri >= 100.01 & $nUnitpri <= 1000){
	$nSalepri = 126+1.15*($nUnitpri-100);
	}
if ($nUnitpri > 1000){
	$nSalepri = 1161+1.10*($nUnitpri-1000);
	}

$nVArabic =$nSalepri;
    $nSalepri = number_format($nSalepri, 2, '.', ''); 
    $cTarget = Ltrim($nSalepri);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}

   $cRtnum=substr($cTarget,$x+1);//ค่าเป็นตัวเลข ใช้คำนวลได้,2 ทศนิยม ปัดเศษ
 $nSalepri=intval($nSalepri)+$cRtnum/100;

if ($nSalepri < 10){
	if ($cRtnum <= 12){
		$nSalepri=intval($nSalepri);
			}
	if ($cRtnum >12 & $cRtnum<37){
		$nSalepri=intval($nSalepri) + .25;
			}
	if ($cRtnum >=37 & $cRtnum<62){
		$nSalepri=intval($nSalepri) + .5;
			}
	if ($cRtnum >=62){
		$nSalepri=intval($nSalepri) + .75;
			}
}

if ($nSalepri  >= 10 & $nSalepri <= 100){
	if ($cRtnum < 37){
		$nSalepri=intval($nSalepri);
		}		
	if ($cRtnum >= 37 & $cRtnum < 72 ){
		$nSalepri=intval($nSalepri) + .5;
			}
  	if ($cRtnum >= 72){
		$nSalepri=intval($nSalepri+1);
			}
}
///////////
if ($nSalepri > 100){
  	if ($cRtnum >= 50){
		$nSalepri=intval($nSalepri+1);
			}
  	if($cRtnum>=0 & $cRtnum<50){
		$nSalepri=intval($nSalepri);
		}
}
/////end -คิดราคายาใหม่

//update druglst table
        $quest ="UPDATE druglst SET  calsalepri = $nVArabic,
			          salepri = '$nSalepri'
                       WHERE row_id='$nRow_id' ";
        $ans = mysql_query($quest) ;
		
        echo mysql_errno() . ": " . mysql_error(). "\n";
        echo "$nRow_id<br>";
//end -update druglst table
         print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRow_id</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cDrugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cTradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nTotalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nUnitpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$oldSalepri</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$nVArabic</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$nSalepri</td>\n".
           " </tr>\n");

$nUnitpri=0;
$newSalepri=0;
$ajSalepri=0;
      }

print "</table>";
include("unconnect.inc");
?>

