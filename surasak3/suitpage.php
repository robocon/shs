<?php
    session_start();
    //xxxpage.php
    session_unregister("cDepart"); 
    session_unregister("aDetail");
    session_unregister("cTitle");
    //vnxxx.php
    session_unregister("cHn");    
    session_unregister("cPtname");
    session_unregister("cPtright");
    //prelab.php
    session_unregister("x");       
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister("cPart");
    session_unregister("cDiag");
    session_unregister("cAn"); 
    session_unregister("cDoctor"); 
    session_unregister("cAccno"); 
    session_unregister("nRunno");
///
    $cSuitname="";
    $cSuitcode="";
    session_register("cSuitname");
    session_register("cSuitcode");
////
 $cDepart = 'PATHO';
 $aDetail='��ҵ�Ǩ���������ä';
 $cTitle="������¡�õ�Ǩ��ͧ��Ҹ�";
 session_register("cDepart");
 session_register("aDetail");
 session_register("cTitle");
?>
<frameset rows="13%,87%">
  <frame name="top" src="suitmenu.php" noresize scrolling="no">
<frameset cols="40%,60%">
  <frame name="left" src="suitask.php" scrolling="auto">
  <frame name="right" src="" scrolling="auto">
</frameset>
</frameset>




