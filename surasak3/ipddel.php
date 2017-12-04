<?php
session_start();
$n=$Delrow;
$aDgcode[$n]="";
$aTrade[$n]="";
$aSlipcode[$n]="";
$aPrice[$n]="";
$aPart[$n]="";
$aAmount[$n]="";
$aMoney[$n]="";
$aEssd[$n]="";
$aNessdy[$n]="";
$aNessdn[$n]="";
$aDPY[$n]="";
$aDPN[$n]="";
$aDSY[$n]="";
$aDSN[$n]="";
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>ลบ</th>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=CD853F><font face='Angsana New'>วิธีใช้</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New'>รวมเงิน</th>
 </tr>

<?php
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"ipddel.php? Delrow=$n\"><font face='Angsana New'>ลบ</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aSlipcode[$n]</td>\n".    
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aMoney[$n]</td>\n".  
                " </tr>\n");
        }
?>
</table>
<?php
    $Netprice=array_sum($aMoney);
     echo " ราคารวม  $Netprice บาท ";
?>
    <br><a target=_BLANK href="slipprn.php">ดูสลากยา</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="ipdgtranx.php">หมดรายการ/บันทึก</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxop.php">(ยกเลิก)</a>

