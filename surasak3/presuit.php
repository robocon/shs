<?php
   session_start();

    $x=0;
    $aDgcode = array("รหัส");
    $aTrade  = array("รายการ");
    $aPrice  = array("ราคา ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aMoney= array("       รวมเงิน   ");
    $Netprice="";   

    $cPart="";

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");

    session_register("cPart");
///
    include("connect.inc");
       $query = "SELECT code FROM labcare WHERE code = '$suitcode'";
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
                   print "<a href='suitseek.php'>ทำรายการต่อไป</a>";
	      }
    include("unconnect.inc");
?>







