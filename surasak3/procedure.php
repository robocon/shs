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

   print "�ԹԨ����ä :$cDiag<br>";
   print "*�ô���͡�ѵ����*<br>";
   print"<a target=_BLANK href='erform.php'>��觷��ѵ������ͧ�ء�Թ</a><br>";
   print"<a target=_BLANK href='orform.php'>��觷��ѵ������ͧ��ҵѴ</a><br>";
   print"<a target=_BLANK href='ptform.php'>��觷ӡ���Ҿ�ӺѴ</a><br>";
?>



