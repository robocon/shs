<?php
    session_start();
//    session_destroy();
//stkseek.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aExpdate");
    session_unregister("aLotno");
    session_unregister("aAmount");
    session_unregister("aUnit");
    session_unregister("aDglotno");
    session_unregister("aStkcut");
    session_unregister("cTotal");
    session_unregister("cRestkcut");
    session_unregister("nRunno");
//
    echo "<br>ยกเลิกรายการทั้งหมด  ";
?>
 