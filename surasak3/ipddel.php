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
  <th bgcolor=CD853F><font face='Angsana New'>ź</th>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>����</th>
  <th bgcolor=CD853F><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Ը���</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Ҥ�</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=CD853F><font face='Angsana New'>����Թ</th>
 </tr>

<?php
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"ipddel.php? Delrow=$n\"><font face='Angsana New'>ź</td>\n".
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
     echo " �Ҥ����  $Netprice �ҷ ";
?>
    <br><a target=_BLANK href="slipprn.php">����ҡ��</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="ipdgtranx.php">�����¡��/�ѹ�֡</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxop.php">(¡��ԡ)</a>

