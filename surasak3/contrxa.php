<?php
	session_start();
	//'$nRunno','$Thidate','$cPtname','$cHn',
// '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
// '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','DR');";

//'$aDgcode[$n]','$aTrade[$n]',
//'$aAmount[$n]','$aMoney[$n]','$aSlipcode[$n]','$aPart[$n]','$idno');";
    $x=0;
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aSalepri  = array("�ҤҢ��/unit  ");
	$aFreepri = array("�Ҥ��ԡ��/unit");
    $aPrice  = array(" �ҤҢ�����  ");
    $aPart = array("part");
    $aUnit = array("unit");
    $aAmount = array("        �ӹǹ   ");
    $aSlipcode = array("        �Ը���   ");
    $aMoney= array("       ����Թ   ");
    $Netprice="";   

    $cIdname="";
    $aEssd=array("Essd");
    $aNessdy=array("Nessdy");
    $aNessdn=array("Nessdn");
    $aDPY=array("DPY");
    $aDPN=array("DPN");   
    $aDSY=array("DSY");
    $aDSN=array("DSN");   

 //   $sDcode="";
//    $sSlip="";
//    session_register("sDcode");
 //   session_register("sSlip");

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aSalepri");
    session_register("aFreepri");
    session_register("aPrice");
    session_register("aPart");
    session_register("aUnit");
    session_register("aAmount");
    session_register("aSlipcode");
    session_register("aMoney");
    session_register("Netprice");

      session_register("cIdname");
 //     session_register("cHistory");
      session_register("aEssd");
      session_register("aNessdy");
      session_register("aNessdn");
      session_register("aDPY");
      session_register("aDPN");
      session_register("aDSY");
      session_register("aDSN");

////////////////
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    print  "<font face='Angsana New'>�����Ҽ������  �ѹ��� $Thaidate<br> ";
    print "<font face='AngsanaUPC' size='2'><b> $cWard,��§ $cBed, ���� $cPtname, ���� $cAge, AN:$cAn</b></font><br>";
	print" �Է�� $cPtright , ᾷ��  $cDoctor";
	///////
	print "<form method='POST' action='contrxb.php'>";
 print" <p>�ԡ�Ҩӹǹ &nbsp;<input type='text' name='day' size='2' value=$nDay>  �ѹ ";
  print"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='         ��ŧ         ' name='B1'></p>";
print"</form>";
/////////

?>
