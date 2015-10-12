<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
   //rxop
   session_unregister("cDepart");

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
 session_register("cDepart");
///
    $cSuitname="";
    $cSuitcode="";
    session_register("cSuitname");
    session_register("cSuitcode");
////
?>
<frameset rows="13%,87%">
  <frame name="top" src="surxopbar.php" noresize scrolling="no">
<frameset cols="40%,60%">
  <frame name="left" src="surxopfrm.php" scrolling="auto">
  <frame name="right" src="" scrolling="auto">
</frameset>
</frameset>


