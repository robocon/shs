<?php
   session_start();

    $x=0;
    $aDgcode = array("����");
    $aTrade  = array("��¡��");
    $aPrice  = array("�Ҥ� ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aMoney= array("       ����Թ   ");
    $Netprice="";   

    $aYprice = array("�Ҥ� ");
    $aNprice = array("�Ҥ� ");
    $aSumYprice = array("�Ҥ� ");
    $aSumNprice = array("�Ҥ� ");
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
   print "�����¹͡<br>";
   print "HN :$cHn<br>";
print "VN :$tvn<br>";
   print "$cPtname<br>";
   print "�Է�ԡ���ѡ�� :$cPtright<br>";
   print "�ä :$cDiag<br>";
   print "ᾷ�� :$cDoctor<br>";
?>
<a href="ortopayop.php">����¡�õ���</a>






