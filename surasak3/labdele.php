<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
    $n=$Delrow;
    $aDgcode[$n]=""; 
    $aTrade[$n]=""; 
    $aPrice[$n]=""; 

       $aYprice[$n]=""; 
       $aNprice[$n]=""; 
      $aSumYprice=array_sum($aYprice);
       $aSumNprice=array_sum($aNprice);

    $aPart[$n]=""; 
    $aAmount[$n]="";
    $money = "";
    $aMoney[$n]="";
    $Netprice=array_sum($aMoney);
	$aFilmsize[$n]="";
?>
<table>
 <tr>
  <th bgcolor=CD853F>ลบ</th>
  <th bgcolor=CD853F>#</th>
  <th bgcolor=CD853F>รหัส</th>
  <th bgcolor=CD853F>รายการ</th>
  <th bgcolor=CD853F>ราคา</th>
  <th bgcolor=CD853F>จำนวน</th>
  <th bgcolor=CD853F>รวมเงิน</th>
 </tr>
<?php
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"labdele.php? Delrow=$n\">ลบ</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aTrade[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aPrice[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aAmount[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aMoney[$n]</td>\n".
                " </tr>\n");
        }
?>
</table>
<?php
echo " <b>ราคารวม  $Netprice บาท </b> <br>";
echo " ราคาเบิกได้ $aSumYprice บาท ";
echo " <font color =FF0000> <b> ราคาเบิกไม่ได้   $aSumNprice บาท </b> ";
?>
    <br><a target=_BLANK href="labtranx.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('ค่า หัตถการ มีส่วนเกินที่ไม่สามารถเบิกได้ ให้ผู้ป่วยชำระเงินส่วนเกินที่ส่วนเก็บเงิน');\""; }?>><font face='Angsana New' size='3'>หมดรายการ/ใบแจ้งหนี้</a>&nbsp;&nbsp; <a target=_BLANK href="labtranxlabno.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('ค่า หัตถการ มีส่วนเกินที่ไม่สามารถเบิกได้ ให้ผู้ป่วยชำระเงินส่วนเกินที่ส่วนเก็บเงิน');\""; }?>>หมดรายการ/ใบแจ้งหนี้ LAB ไม่ออกคิว</a><br><br>
   
<a target=_BLANK href="labslip4bc.php">สติ๊กเกอร์</a>&nbsp;&nbsp;
<a target=_BLANK href="labslip4.1.php">สติ๊กเกอร์LAB ไม่ออกคิว</a>&nbsp;&nbsp;
<a target=_BLANK href="labslip4pdf.php">สติ๊กเกอร์LAB PDF</a>&nbsp;&nbsp;
<br><br>
<a target=_BLANK href="labslip4out.php">สติ๊กเกอร์ Lab นอก</a>&nbsp;&nbsp;
<a target=_BLANK href="labslip5out.php">สติ๊กเกอร์ Lab นอก NAP</a>

<br><br>
<a target=_BLANK href="labtranxnid.php"<?php if($aSumNprice > 0){echo "Onclick=\"alert('ค่า หัตถการ มีส่วนเกินที่ไม่สามารถเบิกได้ ให้ผู้ป่วยชำระเงินส่วนเกินที่ส่วนเก็บเงิน');\""; }?>>หมดรายการ/ใบแจ้งหนี้/ใบรับรองแพทย์ ฝังเข็ม </a>
<br><br>
<a target=_BLANK href="labtranxnid1.php">ใบรับรองแพทย์ ฝังเข็ม </a>
<br><br>
<a target=_BLANK href="labtranxnid1.php?subDoctor=1">ใบรับรองแพทย์ ฝังเข็ม(ภาคภูมิ พิสุทธิวงษ์)</a>
<br><br>
<a target=_BLANK href="labtranxnid1.php?subDoctor=2">ใบรับรองแพทย์ ฝังเข็ม(ศศิภา ศิริรัตน์)</a>