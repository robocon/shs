<?php
    session_start();
    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aPrice  = array("                          ราคาขาย  ");
    $aPart = array("part");
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

      session_register("cIdname");
      session_register("aEssd");
      session_register("aNessdy");
      session_register("aNessdn");
      session_register("aDPY");
      session_register("aDPN");
      session_register("aDSY");
      session_register("aDSN");
///
    include("connect.inc");
       $query = "SELECT drugcode FROM druglst WHERE drugcode = '$suitcode'";
       $result = mysql_query($query) or die("Query failed");

        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

       if(mysql_num_rows($result)){
                   print "รหัสสูตร $suitcode ซ้ำที่มีอยู่เดิม โปรดเปลี่ยนใหม่<br>";
    		                   }
        else{
 	   $cSuitname=$suitname;
	   $cSuitcode=$suitcode;
	   print "ชื่อสูตร :$suitname<br>";
	   print "รหัสสูตร :$suitcode<br>";
                   print "<a href='sudgseek.php'>ทำรายการต่อไป</a>";
	      }
    include("unconnect.inc");
?>







