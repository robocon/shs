<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
    $n=$Delrow;
    $aLabcode[$n]=""; 
    $aDetail[$n]=""; 
    $aEachprice[$n]=""; 
    $aLabpart[$n]	=""; 
    $aTime[$n]="";
    $aItemprice[$n]="";
    $nLabprice=array_sum($aItemprice);
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
	   for ($n=1; $n<=$m; $n++){
	        print("<tr>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'><a target='top'  href=\"dlabdele.php? Delrow=$n\">ź</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aLabcode[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDetail[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aEachprice[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTime[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aItemprice[$n]</td>\n".
	                " </tr>\n");
	        }
?>
</table>
<?php
     echo " <font face='Angsana New'>�Ҥ����  $nLabprice �ҷ ";
?>
    <br><a target=_BLANK href="dlabtranx.php">�����¡��/�ѹ�֡�觵�Ǩ</a>
