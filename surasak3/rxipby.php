<?php
    session_start();
//  session_destroy();
    ///rxip
    session_unregister("cDepart");
    ///preiprx.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister("cHn"); 
    session_unregister("cPtright");
    session_unregister("cPtname");
    session_unregister("cAccno");
    session_unregister("cAn");
    session_unregister("cDoctor");
    session_unregister("cIdname");
    session_unregister("cDiag");
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");

    session_unregister("sDcode");
    session_unregister("sSlip");

    session_unregister("nRunno");
////
 $cDepart = 'PHAR';
// $aDetail='ค่ายา';
 session_register("cDepart");
// session_register("aDetail");
?>
<frameset rows="13%,87%">
  <frame name="top" src="rxipbybar.php" noresize scrolling="no">
<frameset cols="40%,60%">
  <frame name="left" src="rxipbyfrm.php" scrolling="auto">
  <frame name="right" src="" scrolling="auto">
</frameset>
</frameset>


