<?php
    session_start();
	print "<font face='Angsana New'>รายการสั่งซื้อ  จาก ( $cComcode)  $cComname";
	$n=$Delrow;
    $aDgcode[$n]="";
    $aTrade[$n]="";
    $aPacking[$n]="";
    $aPack[$n]="";
    $aTotalstk[$n]="";
    $aAmount[$n]="";
    $aPackpri[$n]="";
    $aPrice[$n]="";
    $aPackpri_vat[$n]="";
    $aPrice_vat[$n]="";
	$aSnspec[$n]="";
	$aSnspec1[$n]="";
	$aSpec[$n]="";
    $x--;
    $x--;
	//ขยับบรรทัดขึ้น
   for ($n=$Delrow; $n<=$x; $n++){
		 $aDgcode[$n]= $aDgcode[$n+1];
		 $aTrade[$n]=$aTrade[$n+1];
		$aPacking[$n]=$aPacking[$n+1];
		$aPack[$n]=$aPack[$n+1];
		$aTotalstk[$n]= $aTotalstk[$n+1];
		$aAmount[$n]=$aAmount[$n+1];
		$aPackpri[$n]=$aPackpri[$n+1];
		$aPrice[$n]=$aPrice[$n+1];
		$aPackpri_vat[$n]=$aPackpri_vat[$n+1];
		$aPrice_vat[$n]=$aPrice_vat[$n+1];
		$aSnspec[$n]=$aSnspec[$n+1];
		$aSnspec1[$n]=$aSnspec1[$n+1];
		$aSpec[$n]=$aSpec[$n+1];
				  }
//ลบค่าในarrayสุดท้ายทิ้ง
array_pop($aDgcode);
array_pop($aTrade);
array_pop($aPacking);
array_pop($aPack);
array_pop($aTotalstk);
array_pop($aAmount);
array_pop($aPackpri);
array_pop($aPrice);
array_pop($aPackpri_vat);
array_pop($aPrice_vat);
array_pop($aSnspec);
array_pop($aSnspec1);
array_pop($aSpec);
 $Netprice=0;
 $Netprice_vat=0;
 $Netprice=array_sum($aPrice);
 $Netprice_vat=array_sum($aPrice_vat);

?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>หน่วยนับ</th>
  <th bgcolor=CD853F><font face='Angsana New'>ขนาดบรรจุ</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวนวางระดับ</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวนคงคลัง</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวนสั่งซื้อ</th>
  <th bgcolor=CD853F><font face='Angsana New'>หน่วยละ(+VAT)</th>
  <th bgcolor=CD853F><font face='Angsana New'>รวมเงิน(+VAT)</th>
  <th bgcolor=6495ED><font face='Angsana New'>ลบทิ้ง</th>
 </tr>

<?php
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPacking[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPack[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aMinimum[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTotalstk[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPackpri_vat[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice_vat[$n]</td>\n".  
                "<td bgcolor=F5DEB3><a target='top'  href=\"podgdele.php? Delrow=$n\"><font face='Angsana New'>ลบ</td>\n".
                 " </tr>\n");
        }
        $x++;
?>
</table>
<?php
     echo " รวมเงินสุทธิ  $Netprice_vat บาท <br>";
?>
   <a target=_BLANK href="podgbill.php">พิมพ์รายการสั่งซื้อ</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="podgtranx.php">บันทึกรายการสั่งซื้อ</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="podgno.php">(ยกเลิกทั้งหมด)</a>
   &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><<กลับไปเมนู</a>




