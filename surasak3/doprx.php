<?php
   session_start();
    $x=0;
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aPrice  = array("                          �ҤҢ��  ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aSlipcode = array("        �Ը���   ");
    $aMoney= array("       ����Թ   ");
    $Netprice="";   

//    $cHn="";
//    $cPtname="";
//    $cPtright=""; 

//    $cAn=$an;  
    $cDoctor=$sOfficer;
    $cIdname="";
    $cDiag=$diag;
    $cNewHx=$history;
    $aEssd=array("Essd");
    $aNessdy=array("Nessdy");
    $aNessdn=array("Nessdn");
    $aDPY=array("DPY");
    $aDPN=array("DPN");   
    $aDSY=array("DSY");
    $aDSN=array("DSN");   

    $sDcode="";
    $sSlip="";
    session_register("sDcode");
    session_register("sSlip");

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aSlipcode");
    session_register("aMoney");
    session_register("Netprice");

//    session_register("cHn");  
//    session_register("cPtname");    
//    session_register("cPtright");

//    session_register("cAn");
      session_register("cDoctor");
      session_register("cIdname");
      session_register("cDiag");
      session_register("cHistory");
      session_register("aEssd");
      session_register("aNessdy");
      session_register("aNessdn");
      session_register("aDPY");
      session_register("aDPN");
      session_register("aDSY");
      session_register("aDSN");

   print"<font face='Angsana New'><b>��Ǩ�ѡ�Ҽ����¹͡ &nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< �����</a></b><br>";
   print "<font face='Angsana New'>HN :$cHn ���� $cPtname  �Է��: $cPtright";
   print "<textarea rows='8' name='report' cols='55'>$cPastHx</textarea>";
   print"<form method='POST' action='dopok.php'>";
        print"<textarea rows='4' name='history' cols='55'>$cNewHx</textarea>";
        print"<br><a target= bottom href='reinvestfrm.php'>INVESTIGATION</a>";
        print"&nbsp;&nbsp;||&nbsp;&nbsp;<a target= bottom href='procedure.php'>��觷��ѵ����</a>";
        print"&nbsp;&nbsp;&nbsp;<a target= bottom href='ddgseek.php'>�����</a>";
        print"<br><a target=_BLANK href='diaghlp.htm'>DIAGNOSIS</a> :&nbsp;&nbsp;&nbsp; ";
        print"<input type='text' name='diag' size='20' value='$cDiag'>";
        print"<br><input type='submit' value='�ѹ�֡����ѵ� & �Դ OPDcard' name='B1'></font></p>";
   print"</form>";
?>