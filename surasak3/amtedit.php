<?php
    session_start();
	////////
	$nDelrow=$Delrow;
   session_register("nDelrow");    
	/*
	$aDgcode[$n] = "";
    $aTrade[$n]  = "";
    $aPrice[$n]  = "";
    $aPart[$n] = "";
	$aUnit[$n] = "";
    $aAmount[$n] = "";
    $aSlipcode[$n] = "";
    $aMoney[$n]= "";
	$Netprice=array_sum($aMoney);
	*/
	    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    print  "<font face='Angsana New'>�ԡ�Ҽ�����㹨ӹǹ $nDay �ѹ,  �ѹ��� $Thaidate<br> ";
    print "<font face='AngsanaUPC' size='2'><b> $cWard,��§ $cBed, ���� $cPtname, ���� $cAge, AN:$cAn</b></font><br>";
	print" �Է�� $cPtright , ᾷ��  $cDoctor";

    print"<font face='Angsana New'><b>---------- ��䢨ӹǹ�ԡ----------</b><br>";
    print"����: $aDgcode[$n]<br>";
    print"���͡�ä��: $aTrade[$n]<br>";
    print"<form method='POST' action='amteditok.php'>";
    print"�ӹǹ�ԡ ?......................<input type='text' name='amount' size='15' value='$aAmount[$nDelrow]'><br>";
    print"<br><input type='submit' value='          ��ŧ          ' name='B1'></font></p>";
    print"</form>";
?>

 