<?php
    session_start();
    $x=0;
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aPrice  = array("                          �ҤҢ��  ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aSlipcode = array("        �Ը���   ");
    $aMoney= array("       ����Թ   ");
    $Netprice="";   

//    $cHn="";
//    $cPtname="";
//    $cPtright=""; 

//    $cAn=$an;  
    $cDoctor=$doctor;
    $cIdname="";
    $cDiag=$diag;
    $aEssd=array("Essd");
    $aNessdy=array("Nessdy");
    $aNessdn=array("Nessdn");
    $aDPY=array("DPY");
    $aDPN=array("DPN");   
    $aDSY=array("DSY");
    $aDSN=array("DSN");   

    $sDcode="";
    $sSlip="";
  $tvn="$tvn";
    session_register("sDcode");
    session_register("sSlip");

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aSlipcode");
    session_register("aMoney");
    session_register("Netprice");

//    session_register("cHn");  
//    session_register("cPtname");    
//    session_register("cPtright");

//    session_register("cAn");
      session_register("cDoctor");
      session_register("cIdname");
      session_register("cDiag");
      session_register("aEssd");
      session_register("aNessdy");
      session_register("aNessdn");
      session_register("aDPY");
      session_register("aDPN");
      session_register("aDSY");
      session_register("aDSN");
session_register("tvn");
   print "�����¹͡<br>";
   print "HN :$cHn<br>";
   print "VN :$tvn<br>";
   print "$cPtname<br>";
   print "�Է�ԡ���ѡ�� :$cPtright<br>";
   print "�ä :$cDiag<br>";
   print "ᾷ�� :$cDoctor<br>";
?>
<a href="dgseek.php" id="aLink">������</a>






<script type="text/javascript">
document.getElementById('aLink').focus();
</script>