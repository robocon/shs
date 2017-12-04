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
//  session_unregister("cBilldate");
    session_unregister("cBillno");
    session_unregister("cDepcode"); 
    session_unregister("nRunno");
////
    echo "<br>ยกเลิกรายการทั้งหมด  ";
?>
 