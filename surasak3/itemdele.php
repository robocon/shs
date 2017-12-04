<?php
session_start();
    $n=$Delrow;
    $aDgcode[$n]="";
    $aTrade[$n]="";
    $aPrice[$n]="";
    $aPart[$n]="";
    $aAmount[$n]="";
    $money = "";
    $aMoney[$n]="";
    $Netprice=array_sum($aMoney);
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>ลบ</th>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New'>รวมเงิน</th>
 </tr>

<?php
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"itemdele.php? Delrow=$n\"><font face='Angsana New'>ลบ</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aMoney[$n]</td>\n".  
                " </tr>\n");
        }
?>
</table>
<?php
     echo " ราคารวม  $Netprice บาท ";
?>
    <br><a target=_BLANK href="rxutranx.php">ตัดสต๊อก/ใบรายงาน</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxu.php">(ยกเลิกทั้งหมด)</a>


