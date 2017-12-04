<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
   //rxop
   session_unregister("cDepart");
   //vnrx.php
    session_unregister("cHn");
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nRunno");
   //prerx.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("aMoney");
    session_unregister("Netprice");

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
////
 $cDepart = 'PHAR';
// $aDetail='ค่ายา';
 session_register("cDepart");
// session_register("aDetail");
?>
<frameset rows="13%,87%">
  <frame name="top" src="rxopstrikbar.php" noresize scrolling="no">
<frameset cols="35%,65%">
  <frame name="left" src="dgstrik.php" scrolling="auto">
  <frame name="right" src="" scrolling="auto">

</frameset>
</frameset>


