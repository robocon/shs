<?php
    session_start();
//    session_destroy();
    //rxunit
    session_unregister("cDepart");
    //preurx.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
//    session_unregister("cBilldate");
    session_unregister("cBillno");
    session_unregister("cDepcode"); 

    session_unregister("sDcode");
    session_unregister("nRunno");
////
 $cDepart = 'PHAR';
// $aDetail='ค่ายา';
 session_register("cDepart");
// session_register("aDetail");
?>
<frameset rows="13%,87%">
  <frame name="top" src="rxubar.php" noresize scrolling="no">
<frameset cols="40%,60%">
  <frame name="left" src="rxufrm.php" scrolling="auto">
  <frame name="right" src="" scrolling="auto">
</frameset>
</frameset>


