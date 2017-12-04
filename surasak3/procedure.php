<?php
    session_start();

//	session_unregister("cDiag");
    session_unregister("cDepart"); 
    session_unregister("cDetail");
    session_unregister("cTitle");

	session_unregister("m");       
    session_unregister("aLabcode");
    session_unregister("aDetail");
    session_unregister("aEachprice");
    session_unregister("aLabpart");
    session_unregister("aTime");
    session_unregister("aItemprice");
    session_unregister("nLabprice");
    session_unregister("cLabpart");
    session_unregister("cAccno"); 
    session_unregister("nChktranx");

    session_unregister("aYprice");
    session_unregister("aNprice");
    session_unregister("aSumYprice");
    session_unregister("aSumNprice");

  //  $cDiag=$diag;
//    session_register("cDiag");

   print "วินิจฉัยโรค :$cDiag<br>";
   print "*โปรดเลือกหัตถการ*<br>";
   print"<a target=_BLANK href='erform.php'>สั่งทำหัตถการห้องฉุกเฉิน</a><br>";
   print"<a target=_BLANK href='orform.php'>สั่งทำหัตถการห้องผ่าตัด</a><br>";
   print"<a target=_BLANK href='ptform.php'>สั่งทำกายภาพบำบัด</a><br>";
?>



