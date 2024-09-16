<?php
session_start();
require_once 'connect.php';
if (isset($sIdname)){} else {die;} //for security

$n = $Delrow;

$log_smenucode = sprintf("%s", $_SESSION['smenucode']);
if($log_smenucode == 'ADMPT'){
	$log_officer = sprintf("%s", $_SESSION['sOfficer']);
	$logSql = "INSERT INTO `log_patdata` (`id`, `date`, `hn`, `an`, `officer`, `action`, `value`) VALUES (NULL, NOW(), '$cHn', '$cAn', '$log_officer', 'ลบรายการ', '".$aDgcode[$n]."');";
	mysql_query($logSql);
}

unset($aDgcode[$n]);
unset($aTrade[$n]);
unset($aPrice[$n]);
unset($aAmount[$n]);
unset($aMoney[$n]);
unset($aYprice[$n]);
unset($aNprice[$n]);
unset($aMoney[$n]);
unset($aPart[$n]);
unset($aFilmsize[$n]);

$aSumYprice=array_sum($aYprice);
$aSumNprice=array_sum($aNprice);
$Netprice=array_sum($aMoney);
$money = "";

header('Location: labinfo.php');
exit;


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
<style>
	
table, th, td {
  font-size: 16px;
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 10px;
}
</style>
<table align='center' width='98%' >
 <tr>
  <th bgcolor=#F5CBA7><font face='Angsana New' size='3'>ลบ</th>
  <th bgcolor=#F5CBA7><font face='Angsana New' size='3'>#</th>
  <th bgcolor=#F5CBA7><font face='Angsana New' size='3'>รหัส</th>
  <th bgcolor=#F5CBA7><font face='Angsana New' size='3'>รายการ</th>
  <th bgcolor=#F5CBA7><font face='Angsana New' size='3'>ราคา</th>
  <th bgcolor=#F5CBA7><font face='Angsana New' size='3'>จำนวน</th>
  <th bgcolor=#F5CBA7><font face='Angsana New' size='3'>รวมเงิน</th>
 </tr>
<?php
   $lipid=0;
   for ($n=1; $n<=$x; $n++){
			if($aDgcode[$n]=="CHOL"){
				$lipid++;
			}
			if($aDgcode[$n]=="TRI"){
				$lipid++;
			}
			if($aDgcode[$n]=="HDL"){
				$lipid++;
			}
			if($aDgcode[$n]=="LDL"){
				$lipid++;
			}	   
        print("<tr>\n".
                "<td bgcolor=#FDEBD0><font face='Angsana New'><a target='right'  href=\"labdele.php? Delrow=$n\">ลบ</td>\n".
                "<td align='center' bgcolor=#FDEBD0><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=#FDEBD0><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td bgcolor=#FDEBD0><font face='Angsana New'>$aTrade[$n]</td>\n".
                "<td bgcolor=#FDEBD0><font face='Angsana New'>$aPrice[$n]</td>\n".
                "<td bgcolor=#FDEBD0><font face='Angsana New'>$aAmount[$n]</td>\n".
                "<td bgcolor=#FDEBD0><font face='Angsana New'>$aMoney[$n]</td>\n".				
                " </tr>\n");
        }
		
		if($lipid==4){
			echo "<div align='center'><img src='images/warning-1.png' width='64px;' height='64px;'></div>";
			echo "<div align='center' style='color:red;font-weigth:bold;font-size:16px;'>ไม่สามารถสั่งรายการ  CHOL,TRI,HDL,LDL พร้อมกัน 4 รายการได้ สามารถสั่งได้มากสุด 3 ตัว<br>ถ้าจะสั่งทั้ง 4 รายการ ต้องสั่งรายการ LIPID</div>";
		}		
?>
</table>
<?php
echo " <b>ราคารวม  $Netprice บาท </b> <br>";
echo " ราคาเบิกได้ $aSumYprice บาท ";
echo " <font color =FF0000> <b> ราคาเบิกไม่ได้   $aSumNprice บาท </b> ";
?>
    <br><a target=_BLANK href="labtranx.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('ค่า หัตถการ มีส่วนเกินที่ไม่สามารถเบิกได้ ให้ผู้ป่วยชำระเงินส่วนเกินที่ส่วนเก็บเงิน');\""; }?>><font face='Angsana New' size='3'>หมดรายการ/ใบแจ้งหนี้</a>&nbsp;&nbsp; <a target=_BLANK href="labtranxlabno.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('ค่า หัตถการ มีส่วนเกินที่ไม่สามารถเบิกได้ ให้ผู้ป่วยชำระเงินส่วนเกินที่ส่วนเก็บเงิน');\""; }?>>หมดรายการ/ใบแจ้งหนี้ LAB ไม่ออกคิว</a><br><br>
<a target="_blank" href="labslip4cbc.php">สติ๊กเกอร์ CBC</a>&nbsp;&nbsp;  
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
OR $cDoctor2 == 'MD163'
OR $cDoctor2 == 'MD203'){
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
    <br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=5">ใบรับรองแพทย์ ฝังเข็ม(พรชนก มั่งมูล)</a>
	<?php
}

// MD058  แพทย์แผนไทย 
// MD155 หทัยรัตน์ กุลชิงชัย
// MD156 อัจฉรา อวดห้าว
// MD157 ธัญญาวดี มูลรัตน์
// MD202 ประภัสสร เครืออินทร์
// เฉพาะแพทย์แผนไทย
if( $cDoctor2 == 'MD058' || $cDoctor2 == 'MD155' || $cDoctor2 == 'MD156' || $cDoctor2 == 'MD157' || $cDoctor2 == 'MD202'){
    ?>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=1&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - อัจฉรา อวดห้าว</a>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=2&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - ธัญญาวดี มูลรัตน์</a>
	<br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=3&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - กัลย์ปภารัศมิ์ กุลชิงชัย</a>
	<br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=4&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - ประภัสสร เครืออินทร์</a>
    <!--<br><br>
    <a target="_blank" href="labtranxnidpt.php">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ </a>-->

<?php
}
?>