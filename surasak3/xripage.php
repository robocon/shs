<?php
    session_start();
//    session_destroy();
    //xxxipage.php
    session_unregister("cDepart");
    session_unregister("aDetail");
    session_unregister("cTitle");
   //preilab.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");

    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
//    session_unregister("cDepart");
    session_unregister("cPart");
    session_unregister("cDiag");
    session_unregister("cAn"); 
    session_unregister("cDoctor"); 
    session_unregister("cAccno"); 
    session_unregister("nRunno");
////
 
 $cDepart = 'XRAY';
 $aDetail='��ҵ�Ǩ���������ä';
 $cTitle="������¡���͡������"; 
 session_register("cDepart");
 session_register("aDetail");
 session_register("cTitle");
?>
<frameset rows="13%,87%">
  <frame name="top" src="xrimenu.php" noresize scrolling="no">
<frameset cols="40%,60%">
  <frame name="left" src="labiask.php" scrolling="auto">
  <frame name="right" src="" scrolling="auto">
</frameset>
</frameset>


