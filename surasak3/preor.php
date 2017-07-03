<?php
   session_start();

    $x=0;
    $aDgcode = array("รหัส");
    $aTrade  = array("รายการ");
    $aPrice  = array("ราคา ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aMoney= array("       รวมเงิน   ");
    $Netprice="";   

    $aYprice = array("ราคา ");
    $aNprice = array("ราคา ");
    $aSumYprice = array("ราคา ");
    $aSumNprice = array("ราคา ");
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");

    $cPart="";
    $cDiag=$diag;
    $cDoctor=$doctor;
    $cAn="";
    $cAccno=0;
  $tvn="$tvn";
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");


    session_register("cPart");
    session_register("cDiag");
    session_register("cAn"); 
    session_register("cDoctor"); 
    session_register("cAccno"); 
  session_register("tvn"); 
   print "ผู้ป่วยนอก<br>";
   print "HN :$cHn<br>";
print "VN :$tvn<br>";
   print "$cPtname<br>";
   print "สิทธิการรักษา :$cPtright<br>";
   print "โรค :$cDiag<br>";
   print "แพทย์ :$cDoctor<br>";
?>
<a href="ortopayop.php">ทำรายการต่อไป</a>






