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

<?php
$cDoctor2 = substr($cDoctor,0,5);
// หมอปฏิพงค์(MD037) หมอการุณย์(MD054) หมอกัณต์กัลยา(MD130) กับหมอฝังเข็มอีก 2 คน
// MD128 ภาคภูมิ พิสุทธิวงษ์
// MD129 ศศิภา ศิริรัตน์
// MD116 วัชรพงษ์ รักษ์บำรุง
// NID วัชรพงษ์ (ว.20014)
// MD151 กันยกร มาเกตุ
// MD115 คือแพทย์แผนจีน 
// MD163 ศุภกิตติ มงคล พจ.1254
if( $cDoctor2 == 'MD037' 
OR $cDoctor2 == 'MD054' 
OR $cDoctor2 == 'MD115' 
OR $cDoctor2 == 'MD128' 
OR $cDoctor2 == 'MD129' 
OR $cDoctor2 == 'MD130' 
OR $cDoctor2 == 'MD116' 
OR $cDoctor2 == 'NID ว' 
OR $cDoctor2 == 'MD151' 
OR $cDoctor2 == 'MD163'){
    ?>
    <br><br>
    <a target="_blank" href="labtranxnid.php?code=<?=$Dgcode;?>"<?php if($aSumNprice > 0){echo "Onclick=\"alert('ค่า หัตถการ มีส่วนเกินที่ไม่สามารถเบิกได้ ให้ผู้ป่วยชำระเงินส่วนเกินที่ส่วนเก็บเงิน');\""; }?>>หมดรายการ/ใบแจ้งหนี้/ใบรับรองแพทย์ ฝังเข็ม </a>
    <br><br>
	<a target="_blank" href="labtranxnid1.php">ใบรับรองแพทย์ ฝังเข็ม</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=1">ใบรับรองแพทย์ ฝังเข็ม(ภาคภูมิ พิสุทธิวงษ์)</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=2">ใบรับรองแพทย์ ฝังเข็ม(ศศิภา ศิริรัตน์)</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=3">ใบรับรองแพทย์ ฝังเข็ม(กันยกร มาเกตุ)</a>
    <br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=4">ใบรับรองแพทย์ ฝังเข็ม(ศุภกิตติ มงคล)</a>
	<?php
}

// MD058  แพทย์แผนไทย 
// MD155 หทัยรัตน์ กุลชิงชัย
// MD156 อัจฉรา อวดห้าว
// MD157 ธัญญาวดี มูลรัตน์
// เฉพาะแพทย์แผนไทย
if( $cDoctor2 == 'MD058' || $cDoctor2 == 'MD155' || $cDoctor2 == 'MD156' || $cDoctor2 == 'MD157'){
    ?>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=1&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - อัจฉรา อวดห้าว</a>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=2&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - ธัญญาวดี มูลรัตน์</a>
	<br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=3&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - หทัยรัตน์ กุลชิงชัย</a>
    <!--<br><br>
    <a target="_blank" href="labtranxnidpt.php">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ </a>-->

<?php
}
?>