<?php
    session_start();
    ///rxip
    session_unregister("sStatcon");
//  session_unregister("cBed");
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
   $cAn=$vAn;
   $sStatcon = 'STAT';
  $cBed=$vBed;
    $cBedcode=$vBedcode;
  session_register("sStatcon");
  session_register("cBed");
  session_register("cBedcode");
  session_register("cAn");
?>
<frameset rows="13%,87%">
  <frame name="top" src="ipstatban.php" noresize scrolling="no">
<frameset cols="40%,60%">
  <frame name="left" src="ipprerx.php" scrolling="auto">
  <frame name="right" src="" scrolling="auto">
</frameset>
</frameset>


