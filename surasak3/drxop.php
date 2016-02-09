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
    session_unregister("cPastHx");
    session_unregister("cNewHx");

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
?>
<frameset cols="50%,50%">
  <frame name="left" src="dvnrx.php" scrolling="auto">
  
  <frameset rows="50%,50%">
  <frame name="top" src="" noresize scrolling="auto">
  <frame name="bottom" src="" noresize scrolling="auto">

</frameset>
</frameset>


