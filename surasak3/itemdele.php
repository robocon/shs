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
  <th bgcolor=CD853F><font face='Angsana New'>ź</th>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>����</th>
  <th bgcolor=CD853F><font face='Angsana New'>��¡��</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Ҥ�</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=CD853F><font face='Angsana New'>����Թ</th>
 </tr>

<?php
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"itemdele.php? Delrow=$n\"><font face='Angsana New'>ź</td>\n".
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
     echo " �Ҥ����  $Netprice �ҷ ";
?>
    <br><a target=_BLANK href="rxutranx.php">�Ѵʵ�͡/���§ҹ</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxu.php">(¡��ԡ������)</a>


