<?
  include("connect.inc");
?>
<A HREF="../nindex.htm">&lt;&lt; ไปเมนู</A>
<form action="" method="post">
<table width="80%" border="0">
  <tr>
    <td height="30" colspan="2" align="center" bgcolor="#33CCFF">คำนวณราคาขาย</td>
    </tr>
  <tr>
    <td width="52%" height="26" align="right">ราคาทุนที่ต้องการคำนวณ :</td>
    <td width="48%">
      <input name="price" type="text" id="price" size="15">
	</td>
    </tr>
  <tr>
    <td height="29" colspan="2" align="center">
      <input type="submit" name="okbtn" id="okbtn" value="คำนวณ">
      </td>
  </tr>
</table>
</form>

<?
if(isset($_POST['okbtn'])){
	$nUnitpri=$_POST['price'];
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
	$num1=$nSalepri-$nUnitpri;
	$num2=(($nSalepri*100)/$nUnitpri)-100;
	$nUnitpri = number_format($nUnitpri, 2, '.', ''); 
	$nSalepri = number_format($nSalepri, 2, '.', ''); 
	$num1 = number_format($num1, 2, '.', ''); 
	$num2 = number_format($num2, 2, '.', ''); 
	echo "ราคาต้นทุนที่กรอก : ".$nUnitpri." บาท<br>";
	echo "ราคาขายที่คำนวณได้ : ".$nSalepri." บาท<br>";
	echo "กำไรที่คำนวณได้ : ".$num1." บาท<br> คิดเป็น : ".$num2." % <br> ";

}
?>