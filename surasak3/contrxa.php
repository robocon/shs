<?php
	session_start();
	//'$nRunno','$Thidate','$cPtname','$cHn',
// '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
// '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','DR');";

//'$aDgcode[$n]','$aTrade[$n]',
//'$aAmount[$n]','$aMoney[$n]','$aSlipcode[$n]','$aPart[$n]','$idno');";
    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aSalepri  = array("ราคาขาย/unit  ");
	$aFreepri = array("ราคาเบิกได้/unit");
    $aPrice  = array(" ราคาขายรวม  ");
    $aPart = array("part");
    $aUnit = array("unit");
    $aAmount = array("        จำนวน   ");
    $aSlipcode = array("        วิธีใช้   ");
    $aMoney= array("       รวมเงิน   ");
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
    print  "<font face='Angsana New'>ใบสั่งยาผู้ป่วยใน  วันที่ $Thaidate<br> ";
    print "<font face='AngsanaUPC' size='2'><b> $cWard,เตียง $cBed, ชื่อ $cPtname, อายุ $cAge, AN:$cAn</b></font><br>";
	print" สิทธิ $cPtright , แพทย์  $cDoctor";
	///////
	print "<form method='POST' action='contrxb.php'>";
 print" <p>เบิกยาจำนวน &nbsp;<input type='text' name='day' size='2' value=$nDay>  วัน ";
  print"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='         ตกลง         ' name='B1'></p>";
print"</form>";
/////////

?>
