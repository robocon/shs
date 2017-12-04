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
    print  "<font face='Angsana New'>เบิกยาผู้ป่วยในจำนวน $nDay วัน,  วันที่ $Thaidate<br> ";
    print "<font face='AngsanaUPC' size='2'><b> $cWard,เตียง $cBed, ชื่อ $cPtname, อายุ $cAge, AN:$cAn</b></font><br>";
	print" สิทธิ $cPtright , แพทย์  $cDoctor";

    print"<font face='Angsana New'><b>---------- แก้ไขจำนวนเบิก----------</b><br>";
    print"รหัส: $aDgcode[$n]<br>";
    print"ชื่อการค้า: $aTrade[$n]<br>";
    print"<form method='POST' action='amteditok.php'>";
    print"จำนวนเบิก ?......................<input type='text' name='amount' size='15' value='$aAmount[$nDelrow]'><br>";
    print"<br><input type='submit' value='          ตกลง          ' name='B1'></font></p>";
    print"</form>";
?>

 