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
    print  "<font face='Angsana New'>�ԡ�Ҽ�����㹨ӹǹ $nDay �ѹ,  �ѹ��� $Thaidate<br> ";
    print "<font face='AngsanaUPC' size='2'><b> $cWard,��§ $cBed, ���� $cPtname, ���� $cAge, AN:$cAn</b></font><br>";
	print" �Է�� $cPtright , ᾷ��  $cDoctor";
  print"<table>";
 print"<tr>";
  print"<th><th bgcolor=20B2AA><font face='Angsana New'>#</th>";
 print"  <th><th bgcolor=20B2AA><font face='Angsana New'>����</th>";
  print" <th><th bgcolor=20B2AA><font face='Angsana New'>��¡��</th>";
   print"<th><th bgcolor=20B2AA><font face='Angsana New'>˹��¹Ѻ</th>";
  print" <th><th bgcolor=20B2AA><font face='Angsana New'>�Ը���</th>";
  print" <th><th bgcolor=20B2AA><font face='Angsana New'>�ӹǹ</th>";
   print"<th><th bgcolor=20B2AA><font face='Angsana New'>�Ҥ�</th>";
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
               "  <td><font face='Angsana New'><a target='_self'  href=\"dprofidel.php? Delrow=$n\">ź���</td>\n".
               " </tr>\n");
               }
   print"</table>";
   $Netprice=number_format($Netprice,2);
   print " �Ҥ����  $Netprice �ҷ <br>";
   print"(��ԡ����Ţ��ͧ�ӹǹ�������)";
?>
   <br> <a target=_BLANK href="slipprn.php">�������ҡ��</a>
   &nbsp;&nbsp;&nbsp;<a target=_self  href="rxdptranx.php">�Ѵʵ�͡/���˹��</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxop.php">(¡��ԡ)</a>


 