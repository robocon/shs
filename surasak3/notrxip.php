<?php
    session_start();
//    session_destroy();
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
////
    echo "<br>ยกเลิกรายการทั้งหมด  ";
?>
 