<?php
    session_start();
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>Exp.Date</th>
  <th bgcolor=CD853F><font face='Angsana New'>Lot.No</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New'>เบิก</th>
  <th bgcolor=CD853F><font face='Angsana New'>หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ในคลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ในห้องจ่าย</th>
  <th bgcolor=CD853F><font face='Angsana New'>ลบทิ้ง</th>
 </tr>

<?php
	$n=$Delrow;
	$aDgcode[$n]="";
	$aTrade[$n]="";
	$aExpdate[$n]="";
	$aLotno[$n]="";
	$aAmount[$n]="";
	$aStkcut[$n]="";
	$aUnit[$n]="";
	$aDglotno[$n]="";
	$aTotalstk[$n]="";
	$aMainstk[$n]="";
	$aStock[$n]="";

//    print "cTotal(เบิก) $cTotal<br>";
//    print "cAmount $cAmount<br>";
/*
    print "รายการเบิกจากคลังยา<br>";
    if ($cTotal>$cAmount){         
               $cStkcut=$cAmount;
               $cRestkcut= $cTotal-$cStkcut;
               $cTotal= $cTotal-$cStkcut;
                                     }
     else {
               $cStkcut=$cTotal;
               $cRestkcut=0;
               $cTotal=0;
                                     }
    array_push($aStkcut,$cStkcut);

   $x++;
   */
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aExpdate[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aLotno[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aStkcut[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aUnit[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTotalstk[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aMainstk[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aStock[$n]</td>\n".     
                "<td bgcolor=F5DEB3><a target='right'  href=\"stkdele.php? Delrow=$n\"><font face='Angsana New'>ลบ</td>\n".
                " </tr>\n");
        }
   
?>
</table>
<?php
    print "ให้เบิกเพิ่มจาก Lot.No ต่อไปอีกจำนวน $cRestkcut<br>";
?>
   <a target=_BLANK href="stkbill.php">พิมพ์ใบเบิก</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="stktranx.php">ตัดสต๊อกยา</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notstk.php">(ยกเลิกทั้งหมด)</a>
   &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm">กลับไปเมนู</a>


