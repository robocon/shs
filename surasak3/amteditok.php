<?php
    session_start();
	/*
	$n=$Delrow;
	$aDgcode[$n] = "";
    $aTrade[$n]  = "";
    $aPrice[$n]  = "";
    $aPart[$n] = "";
	$aUnit[$n] = "";
    $aAmount[$n] = "";
    $aSlipcode[$n] = "";
    $aMoney[$n]= "";
*/
    $aAmount[$nDelrow] = $amount;
    $aMoney[$nDelrow]  = $aAmount[$nDelrow]* $aSalepri[$nDelrow] ;
	$Netprice=array_sum($aMoney);
//////////////
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    print  "<font face='Angsana New'>เบิกยาผู้ป่วยในจำนวน $nDay วัน,  วันที่ $Thaidate<br> ";
    print "<font face='AngsanaUPC' size='2'><b> $cWard,เตียง $cBed, ชื่อ $cPtname, อายุ $cAge, AN:$cAn</b></font><br>";
	print" สิทธิ $cPtright , แพทย์  $cDoctor";
  print"<table>";
 print"<tr>";
  print"<th><th bgcolor=20B2AA><font face='Angsana New'>#</th>";
 print"  <th><th bgcolor=20B2AA><font face='Angsana New'>รหัส</th>";
  print" <th><th bgcolor=20B2AA><font face='Angsana New'>รายการ</th>";
   print"<th><th bgcolor=20B2AA><font face='Angsana New'>หน่วยนับ</th>";
  print" <th><th bgcolor=20B2AA><font face='Angsana New'>วิธิใช้</th>";
  print" <th><th bgcolor=20B2AA><font face='Angsana New'>จำนวน</th>";
   print"<th><th bgcolor=20B2AA><font face='Angsana New'>ราคา</th>";
 print"</tr>";
    $n=0;
for ($n=1; $n<=$x; $n++){
            print (" <tr>\n".
               "  <td><th bgcolor=ADD8E6>$n</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aDgcode[$n]</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aTrade[$n]</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aUnit[$n]</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aSlipcode[$n]</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'><a target='right'  href=\"amtedit.php? Delrow=$n\"> $aAmount[$n] </td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aMoney[$n]</td>\n".
               "  <td><font face='Angsana New'><a target='_self'  href=\"dprofidel.php? Delrow=$n\">ลบทิ้ง</td>\n".
               " </tr>\n");
               }
   print"</table>";
   $Netprice=number_format($Netprice,2);
   print " ราคารวม  $Netprice บาท <br>";
   print"(คลิกที่เลขช่องจำนวนเพื่อแก้ไข)";
?>
   <br> <a target=_BLANK href="slipprn.php">พิมพ์สลากยา</a>
   &nbsp;&nbsp;&nbsp;<a target=_self  href="rxdptranx.php">ตัดสต๊อก/ใบแจ้งหนี้</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxop.php">(ยกเลิก)</a>


 